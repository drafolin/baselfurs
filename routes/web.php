<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Inertia::setRootView('app');

Route::get('/', function () {
    $events = Event::where('end_date', '>', date('Y-m-d'))
        ->orderBy('start_date', 'asc')
        ->take(3)
        ->get();

    return Inertia::render('Home', [
        'next_events' => $events
    ]);
});

Route::get('/calendar', function () {
    $first_day_this_month = date('Y-m-01');  // hard-coded '01' for first day
    $last_day_this_month = date('Y-m-t');
    $events = Event::where('start_date', '<', $last_day_this_month)
        ->orWhere('end_date', '>', $first_day_this_month)
        ->get();

    $parsed_events = $events->map(function ($a) {
        $a['featured'] = ($a['featured'] == 1);
        return $a;
    });

    return Inertia::render('Calendar', [
        'events' => $parsed_events
    ]);
});

Route::get('/links', function () {
    return Inertia::render('Links');
});
