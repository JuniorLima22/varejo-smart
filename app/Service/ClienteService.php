<?php

namespace App\Service;

use App\Models\Cliente;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClienteService
{
    public function __construct(protected Cliente $cliente)
    {
    }

    public function listar(string $pesquisa = null): EloquentBuilder
    {
        $pesquisa = trim($pesquisa);
        $query = $this->cliente->query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                return $query->where('nome', 'ilike', "%{$pesquisa}%")
                    ->orWhere('cpf', 'ilike', "%{$pesquisa}%")
                    ->orWhere('email', 'ilike', "%{$pesquisa}%")
                    ->orWhere('telefone', 'ilike', "%{$pesquisa}%");
            });

        return $query;
    }

    public function cadastrar(array $dados): Cliente|null
    {
        try {
            $dados['user_id'] = Auth::user()->id;
            return $this->cliente->create($dados);
        } catch (Exception $e) {
            Log::error("Erro ao cadastrar Cliente: ", ['exception' => $e]);
            return null;
        }
    }

    public function listarPorId(int $id): Cliente|null
    {
        try {
            return $this->cliente->findOrFail($id);
        } catch (Exception $e) {
            Log::error("Erro ao listarPorId Cliente: ", ['exception' => $e]);
            return null;
        }
    }

    public function atualizar(array $dados, int $id): bool
    {
        try {
            return $this->cliente->where('id', $id)->update($dados);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar Cliente: ", ['exception' => $e]);
            return false;
        }
    }

    public function deletar(int $id): bool
    {
        try {
            return $this->cliente->where('id', $id)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar Cliente: ", ['exception' => $e]);
            return false;
        }
    }
}
