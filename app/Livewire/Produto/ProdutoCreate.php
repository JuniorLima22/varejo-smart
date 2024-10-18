<?php

namespace App\Livewire\Produto;

use App\Http\Requests\ProdutoRequest;
use App\Service\CategoriaService;
use App\Service\ProdutoService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProdutoCreate extends Component
{
    use Toast, WithFileUploads;
    protected ProdutoService $produtoService;
    protected CategoriaService $categoriaService;

    public string $nome;
    public string $descricao;
    public float $preco_compra;
    public float $preco_venda;
    public int $quantidade;
    public $imagem_url;
    public $imagem_temporario;
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
            'categoria_id' => 'categoria',
            'imagem_temporario' => 'imagem',
        ];
    }

    public function store(): void
    {
        $this->validate();
        if (isset($this->imagem_temporario) && $this->imagem_temporario->isValid()) {
            $path = $this->imagem_temporario->store('produtos', 'public_storage');

            if (!$path)
                $this->error('Erro ao fazer upload da imagem');

            $this->imagem_url = $path;
        }

        $produto = $this->produtoService->cadastrar($this->all());

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
