<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $events = [];
        $tickets = [];
        $bestSelling = [];


        if ($user->role === 'admin') {
            $events = Event::all();
            $tickets = Ticket::all();
            $users =  User::all();
            $sales = Ticket::sum('sold_quantity');
            $bestSelling = Event::withCount('tickets') // Count tickets per event
                ->orderByDesc('tickets_count')
                ->take(5) // Get top 5 best-selling events
                ->get();
        } else {
            if ($user->role === 'organizer') {
                $events = Event::where('organizer_id', $user->id)->latest()->take(8)->get();
                $users = Auth::user();
                $sales = Ticket::whereHas('event', function ($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->sum('sold_quantity');
                $tickets = Ticket::whereHas('event', function ($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->get();
                $bestSelling = Event::where('organizer_id', $user->id)
                    ->withCount('tickets')
                    ->orderByDesc('tickets_count')
                    ->take(5)
                    ->get();
            }
        }

        return view('dashboard', compact('events', 'bestSelling', 'tickets', 'users', 'sales'));
    }
}
