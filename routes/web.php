<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Inertia::setRootView('app');

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/calendar', function () {
    return Inertia::render('Calendar');
});

Route::get('/links', function () {
    return Inertia::render('Links');
});
