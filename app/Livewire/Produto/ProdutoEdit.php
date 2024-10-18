<?php

namespace App\Livewire\Produto;

use App\Http\Requests\ProdutoRequest;
use App\Service\CategoriaService;
use App\Service\ProdutoService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProdutoEdit extends Component
{
    use Toast, WithFileUploads;
    protected ProdutoService $produtoService;
    protected CategoriaService $categoriaService;

    public int $produtoId;
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

    public function mount(int $id): void
    {
        $this->definirValoresPadroes($id);
    }

    public function rules(): array
    {
        return (new ProdutoRequest())->rules($this->produtoId);
    }

    public function validationAttributes(): array
    {
        return [
            'categoria_id' => 'categoria',
            'imagem_temporario' => 'imagem',
        ];
    }

    protected function definirValoresPadroes(int $produtoId)
    {
        $this->produtoId = $produtoId;
        $produto = $this->produtoService->listarPorId($produtoId);

        if (is_null($produto))
            return redirect()->route('produto.index');

        $this->fill(
            $produto->only(
                'nome',
                'descricao',
                'preco_compra',
                'preco_venda',
                'quantidade',
                'imagem_url',
                'categoria_id'
            )
        );
    }

    public function update(): void
    {
        if (isset($this->imagem_temporario) && $this->imagem_temporario->isValid()) {
            if (!is_null($this->imagem_url))
                Storage::disk('public_storage')->delete($this->imagem_url);
            
            $path = $this->imagem_temporario->store('produtos', 'public_storage');
            
            if (!$path)
                $this->error('Erro ao fazer upload da imagem');
        
            $this->imagem_url = $path;
        }
    
        $dados = $this->validate();
        unset($dados['imagem_temporario']);
        $produto = $this->produtoService->atualizar($dados, $this->produtoId);

        if (!is_null($produto)) {
            $this->sucesso($this->registro_cadastrado);
            $this->reset('imagem_temporario');
        } else {
            $this->error($this->registro_erro_cadastrar);
        }
    }

    public function render(): View
    {
        $categorias = $this->categoriaService->listarComSubcategorias();
        return view('livewire.produto.produto-edit', compact('categorias'));
    }
}
