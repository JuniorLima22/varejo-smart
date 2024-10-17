<?php

namespace App\Livewire\Produto;

use App\Http\Requests\ProdutoRequest;
use App\Service\CategoriaService;
use App\Service\ProdutoService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProdutoCreate extends Component
{
    use Toast;
    protected ProdutoService $produtoService;
    protected CategoriaService $categoriaService;

    public string $nome;
    public string $descricao;
    public float $preco_compra = 0.0;
    public float $preco_venda = 0.0;
    public int $quantidade = 0;
    public string $imagem_url;
    public string $imagem_temporary;
    public int $categoria_id;

    public function boot(
        ProdutoService $produtoService,
        CategoriaService $categoriaService
    ): void {
        $this->produtoService = $produtoService;
        $this->categoriaService = $categoriaService;
    }

    public function rules(): array
    {
        return (new ProdutoRequest())->rules();
    }

    public function validationAttributes(): array
    {
        return [
            'categoria_id'=> 'categoria',
            'imagem_url'=> 'imagem',
        ];
    }

    public function store(): void
    {
        $produto = $this->produtoService->cadastrar($this->validate());

        if (!is_null($produto)) {
            $this->sucesso($this->registro_cadastrado);
            $this->reset();
        } else {
            $this->error($this->registro_erro_cadastrar);
        }
    }

    public function render(): View
    {
        $categorias = $this->categoriaService->listarComSubcategorias();
        return view('livewire.produto.produto-create', compact('categorias'));
    }
}
