<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\UpdateEventStatusRequest;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Utilities\Constants;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        $statuses = ['pending', 'approved', 'cancelled', 'completed'];

        $statistics = collect([

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
        $data['slug'] =  Str::slug($data['name']);
        $data['image']  = Storage::disk(config('filesystems.default'))->put('events', $request->file('image'));

        $user->events()->create($data);

        return redirect()->route('events.index')->with('success', 'Event created successfully, pending approval');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->with([
            'user:id,name,email,phone_number,role',
            'tickets',
            'orders' => function ($query) {
                $query->select('orders.order_number', 'orders.id', 'orders.total_amount', 'orders.payment_status', 'orders.ticket_id');
            }
        ])->firstOrFail();

        // Calculate required metrics efficiently
        $ordersIds = $event->orders->pluck('id');  // Using already loaded orders

        $ticketsSold = $event->tickets->sum('sold_quantity');

        $totalRevenue = $event->orders
            ->where('payment_status', Constants::PAYMENT_STATUS_SUCCESSFUL)
            ->sum('total_amount');

        $attendeesCheckedIn = OrderItem::whereIn('order_id', $ordersIds)
            ->whereNotNull('checkin_time')
            ->count();

        $totalAttendees = OrderItem::whereIn('order_id', $ordersIds)
            ->count();

        return view('admins.events.show', compact(
            'event',
            'ticketsSold',
            'totalRevenue',
            'attendeesCheckedIn',
            'totalAttendees'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admins.events.edit', compact('event'));
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

        return redirect()->route('events.show', $event->slug)->with('success', 'Event updated successfully');
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

    public function updateStatus(UpdateEventStatusRequest $request, string $eventSlug)
    {
        $data = $request->validated();
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $event->update($data);

        return redirect()->route('events.show', $event->slug)->with('success', 'Event status updated successfully');
    }

    /***
     * Display attendees for a specific event
     * @param Event $event
     *
     */
    /**
     * Display attendees for a specific event
     *
     * @param int $eventId
     * @return \Illuminate\View\View
     */
    public function attendees(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $tickets = $event->tickets()->with([
            'orders' => function ($query) {
                $query->with([
                    'orderItems' => function ($query) {
                        $query->select('id', 'order_id', 'ticket_id', 'attendee_name', 'attendee_email', 'attendee_phone', 'status', 'checkin_time');
                    },
                    'orderItems.ticket:id,name'
                ])->select('id', 'order_number', 'payment_status');
            }
        ])->get();

        $orderItems = OrderItem::whereIn('ticket_id', $tickets->pluck('id'))->get();
        $total_attendees = $orderItems->count();
        $checkinCount = $orderItems->whereNotNull('checkin_time')->count();
        $yetToCheckinCount = $total_attendees - $checkinCount;



        return view('admins.events.attendees', compact('event', 'checkinCount', 'yetToCheckinCount', 'total_attendees'));
    }

    public function checkInAttendee(string $encodedOrderId)
    {
        $orderId = decrypt($encodedOrderId);
        $attendee = OrderItem::findOrFail($orderId);
        $ticket = $attendee->ticket;
        $event = $ticket->event;

        if ($attendee->checkin_time) {
            return $this->checkInResponse(false, 'Attendee has already been checked in', $attendee);
        }

        if ($ticket->order->payment_status == Constants::PAYMENT_STATUS_PENDING) {
            return $this->checkInResponse(false, 'Attendee ticket has not been paid for', $attendee);
        }

        if ($event->status != Constants::EVENT_STATUS_APPROVED) {
            return $this->checkInResponse(false, 'Event is not ongoing', $attendee);
        }

        if ($event->start_date > now()) {
            return $this->checkInResponse(false, 'Event has not started yet', $attendee);
        }

        if ($event->end_date < now()) {
            return $this->checkInResponse(false, 'Event has ended', $attendee);
        }

        // Perform check-in
        $attendee->update([
            'checkin_time' => now(),
            'checkin_by' => Auth::id()
        ]);

        return $this->checkInResponse(true, 'Attendee ' . $attendee->attendee_name . ' checked in successfully', $attendee);
    }

    /**
     * Helper function to return check-in response.
     */
    private function checkInResponse(bool $status, string $message, $attendee)
    {
        return view('admins.events.checkInResult', [
            'attendee' => $attendee,
            'result' => compact('status', 'message')
        ]);
    }
}
