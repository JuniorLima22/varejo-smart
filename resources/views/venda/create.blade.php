@extends('adminlte::page')

@section('title', 'Cadastrar Venda')

@section('content_header')
    <h1>Cadastrar Venda</h1>
@stop

@section('content')
    @livewire('venda.venda-create')
@stop
