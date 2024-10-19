
@extends('adminlte::page')

@section('title', 'Editar Venda')

@section('content_header')
    <div class="row">
        <div class="col-6 float-left text-left">
            <h1>Editar Venda</h1>
        </div>
        <div class="col-6 float-right text-right">
            <h6 class="font-weight-bold">Hoje, {{ ucfirst(now()->translatedFormat('l')) }} {{ now()->format('d/m/Y') }}</h6>
        </div>
    </div>
@stop

@section('content')
    @livewire('venda.venda-edit', ['id' => $id])
@stop
