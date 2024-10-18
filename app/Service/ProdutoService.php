<?php

namespace App\Service;

use App\Models\Produto;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProdutoService
{
    public function __construct(protected Produto $produto)
    {
    }

    public function listar(string $pesquisa = null, int $categoriaId): EloquentBuilder
    {
        $pesquisa = trim($pesquisa);
        $query = $this->produto->query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                return $query->where('nome', 'ilike', "%{$pesquisa}%")
                    ->orWhere('descricao', 'ilike', "%{$pesquisa}%");
            })
            ->when($categoriaId, function ($query) use ($categoriaId) {
                return $query->where('categoria_id', $categoriaId);
            });

        return $query;
    }

    public function cadastrar(array $dados): Produto|null
    {
        try {
            $dados['user_id'] = Auth::user()->id;
            return $this->produto->create($dados);
        } catch (Exception $e) {
            Log::error("Erro ao cadastrar Produto: ", ['exception' => $e]);
            return null;
        }
    }

    public function listarPorId(int $id): Produto|null
    {
        try {
            return $this->produto->findOrFail($id);
        } catch (Exception $e) {
            Log::error("Erro ao listarPorId Produto: ", ['exception' => $e]);
            return null;
        }
    }

    public function atualizar(array $dados, int $id): bool
    {
        try {
            return $this->produto->where('id', $id)->update($dados);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar Produto: ", ['exception' => $e]);
            return false;
        }
    }

    public function deletar(int $id): bool
    {
        try {
            return $this->produto->where('id', $id)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar Produto: ", ['exception' => $e]);
            return false;
        }
    }
}
