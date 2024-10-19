
@extends('adminlte::page')

@section('title', 'Editar Venda')

@section('content_header')
    <h1>Editar Venda</h1>
@stop

@section('content')
    @livewire('venda.venda-edit', ['id' => $id])
@stop
