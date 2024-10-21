<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): RedirectResponse {
    return redirect()->route('venda.index');
});

Route::get('/home', function (): RedirectResponse {
    return redirect()->route('venda.index');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->get('/dashboard', function (): RedirectResponse {
    return redirect()->route('venda.index');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->controller(ClienteController::class)->prefix('cliente')->name('cliente.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->controller(ProdutoController::class)->prefix('produto')->name('produto.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->controller(VendaController::class)->prefix('venda')->name('venda.')->group(function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::get('/editar/{id}', 'edit')->name('edit');
});

Route::get('venda/acompanhar_pedido/{codigoVenda?}', [VendaController::class, 'acompanharVenda'])->name('venda.acompanhar-venda');
