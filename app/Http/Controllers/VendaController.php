<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(): View
    {
        return view("venda.index");
    }

    public function create(): View
    {
        return view("venda.create");
    }

    public function edit($id): View
    {
        return view("venda.edit", compact("id"));
    }

    public function acompanharVenda(string $codigoVenda = null): View
    {
        return view("venda.acompanhar", compact("codigoVenda"));
    }
}
