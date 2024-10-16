<?php

namespace App\Livewire\Cliente;

use App\Http\Requests\ClienteRequest;
use App\Service\ClienteService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ClienteEdit extends Component
{
    use Toast;
    protected ClienteService $clienteService;

    public int $clienteId;
    public string $nome;
    public string $cpf;
    public string $telefone;
    public string $email;
    public string $cep;
    public string $logradouro;
    public string $numero;
    public string $cidade;
    public string $bairro;
    public string $complemento;

    public function boot(ClienteService $clienteService): void
    {
        $this->clienteService = $clienteService;
    }

    public function mount($id): void
    {
        $this->definirValoresPadroes($id);
    }

    public function rules(): array
    {
        return (new ClienteRequest())->rules($this->clienteId);
    }

    protected function definirValoresPadroes(int $clienteId)
    {
        $this->clienteId = $clienteId;
        $cliente = $this->clienteService->listarPorId($clienteId);

        if (is_null($cliente))
            return redirect()->route('cliente.index');

        $this->fill(
            $cliente->only(
                'nome',
                'cpf',
                'telefone',
                'email',
                'cep',
                'logradouro',
                'numero',
                'cidade',
                'bairro',
                'complemento'
            )
        );
    }

    public function update(): void
    {
        $cliente = $this->clienteService->atualizar($this->validate(), $this->clienteId);

        if ($cliente) {
            $this->sucesso($this->registro_atualizado);
        } else {
            $this->error($this->registro_erro_atualizar);
        }
    }

    public function render(): View
    {
        return view('livewire.cliente.cliente-edit');
    }
}
