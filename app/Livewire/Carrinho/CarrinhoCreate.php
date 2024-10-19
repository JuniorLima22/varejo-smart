<?php

namespace App\Livewire\Carrinho;

use App\Models\Cliente;
use App\Service\ClienteService;
use App\Service\CupomService;
use App\Service\ProdutoService;
use App\Service\VendaService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CarrinhoCreate extends Component
{
    use Toast;

    protected ProdutoService $produtoService;
    protected CupomService $cupomService;
    protected ClienteService $clienteService;
    protected VendaService $vendaService;
    public Cliente $clienteDetalhe;
    public $carrinho = [];
    public $cupomId;
    public $cupomCodigo;
    public $desconto = 0;
    public int $cliente_id;

    protected $listeners = ['addAoCarrinho' => 'adicionarProduto'];

    public function boot(
        ProdutoService $produtoService,
        CupomService $cupomService,
        ClienteService $clienteService,
        VendaService $vendaService
    ): void {
        $this->produtoService = $produtoService;
        $this->cupomService = $cupomService;
        $this->clienteService = $clienteService;
        $this->vendaService = $vendaService;
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

        $this->cupomId = $cupom->id;
        $this->desconto = $cupom->desconto_percentual;
        $this->sucesso('Cupom aplicado com sucesso!');
    }

    public function detalhesCliente(): void
    {
        $this->clienteDetalhe = $this->clienteService->listarPorId($this->cliente_id);
    }

    public function finalizarCompra(): void
    {
        $dados = $this->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'carrinho' => 'required|array|min:1',
        ], [
            'carrinho.required' => 'Seu carrinho de compras está vazio. Por favor, adicione produtos antes de continuar.',
            'carrinho.min' => 'Seu carrinho precisa ter pelo menos um produto antes de finalizar a compra.',
        ]);

        $dados['cupom_id'] = $this->cupomId;
        $dados['total'] = $this->calcularTotal();

        $venda = $this->vendaService->cadastrar($dados);

        if (!is_null($venda)) {
            // TODO: Enviar email de confirmação de compra realizada
            $this->sucesso('Compra realizada com sucesso!');
            $this->reset();
        } else {
            $this->error($this->registro_erro_cadastrar);
        }
    }

    public function calcularTotal()
    {
        // Lógica para calcular o total do carrinho
        return array_reduce($this->carrinho, function ($total, $produto): float|int {
            return $total + ($produto['preco'] * $produto['quantidade']);
        }, 0);
    }

    public function render(): View
    {
        $clientes = $this->clienteService->listar()->orderBy('nome')->get();
        return view('livewire.carrinho.carrinho-create', compact('clientes'));
    }
}
