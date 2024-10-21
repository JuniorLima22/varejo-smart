<?php

namespace App\Service;

use App\Enums\StatusVendaEnum;
use App\Models\Venda;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VendaService
{
    public function __construct(
        protected Venda $venda,
        protected ItemVendaService $itemVendaService
    ) {
    }

    public function listar(string $pesquisa = null, string $status = StatusVendaEnum::PENDENTE->value): EloquentBuilder
    {
        $pesquisa = trim($pesquisa);
        $query = $this->venda->query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                return $query->whereLike('codigo_venda', "%{$pesquisa}%");
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            });

        return $query;
    }

    public function cadastrar(array $dados): Venda|null
    {
        try {
            $dados['codigo_venda'] = $this->venda::gerarCodigoVenda();
            $dados['status'] = StatusVendaEnum::PENDENTE->value;
            $dados['data_venda'] = now();
            $dados['vendedor_id'] = Auth::user()->id;

            $venda = $this->venda->create($dados);

            if ($venda && isset($dados['carrinho']))
                $this->itemVendaService->atualizarCadastrar($dados['carrinho'], $venda->id);

            return $venda;
        } catch (Exception $e) {
            Log::error("Erro ao cadastrar Venda: ", ['exception' => $e]);
            return null;
        }
    }

    public function listarPorId(int $id): Venda|null
    {
        try {
            return $this->venda->with('cliente', 'vendedor', 'itens.produto')->findOrFail($id);
        } catch (Exception $e) {
            Log::error("Erro ao listarPorId Venda: ", ['exception' => $e]);
            return null;
        }
    }

    public function atualizar(array $dados, int $id): bool
    {
        try {
            return $this->venda->where('id', $id)->update($dados);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar Venda: ", ['exception' => $e]);
            return false;
        }
    }

    public function deletar(int $id): bool
    {
        try {
            return $this->venda->where('id', $id)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar Venda: ", ['exception' => $e]);
            return false;
        }
    }
}
