<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
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
        $user = User::find(Auth::id());
        //if the logged in user is an admin, show all events else show only the events created by the logged in user
        if ($user->isAdmin()) {
            $events = Event::query()->latest()->paginate(10);
        } else {
            $events = $user->events()->latest()->paginate(10);
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $user = User::find(Auth::id());
        $data = $request->validated();
        $data['status'] = 'pending';
        $data['image'] = Storage::disk(config('filesystems.default'))->put('events', $request->file('image'));

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

        return view('events.show', compact('event'));
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
