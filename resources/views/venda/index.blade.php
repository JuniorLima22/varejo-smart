@extends('adminlte::page')

@section('title', 'Vendas')

@section('content_header')
    <div class="clearfix">
        <h1 class="float-left">Vendas</h1>
        <x-adminlte-button label="Cadastrar" theme="primary" icon="fas fa-plus" class="float-right" onclick="location.href='{{ route('venda.create') }}'"/>
    </div>
@stop

@section('content')
    @livewire('venda.venda-index')
@stop
