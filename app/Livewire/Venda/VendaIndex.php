<?php

namespace App\Livewire\Venda;

use App\Enums\StatusVendaEnum;
use App\Models\Venda;
use App\Service\ItemVendaService;
use App\Service\VendaService;
use App\Traits\DataTable;
use App\Traits\Modal;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class VendaIndex extends Component
{
    use WithPagination;
    use DataTable, Modal, Toast;

    protected VendaService $vendaService;
    protected ItemVendaService $itemVendaService;
    public Venda $vendaDetalhe;
    protected string $paginationTheme = 'bootstrap';
    public string $pesquisa = '';
    public int $venda_id = 0;
    public string $status = '';

    public function boot(
        VendaService $vendaService,
        ItemVendaService $itemVendaService
    ): void {
        $this->vendaService = $vendaService;
        $this->itemVendaService = $itemVendaService;
    }

    public function updating(): void
    {
        $this->resetPage();
    }
    
    public function render(): View
    {
        $vendas = $this->vendaService->listar($this->pesquisa, $this->status)
            ->with('cliente', 'vendedor', 'cupom')
            ->orderBy($this->classificarNomeColuna, $this->classificarDirecao)
            ->paginate($this->itemPorPagina());

        $statusEnum = StatusVendaEnum::valores();
        return view('livewire.venda.venda-index', compact('vendas', 'statusEnum'));
    }
}
