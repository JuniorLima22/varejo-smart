<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Service\ClienteService;
use App\Traits\DataTable;
use App\Traits\Modal;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;
    use DataTable, Modal, Toast;

    protected ClienteService $clienteService;
    public Cliente $clienteDetalhe;
    protected string $paginationTheme = 'bootstrap';
    public string $pesquisa = '';

    public function boot(ClienteService $clienteService): void
    {
        $this->clienteService = $clienteService;
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function show($id): void
    {
        $this->clienteDetalhe = $this->clienteService->listarPorId($id);
        $this->modal('cliente_detalhe');
    }

    public function confirmarDeletar($id): void
    {
        $this->clienteDetalhe = $this->clienteService->listarPorId($id);
        $this->modal('confirmar_deletar');
    }

    public function delete($id)
    {
        $cliente = $this->clienteService->deletar($id);

        $this->clienteDetalhe = $this->clienteDetalhe->make();

        $this->modal('confirmar_deletar', 'hide');

        if (!$cliente)
            return $this->error($this->registro_erro_deletar);

        return $this->sucesso($this->registro_deletado);
    }

    public function render(): View
    {
        $clientes = $this->clienteService->listar($this->pesquisa)
            ->orderBy($this->classificarNomeColuna, $this->classificarDirecao)
            ->paginate($this->itemPorPagina());

        return view('livewire.cliente.cliente-index', compact('clientes'));
    }
}
