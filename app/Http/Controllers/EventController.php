<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use App\Utilities\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();


        // Base query: Admin sees all, organizer sees their own events
        $eventQuery = Event::query()->when(!$user->isAdmin(), fn($q) => $q->where('user_id', $user->id));

        // Fetch paginated events (AFTER setting the base query)
        $events = $eventQuery->latest()->paginate(10);


        // Fetch statistics in a single query
        $eventCounts = $eventQuery
            ->selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status');

        // Define possible statuses and set default count (0) if missing
        $statuses = ['draft', 'pending', 'approved', 'cancelled', 'completed'];

        $statistics = collect([
            [
                'color'    => 'card-warning',
                'icon'     => 'la la-edit',
                'category' => 'Draft Events',
                'status'   => 'draft',
            ],
            [
                'color'    => 'card-info',
                'icon'     => 'la la-hourglass-half',
                'category' => 'Pending Events',
                'status'   => 'pending',
            ],
            [
                'color'    => 'card-success',
                'icon'     => 'la la-check',
                'category' => 'Approved Events',
                'status'   => 'approved',
            ],
            [
                'color'    => 'card-danger',
                'icon'     => 'la la-ban',
                'category' => 'Cancelled Events',
                'status'   => 'cancelled',
            ],
            [
                'color'    => 'card-success',
                'icon'     => 'la la-calendar',
                'category' => 'Completed Events',
                'status'   => 'completed',
            ],
        ])->map(function ($stat) use ($eventCounts) {
            return array_merge($stat, [
                'route' => route('events.index', ['status' => $stat['status']]),
                'count' => $eventCounts[$stat['status']] ?? 0, // Default to 0 if missing
            ]);
        });


        return view('admins.events.index', compact('events', 'statistics'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $user           = User::find(Auth::id());
        $data           = $request->validated();
        $data['status'] = Constants::EVENT_STATUS_PENDING;
        $data['image']  = Storage::disk(config('filesystems.default'))->put('events', $request->file('image'));

        $user->events()->create($data);

        return redirect()->route('events.index')->with('success', 'Event created successfully, pending approval');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['user:id,name,email,phone_number,role', 'tickets', 'orders'])
            ->loadCount('tickets', 'orders');

        return view('admins.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk(config('filesystems.default'))->delete($event->image);
            $data['image'] = Storage::disk(config('filesystems.default'))->put('events', $request->file('image'));
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // check if the event has orders
        if ($event->orders()->exists()) {
            return redirect()->route('events.index')->with('error', 'Event cannot be deleted, it has orders');
        }

        Storage::disk(config('filesystems.default'))->delete($event->image);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
