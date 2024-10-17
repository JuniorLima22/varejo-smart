@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadastrar Produto</h1>
@stop

@section('content')
    @livewire('produto.produto-create')
@stop
