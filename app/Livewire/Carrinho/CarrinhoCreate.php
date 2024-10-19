<?php

namespace App\Livewire\Carrinho;

use App\Service\CupomService;
use App\Service\ProdutoService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CarrinhoCreate extends Component
{
    use Toast;

    protected ProdutoService $produtoService;
    protected CupomService $cupomService;
    public $carrinho = [];
    public $cupomCodigo;
    public $desconto = 0;

    protected $listeners = ['addAoCarrinho' => 'adicionarProduto'];

    public function boot(
        ProdutoService $produtoService,
        CupomService $cupomService
    ): void {
        $this->produtoService = $produtoService;
        $this->cupomService = $cupomService;
    }

    public function mount(): void
    {
        $this->carrinho = session()->get('carrinho_sessao', []);
    }

    public function adicionarProduto(int $produtoId): void
    {
        $produto = $this->produtoService->listarPorId($produtoId);

        if (!$produto) {
            $this->error('Produto não encontrado!', delay: 2000);
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
        $this->sucesso('Produto adicionado ao carrinho!', position: 'bottomRight', delay: 2000);
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

    /**
     * Função para calcular o valor total do carrinho sem o desconto
     **/
    public function getSubTotalProperty(): float|int
    {
        $total = 0;
        foreach ($this->carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return $total;
    }

    /**
     * Função para calcular o valor total com o desconto aplicado
     **/
    public function getTotalProperty(): float
    {
        $subtotal = $this->subTotal;
        $total = $subtotal - $subtotal * $this->desconto / 100;

        return $total;
    }

    public function aplicarCupom(): void
    {
        $this->validate([ 
            'cupomCodigo' => 'required|exists:cupons,codigo'
        ]);
        
        $cupom = $this->cupomService->listar($this->cupomCodigo)->first();

        if (!$cupom) {
            $this->error('Cupom inválido!', delay: 2000);
            $this->desconto = 0;
            return;
        }

        if (!$cupom->isValid()) {
            $this->info('Cupom expirado!');
            return;
        }

        $this->desconto = $cupom->desconto_percentual;
        $this->sucesso('Cupom aplicado com sucesso!');
    }

    public function render(): View
    {
        return view('livewire.carrinho.carrinho-create');
    }
}
