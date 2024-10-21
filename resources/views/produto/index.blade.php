@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <div class="clearfix">
        <h1 class="float-left">Produtos</h1>
        <x-adminlte-button label="Cadastrar" theme="primary" icon="fas fa-plus" class="float-right" onclick="location.href='{{ route('produto.create') }}'"/>
    </div>
@stop

@section('content')
    @livewire('produto.produto-index')
@stop
