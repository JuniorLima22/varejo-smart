<div>
    <x-adminlte-card class="shadow">
        <div class="form-row">
            <div class="col-md-6">
                <x-adminlte-input type="search" wire:model.live.debounce.1000ms="pesquisa" name="pesquisa" label="Pesquisar" placeholder="Pesquisar por Codigo da Venda" autocomplete="off" enable-old-support>
                    <x-slot name="appendSlot">
                        <div class="input-group-text text-dark">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>

            <div class="col-sm-12 col-md-6">
                @php
                    $options = ['' => 'Todos'];
                    foreach ($statusEnum as $key => $status) {
                        $options[$status] = Str::ucfirst($status);
                    }                
                    $statusEnum = $statusEnum ?? null;
                @endphp
                <x-adminlte-select wire:model.live="status" name="status" label="Status" enable-old-support>
                    <x-adminlte-options :options="$options" :selected="$statusEnum" placeholder="Selecione o status" />
                </x-adminlte-select>
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
            <table class="table table-hover table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th wire:click="ordenarPor('codigo_venda')" class="text-nowrap" role="button">
                            Código
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'codigo_venda' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'codigo_venda' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('total')" class="text-nowrap" role="button">
                            Valor Total
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'total' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'total' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('cupom_id')" class="text-nowrap" role="button">
                            Cupom
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'cupom_id' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'cupom_id' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('cliente_id')" class="text-nowrap" role="button">
                            Cliente
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'cliente_id' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'cliente_id' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('vendedor_id')" class="text-nowrap" role="button">
                            Vendedor
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'vendedor_id' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'vendedor_id' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('status')" class="text-nowrap" role="button">
                            Status
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'status' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'status' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('data_venda')" class="text-nowrap" role="button">
                            Data Venda
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'data_venda' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'data_venda' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        {{-- <th style="width:5%">
                            Ações
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendas as $venda)
                        @php
                            switch ($venda->status->value) {
                                case 'pendente': $badgeStyle = 'secondary'; break;
                                case 'pago': $badgeStyle = 'primary'; break;
                                case 'cancelado': $badgeStyle = 'danger'; break;
                                case 'enviado': $badgeStyle = 'warning'; break;
                                case 'concluido': $badgeStyle = 'success'; break;
                                default: $badgeStyle = 'info disabled color-palette'; break;
                            }
                        @endphp
                        <tr>
                            <td class="text-bold text-muted">
                                {{ $venda->codigo_venda }}
                            </td>
                            <td class="text-center">{{ formatar_moeda($venda->total) }}</td>
                            <td>
                                @if ($venda->cupom?->codigo)
                                    {{ $venda->cupom?->codigo }} ({{ $venda->cupom?->desconto_percentual }}%)
                                @endif
                            </td>
                            <td>{{ $venda->cliente->nome }}</td>
                            <td>{{ $venda->vendedor->name }}</td>
                            <td><span class="badge badge-pill badge-{{ $badgeStyle }}">{{ Str::ucfirst($venda->status->value) }}</span></td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($venda->data_venda)) }}</td>
                            {{-- <td>
                                <nobr>
                                    <button type="button" wire:click="show({{ $venda->id }})" wire:key="detalhe-{{ $venda->id }}" title="Detalhes do produto" class="btn btn-xs btn-default text-teal mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-eye" wire:loading.remove wire:target="show({{ $venda->id }})"></i>
                                        <span wire:loading wire:target="show({{ $venda->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>

                                    <x-adminlte-button title="Editar produto" class="btn btn-xs btn-default text-primary mx-1 shadow" icon="fa fa-lg fa-fw fa-pen" onclick="location.href='{{ route('produto.edit', ['id' => $venda->id]) }}'"/>

                                    <button type="button" wire:click="confirmarDeletar({{ $venda->id }})" wire:key="deletar-{{ $venda->id }}" title="Deletar produto" class="btn btn-xs btn-default text-danger mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-trash" wire:loading.remove wire:target="confirmarDeletar({{ $venda->id }})"></i>
                                        <span wire:loading wire:target="confirmarDeletar({{ $venda->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>
                                </nobr>
                            </td> --}}
                        </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted font-italic font-weight-normal vertical-align-middle bg-light">
                            <i class="fas fa-exclamation-circle"></i> Nenhum registro encontrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
                {{ $vendas->onEachSide(1)->links() }}
        </div>
    </x-adminlte-card>

    <x-adminlte-modal id="modal_detalhe" title="Detalhes do Produto" size='lg' scrollable>
        <table class="table table-sm table-hover table-valign-middle">
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td>{{ $vendaDetalhe?->id }}</td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $vendaDetalhe->nome ?? '' }}</td>
                </tr>
                <tr>
                    <th>Descrição:</th>
                    <td>{{ $vendaDetalhe->descricao ?? '' }}</td>
                </tr>
                <tr>
                    <th>Categoria:</th>
                    <td>{{ $vendaDetalhe->categoria->nome ?? '' }}</td>
                </tr>
                <tr>
                    <th>Preço de Compra:</th>
                    <td>{{ formatar_moeda($vendaDetalhe?->preco_compra) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Preço de Venda:</th>
                    <td>{{ formatar_moeda($vendaDetalhe?->preco_venda) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Qtd em Estoque:</th>
                    <td>{{ $vendaDetalhe->quantidade ?? '' }}</td>
                </tr>
                <tr>
                    <th>Imagem do Produto:</th>
                    <td>
                        @if (!is_null($vendaDetalhe->imagem_url ?? null))
                            <div>
                                <img src="{{ asset('storage/' . $vendaDetalhe->imagem_url) }}" class="img-thumbnail rounded mx-auto mb-3 h-50">
                            </div>
                        @else
                            <img src="{{ asset('img/default-150x150.webp') }}" class="img-thumbnail rounded mx-auto mb-3 h-50">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Data de cadastro:</th>
                    <td>{{ date('d/m/Y H:i:s', strtotime($vendaDetalhe?->created_at)) }}</td>
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
        <p class="text-wrap text-center">O Produto <strong>{{ $vendaDetalhe?->nome }}</strong> será deletado da base de dados. <br> Deseja realmente executar esta ação?</p>

        <x-slot name="footerSlot">
            <div class="justify-content-end">
                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>

                <button type="button" wire:click="delete({{ $vendaDetalhe?->id}})" class="btn btn-outline-success ml-2">
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
