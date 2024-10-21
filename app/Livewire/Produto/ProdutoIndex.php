<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use App\Service\CategoriaService;
use App\Service\ProdutoService;
use App\Traits\DataTable;
use App\Traits\Modal;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ProdutoIndex extends Component
{
    use WithPagination;
    use DataTable, Modal, Toast;

    protected ProdutoService $produtoService;
    protected CategoriaService $categoriaService;
    public Produto $produtoDetalhe;
    protected string $paginationTheme = 'bootstrap';
    public string $pesquisa = '';
    public int $categoria_id = 0;

    public function boot(
        ProdutoService $produtoService,
        CategoriaService $categoriaService
    ): void {
        $this->produtoService = $produtoService;
        $this->categoriaService = $categoriaService;
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function show($id): void
    {
        $this->produtoDetalhe = $this->produtoService->listarPorId($id);
        $this->modal('modal_detalhe');
    }

    public function confirmarDeletar($id): void
    {
        $this->produtoDetalhe = $this->produtoService->listarPorId($id);
        $this->modal('confirmar_deletar');
    }

    public function delete($id)
    {
        Storage::disk('public_storage')->delete($this->produtoDetalhe->imagem_url);
        $produto = $this->produtoService->deletar($id);

        $this->produtoDetalhe = $this->produtoDetalhe->make();

        $this->modal('confirmar_deletar', 'hide');

        if (!$produto)
            return $this->error($this->registro_erro_deletar);

        return $this->sucesso($this->registro_deletado);
    }

    public function render(): View
    {
        $produtos = $this->produtoService->listar($this->pesquisa, $this->categoria_id)
            ->with('categoria')
            ->orderBy($this->classificarNomeColuna, $this->classificarDirecao)
            ->paginate($this->itemPorPagina());

        $categorias = $this->categoriaService->listarComSubcategorias();
        return view('livewire.produto.produto-index', compact('produtos', 'categorias'));
    }
}
