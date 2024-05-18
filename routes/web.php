<?php

use App\Models\Event;
use Illuminate\Http\Request;
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

Route::get('/calendar', function (Request $request) {
    $start = $request->input('start', date('Y-m-01'));
    $end = $request->input('end', date('Y-m-t', strtotime($start)));

    $events = Event::where([
        ['start_date', '>', $start],
        ['start_date', '<', $end]
    ])
        ->orWhere([
            ['end_date', '>', $start],
            ['end_date', '<', $end]
        ])
        ->orWhere([
            ['start_date', '<', $start],
            ['end_date', '>', $end]
        ])
        ->get();

    $parsed_events = $events->map(function ($a) {
        $a['featured'] = ($a['featured'] == 1);
        return $a;
    });

    return Inertia::render('Calendar', [
        'events' => $parsed_events,
        'start' => $start,
        'end' => $end
    ]);
});

Route::get('/links', function () {
    return Inertia::render('Links');
});

Route::get('/events/{id}', function (string $id, Request $request) {
    $event = Event::where('identifier', $id)
        ->first();
    $event['featured'] = $event['featured'] == 1;
    return Inertia::render('Event', $event);
});
