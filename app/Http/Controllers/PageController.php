<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function indexPage()
    {
        // current and future events
        $current_future_events = Event::query()->select([
            'id',
            'image',
            'name',
            'start_date',
            'venue'
        ])
            ->where('is_private', 0)
            ->where('start_date', '>=', now())
            ->lazyByIdDesc();



        return view('websites.welcome', compact('current_future_events'));
    }
}
