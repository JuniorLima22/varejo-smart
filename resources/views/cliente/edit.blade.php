
@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    cliente.edit - {{ $id }}
    {{-- @livewire('cliente.edit', ['id' => $id]) --}}
@stop
