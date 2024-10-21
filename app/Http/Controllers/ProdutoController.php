<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): View
    {
        return view("produto.index");
    }

    public function create(): View
    {
        return view("produto.create");
    }

    public function edit($id): View
    {
        return view("produto.edit", compact("id"));
    }
}
