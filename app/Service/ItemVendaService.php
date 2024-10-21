<?php

namespace App\Service;

use App\Models\ItemVenda;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemVendaService
{
    public function __construct(
        protected ItemVenda $itemVenda
    ) {
    }

    public function atualizarCadastrar(array $dados, int $vendaId): bool
    {
        try {
            DB::beginTransaction();
            $this->deletarPorVendaId($vendaId);

            foreach ($dados as $item) {
                $dados = [
                    'venda_id' => $vendaId,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco'],
                    'subtotal' => $item['preco'] * $item['quantidade'],
                ];
                $this->itemVenda->create($dados);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error("Erro ao atualizarCadastrar ItemVenda: ", ['exception' => $e]);
            DB::rollBack();
            return false;
        }
    }

    public function listarPorVendaId(int $vendaId): Collection
    {
        try {
            return $this->itemVenda->where('venda_id', $vendaId)->get();
        } catch (Exception $e) {
            Log::error("Erro ao listarPorVendaId ItemVenda: ", ['exception' => $e]);
            return Collection::empty();
        }
    }

    public function deletarPorVendaId(int $vendaId): void
    {
        try {
            $this->itemVenda->where('venda_id', $vendaId)->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar ItemVenda: ", ['exception' => $e]);
        }
    }
}
