<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('home');
});

Route::get('/welcome', function (): View {
    return view('welcome');
});

Route::controller(ClienteController::class)->prefix('cliente')->name('cliente.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});

Route::controller(ProdutoController::class)->prefix('produto')->name('produto.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});

Route::controller(VendaController::class)->prefix('venda')->name('venda.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});
