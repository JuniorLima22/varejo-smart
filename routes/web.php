<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('home');
});

Route::get('/welcome', function (): View {
    return view('welcome');
});

Route::controller(ClienteController::class)->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});
