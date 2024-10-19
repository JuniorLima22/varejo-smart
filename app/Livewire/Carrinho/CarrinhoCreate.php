<?php

namespace App\Livewire\Carrinho;

use App\Service\ProdutoService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CarrinhoCreate extends Component
{
    use Toast;
    
    protected ProdutoService $produtoService;
    public $carrinho = [];
    protected $listeners = ['addAoCarrinho' => 'adicionarProduto'];

    public function boot(
        ProdutoService $produtoService,
    ): void {
        $this->produtoService = $produtoService;
    }

    public function mount(): void
    {
        $this->carrinho = session()->get('carrinho_sessao', []);
    }

    public function adicionarProduto(int $produtoId): void
    {
        $produto = $this->produtoService->listarPorId($produtoId);

        if (!$produto) {
            session()->flash('error', 'Produto não encontrado!');
            return;
        }

        if (isset($this->carrinho[$produtoId])) {
            // Se o produto já estiver no carrinho, aumenta a quantidade
            $this->carrinho[$produtoId]['quantidade']++;
        } else {
            // Adiciona novo produto ao carrinho
            $this->carrinho[$produtoId] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco_venda,
                'quantidade' => 1
            ];
        }

        session()->put('carrinho_sessao', $this->carrinho);
        $this->sucesso('Produto adicionado ao carrinho!', delay: 2000);
    }

    public function removerProduto($produtoId): void
    {
        if (isset($this->carrinho[$produtoId])) {
            unset($this->carrinho[$produtoId]);
        }

        session()->put('carrinho_sessao', $this->carrinho);
    }

    public function limparCarrinho(): void
    {
        $this->carrinho = [];
        session()->forget('carrinho_sessao');
    }

    public function render(): View
    {
        return view('livewire.carrinho.carrinho-create');
    }
}
