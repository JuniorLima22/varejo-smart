
@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto</h1>
@stop

@section('content')
    @livewire('produto.produto-edit', ['id' => $id])
@stop
