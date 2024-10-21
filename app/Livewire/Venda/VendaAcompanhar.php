<?php

namespace App\Livewire\Venda;

use App\Models\Venda;
use App\Service\VendaService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VendaAcompanhar extends Component
{
    use Toast;

    protected VendaService $vendaService;
    public Venda $vendaDetalhe;
    public ?string $codigoVenda = null;
    public int $venda_id = 0;

    public function boot(
        VendaService $vendaService,
    ): void {
        $this->vendaService = $vendaService;
    }

    public function mount(string $codigoVenda = null): void
    {
        $this->codigoVenda = $codigoVenda ?? '';
        $this->pesquisar();
    }

    public function pesquisar(): void
    {
        if (!empty($this->codigoVenda))
            $this->listarPorCodigoVenda($this->codigoVenda);
    }

    public function listarPorCodigoVenda(string $codigoVenda): void
    {
        $venda = $this->vendaService->listarPorCodigoVenda(trim($codigoVenda));

        if (is_null($venda)) {
            $this->info("Pedido '{$codigoVenda}' não encontrado!");
        } else {
            $this->vendaDetalhe = $venda;
        }
    }

    public function render(): View
    {
        return view('livewire.venda.venda-acompanhar');
    }
}
