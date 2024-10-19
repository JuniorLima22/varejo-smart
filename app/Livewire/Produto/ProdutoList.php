<?php

namespace App\Livewire\Produto;

use App\Service\ProdutoService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProdutoList extends Component
{
    protected ProdutoService $produtoService;
    public $produtos;

    public function boot(
        ProdutoService $produtoService,
    ): void {
        $this->produtoService = $produtoService;
    }

    public function mount(): void
    {
        $this->produtos = $this->produtoService->listar()->orderBy('nome')->get();
    }

    public function AdicionarAoCarrinho($produtoId): void
    {
        $this->dispatch('addAoCarrinho', $produtoId);
    }
    
    public function render(): View
    {
        return view('livewire.produto.produto-list');
    }
}
