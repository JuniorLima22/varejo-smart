<?php

namespace App\Livewire\Cliente;

use App\Http\Requests\ClienteRequest;
use App\Service\ClienteService;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ClienteCreate extends Component
{
    use Toast;
    protected ClienteService $clienteService;

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

    public function boot(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function rules(): array
    {
        return (new ClienteRequest())->rules();
    }

    public function store(): void
    {
        $cliente = $this->clienteService->cadastrar($this->validate());

        if ($cliente != null) {
            $this->sucesso($this->registro_cadastrado);
            $this->reset();
        } else {
            $this->error($this->registro_erro_cadastrar);
        }
    }

    public function render(): View
    {
        return view('livewire.cliente.cliente-create');
    }
}
