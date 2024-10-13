<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('home');
});

Route::get('/welcome', function (): View {
    return view('welcome');
});
