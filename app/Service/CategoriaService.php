<?php

namespace App\Service;

use App\Models\Categoria;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriaService
{
    public function __construct(protected Categoria $categoria)
    {
    }

    public function listar(string $pesquisa = null): EloquentBuilder
    {
        $pesquisa = trim($pesquisa);
        $query = $this->categoria->query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                return $query->where('nome', 'ilike', "%{$pesquisa}%")
                    ->orWhere('parent_id', (int) $pesquisa);
            });

        return $query;
    }

    public function listarComSubcategorias(): Collection
    {
        try {
            return $this->categoria->with('subcategorias:id,nome,parent_id')
                ->whereNull('parent_id')
                ->get(['id', 'nome']);
        } catch (Exception $e) {
            Log::error("Erro ao listarComSubcategorias: ", ['exception' => $e]);
            return Collection::empty();
        }
    }

    public function listarComCategoriaPai(): Collection
    {
        try {
            return $this->categoria->with('categoriaPai:id,nome,parent_id')->get(['id', 'nome', 'parent_id']);
        } catch (Exception $e) {
            Log::error("Erro ao listarComCategoriaPai: ", ['exception' => $e]);
            return Collection::empty();
        }
    }

    public function listarProdutos(): Collection
    {
        try {
            return $this->categoria->produtos()->orderBy('id', 'desc')->get();
        } catch (Exception $e) {
            Log::error("Erro ao listarProdutos de Categorias: ", ['exception' => $e]);
            return Collection::empty();
        }
    }

    public function cadastrar(array $dados): Categoria|null
    {
        try {
            $dados['user_id'] = Auth::user()->id;
            return $this->categoria->create($dados);
        } catch (Exception $e) {
            Log::error("Erro ao cadastrar Categoria: ", ['exception' => $e]);
            return null;
        }
    }

    public function listarPorId(int $id): Categoria|null
    {
        try {
            return $this->categoria->findOrFail($id);
        } catch (Exception $e) {
            Log::error("Erro ao listarPorId Categoria: ", ['exception' => $e]);
            return null;
        }
    }

    public function atualizar(array $dados, int $id): bool
    {
        try {
            return $this->categoria->where('id', $id)->update($dados);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar Categoria: ", ['exception' => $e]);
            return false;
        }
    }

    public function deletar(int $id): bool
    {
        try {
            return $this->categoria->where('id', $id)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar Categoria: ", ['exception' => $e]);
            return false;
        }
    }
}
