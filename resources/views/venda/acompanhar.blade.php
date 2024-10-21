@extends('adminlte::page')

@section('title', 'Acompanhar Pedido')

@section('content')
    @livewire('venda.venda-acompanhar', ['codigoVenda' => $codigoVenda])
@stop
