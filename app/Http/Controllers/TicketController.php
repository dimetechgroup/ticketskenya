<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Event;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Event $event)
    // {

    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        return view('admins.events.tickets.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->tickets()->create($data);

        return redirect()->route('events.show', $event)->with('success', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Ticket $ticket)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Ticket $ticket)
    {
        return view('events.tickets.edit', compact('event', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Event $event, Ticket $ticket)
    {
        $data = $request->validated();
        $ticket->update($data);

        return redirect()->route('events.show', $event)->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // Check if the ticket has orders before deleting
        if ($ticket->orders()->exists()) {
            return back()->with('error', 'Ticket has orders, cannot delete');
        }

        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully');
    }
}
