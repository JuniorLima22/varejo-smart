@extends('adminlte::page')

@section('title', 'Cadastrar Cliente')

@section('content_header')
    <h1>Cadastrar Cliente</h1>
@stop

@section('content')
    @livewire('cliente.cliente-create')
@stop
