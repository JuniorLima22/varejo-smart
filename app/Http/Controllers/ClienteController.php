<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        return view("cliente.index");
    }

    public function create(): View
    {
        return view("cliente.create");
    }

    public function edit($id): View
    {
        return view("cliente.edit", compact("id"));
    }
}
