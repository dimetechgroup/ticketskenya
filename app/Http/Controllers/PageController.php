<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function indexPage()
    {
        // Get all non-private events
        $events = Event::query()
            ->select(['id', 'slug', 'image', 'name', 'start_date', 'venue'])
            ->where('is_private', 0)
            ->orderByDesc('start_date')
            ->get();

        // Separate future & past events
        $current_future_events = $events->where('start_date', '>=', now());
        $past_events = $events->where('start_date', '<', now());

        return view('websites.welcome', compact('current_future_events', 'past_events'));
    }


    public function singleEvent(string $slug)
    {
        $event = Event::query()->where('slug', $slug)
            ->with(['tickets'])
            ->firstOrFail();
        return view('websites.event-details', compact('event'));
    }
    public function eventTicketBuy(string $slug, int $ticketId)
    {
        $event = Event::query()->where('slug', $slug)->firstOrFail();
        $ticket = $event->tickets()->where('id', $ticketId)->firstOrFail();
        return view('websites.event-ticket-buy', compact('event', 'ticket'));
    }
    public function contactPage(): View
    {
        return view('websites.contact');
    }
}
