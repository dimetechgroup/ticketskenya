<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function indexPage(): View
    {
        return view('websites.welcome');
    }
    public function contactPage(): View
    {
        return view('websites.contact');
    }
}
