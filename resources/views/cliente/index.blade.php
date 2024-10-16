@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="clearfix">
        <h1 class="float-left">Clientes</h1>
        <x-adminlte-button label="Cadastrar" theme="primary" icon="fas fa-plus" class="float-right" onclick="location.href='{{ route('cliente.create') }}'"/>
    </div>
@stop

@section('content')
    @livewire('cliente.cliente-index')
@stop
