<?php

namespace App\Service;

use App\Models\Cupom;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CupomService
{
    public function __construct(protected Cupom $cupom)
    {
    }

    public function listar(string $pesquisa = null): EloquentBuilder
    {
        $pesquisa = trim($pesquisa);
        $query = $this->cupom->query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                return $query->where('codigo', $pesquisa);
            });

        return $query;
    }

    public function cadastrar(array $dados): Cupom|null
    {
        try {
            $dados['user_id'] = Auth::user()->id;
            return $this->cupom->create($dados);
        } catch (Exception $e) {
            Log::error("Erro ao cadastrar Cupom: ", ['exception' => $e]);
            return null;
        }
    }

    public function listarPorId(int $id): Cupom|null
    {
        try {
            return $this->cupom->findOrFail($id);
        } catch (Exception $e) {
            Log::error("Erro ao listarPorId Cupom: ", ['exception' => $e]);
            return null;
        }
    }

    public function atualizar(array $dados, int $id): bool
    {
        try {
            return $this->cupom->where('id', $id)->update($dados);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar Cupom: ", ['exception' => $e]);
            return false;
        }
    }

    public function deletar(int $id): bool
    {
        try {
            return $this->cupom->where('id', $id)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar Cupom: ", ['exception' => $e]);
            return false;
        }
    }
}
