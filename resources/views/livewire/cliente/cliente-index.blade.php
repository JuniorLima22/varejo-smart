<div>
    <x-adminlte-card class="shadow">
        <div class="form-row">
            <div class="col-12">
                <x-adminlte-input type="search" wire:model.live.debounce.1000ms="pesquisa" name="pesquisa" label="Pesquisar" placeholder="Pesquisar por Nome, CPF, Email ou Telefone" autocomplete="off" enable-old-support>
                    <x-slot name="appendSlot">
                        <div class="input-group-text text-dark">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
    </x-adminlte-card>

    <x-adminlte-card class="shadow" body-class="p-0">
        <x-slot name="toolsSlot">
            <div class="input-group input-group-sm">
                <span wire:loading class="mt-1 mr-2">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Carregando...</span>
                </span>

                <x-adminlte-input type="number" wire:model.live.debounce.850ms="porPagina" name="porPagina" placeholder="50" fgroup-class="mb-0" class="form-control-border bg-light" autocomplete="off" min="0" style="width:105px;">
                    <x-slot name="appendSlot">
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            @php
                                $opcao = [50, 75, 100, 200, 300, 500];
                            @endphp
                            @foreach ($opcao as $item)
                                <a class="dropdown-item" href="#" wire:click.prevent="$set('porPagina', {{ $item }})">{{ $item }}</a>
                            @endforeach
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th wire:click="ordenarPor('nome')" class="text-nowrap" role="button">
                            Nome
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'nome' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'nome' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('cpf')" class="text-nowrap" role="button">
                            CPF
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'cpf' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'cpf' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('email')" class="text-nowrap" role="button">
                            Email
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'email' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'email' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('telefone')" class="text-nowrap" role="button">
                            Telefone
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'telefone' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'telefone' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('updated_at')" class="text-nowrap" role="button">
                            Data Modificado
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'updated_at' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'updated_at' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th style="width:5%">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->cpf }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($cliente->updated_at)) }}</td>
                            <td>
                                <nobr>
                                    <button type="button" wire:click="show({{ $cliente->id }})" wire:key="detalhe-{{ $cliente->id }}" title="Detalhes do Cliente" class="btn btn-xs btn-default text-teal mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-eye" wire:loading.remove wire:target="show({{ $cliente->id }})"></i>
                                        <span wire:loading wire:target="show({{ $cliente->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>

                                    <x-adminlte-button title="Editar Cliente" class="btn btn-xs btn-default text-primary mx-1 shadow" icon="fa fa-lg fa-fw fa-pen" onclick="location.href='{{ route('cliente.edit', ['id' => $cliente->id]) }}'"/>

                                    <button type="button" wire:click="confirmarDeletar({{ $cliente->id }})" wire:key="deletar-{{ $cliente->id }}" title="Deletar Cliente" class="btn btn-xs btn-default text-danger mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-trash" wire:loading.remove wire:target="confirmarDeletar({{ $cliente->id }})"></i>
                                        <span wire:loading wire:target="confirmarDeletar({{ $cliente->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>
                                </nobr>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted font-italic font-weight-normal vertical-align-middle bg-light">
                            <i class="fas fa-exclamation-circle"></i> Nenhum registro encontrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
                {{ $clientes->onEachSide(1)->links() }}
        </div>
    </x-adminlte-card>

    <x-adminlte-modal id="cliente_detalhe" title="Detalhes do Cliente" size='lg' scrollable>
        <table class="table table-sm table-hover">
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td>{{ $clienteDetalhe?->id }}</td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $clienteDetalhe->nome ?? '' }}</td>
                </tr>
                <tr>
                    <th>CPF:</th>
                    <td>{{ $clienteDetalhe->cpf ?? '' }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $clienteDetalhe->email ?? '' }}</td>
                </tr>
                <tr>
                    <th>Telefone:</th>
                    <td>{{ $clienteDetalhe->telefone ?? '' }}</td>
                </tr>
                <tr>
                    <th>Endereço:</th>
                    <td>
                        {{ $clienteDetalhe?->logradouro }}, 
                        {{ $clienteDetalhe?->numero }}, 
                        {{ $clienteDetalhe?->cidade }}, 
                        {{ $clienteDetalhe?->bairro }}, 
                        {{ $clienteDetalhe?->cep }}, 
                        {{ $clienteDetalhe?->complemento }}
                    </td>
                </tr>
                <tr>
                    <th>Data de cadastro:</th>
                    <td>{{ date('d/m/Y H:i:s', strtotime($clienteDetalhe?->created_at)) }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footerSlot">
            <div class="justify-content-end">
                <x-adminlte-button theme="outline-secondary" label="Fechar" data-dismiss="modal" />
            </div>
        </x-slot>
    </x-adminlte-modal>

    <x-adminlte-modal id="confirmar_deletar" title="Exclusão de Cliente" static-backdrop>
        <p class="text-wrap text-center">O Cliente <strong>{{ $clienteDetalhe?->nome }}</strong> será deletado da base de dados. <br> Deseja realmente executar esta ação?</p>

        <x-slot name="footerSlot">
            <div class="justify-content-end">
                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>

                <button type="button" wire:click="delete({{ $clienteDetalhe?->id}})" class="btn btn-outline-success ml-2">
                    <span wire:loading wire:target="delete">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Carregando...</span>
                    </span>
                    Deletar
                </button>
            </div>
        </x-slot>
    </x-adminlte-modal>
</div>
