<div>
    <x-adminlte-card class="shadow">
        <div class="form-row">
            <div class="col-md-6">
                <x-adminlte-input type="search" wire:model.live.debounce.1000ms="pesquisa" name="pesquisa" label="Pesquisar" placeholder="Pesquisar por Nome ou Descrição do Produto" autocomplete="off" enable-old-support>
                    <x-slot name="appendSlot">
                        <div class="input-group-text text-dark">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>

            <div class="col-md-6">
                <x-adminlte-select wire:model.live="categoria_id" name="categoria_id" label="Categorias" label-class="required" enable-old-support>
                    <option/>
                    @foreach ($categorias as $categoriaPai)
                        <optgroup label="{{ $categoriaPai->nome }}">
                            @foreach ($categoriaPai->subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id }}" @selected($subcategoria->id == $categoria_id)>{{ $subcategoria->nome }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
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
                        <th wire:click="ordenarPor('descricao')" class="text-nowrap" role="button">
                            Descricao
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'descricao' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'descricao' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('categoria_id')" class="text-nowrap" role="button">
                            Categoria
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'categoria_id' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'categoria_id' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('preco_compra')" class="text-nowrap" role="button">
                            Preço de Compra
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'preco_compra' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'preco_compra' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('preco_venda')" class="text-nowrap" role="button">
                            Preço de Venda
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'preco_venda' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'preco_venda' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
                            </span>
                        </th>
                        <th wire:click="ordenarPor('quantidade')" class="text-nowrap" role="button">
                            Quantidade
                            <span class="text-sm d-inline ml-2">
                                <i class="fa fa-xs fa-arrow-up {{ $classificarNomeColuna === 'quantidade' && $classificarDirecao === 'asc' ? '' : 'text-muted' }}" aria-hidden="true" ></i>
                                <i class="fa fa-xs fa-arrow-down {{ $classificarNomeColuna === 'quantidade' && $classificarDirecao === 'desc' ? '' : 'text-muted' }}" aria-hidden="true"></i>
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
                    @forelse($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->categoria->nome }}</td>
                            <td>{{ $produto->preco_compra }}</td>
                            <td>{{ $produto->preco_venda }}</td>
                            <td>{{ $produto->quantidade }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($produto->updated_at)) }}</td>
                            <td>
                                <nobr>
                                    <button type="button" wire:click="show({{ $produto->id }})" wire:key="detalhe-{{ $produto->id }}" title="Detalhes do produto" class="btn btn-xs btn-default text-teal mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-eye" wire:loading.remove wire:target="show({{ $produto->id }})"></i>
                                        <span wire:loading wire:target="show({{ $produto->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>

                                    <x-adminlte-button title="Editar produto" class="btn btn-xs btn-default text-primary mx-1 shadow" icon="fa fa-lg fa-fw fa-pen" onclick="location.href='{{ route('produto.edit', ['id' => $produto->id]) }}'"/>

                                    <button type="button" wire:click="confirmarDeletar({{ $produto->id }})" wire:key="deletar-{{ $produto->id }}" title="Deletar produto" class="btn btn-xs btn-default text-danger mx-1 shadow">
                                        <i class="fa fa-lg fa-fw fa-trash" wire:loading.remove wire:target="confirmarDeletar({{ $produto->id }})"></i>
                                        <span wire:loading wire:target="confirmarDeletar({{ $produto->id }})">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Carregando...</span>
                                        </span>
                                    </button>
                                </nobr>
                            </td>
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
                {{ $produtos->onEachSide(1)->links() }}
        </div>
    </x-adminlte-card>

    <x-adminlte-modal id="modal_detalhe" title="Detalhes do Produto" size='lg' scrollable>
        <table class="table table-sm table-hover">
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td>{{ $produtoDetalhe?->id }}</td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $produtoDetalhe->nome ?? '' }}</td>
                </tr>
                <tr>
                    <th>Descrição:</th>
                    <td>{{ $produtoDetalhe->descricao ?? '' }}</td>
                </tr>
                <tr>
                    <th>Categoria:</th>
                    <td>{{ $produtoDetalhe->categoria->nome ?? '' }}</td>
                </tr>
                <tr>
                    <th>Preço de Compra:</th>
                    <td>{{ $produtoDetalhe->preco_compra ?? '' }}</td>
                </tr>
                <tr>
                    <th>Preço de Venda:</th>
                    <td>{{ $produtoDetalhe->preco_venda ?? '' }}</td>
                </tr>
                <tr>
                    <th>Qtd em Estoque:</th>
                    <td>{{ $produtoDetalhe->quantidade ?? '' }}</td>
                </tr>
                <tr>
                    <th>Imagem do Produto:</th>
                    <td>
                        @if (!is_null($produtoDetalhe->imagem_url ?? null))
                        <div>
                            <img src="{{ asset('storage/' . $produtoDetalhe->imagem_url) }}" class="img-thumbnail rounded mx-auto mb-3 h-50">
                        </div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Data de cadastro:</th>
                    <td>{{ date('d/m/Y H:i:s', strtotime($produtoDetalhe?->created_at)) }}</td>
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
        <p class="text-wrap text-center">O Produto <strong>{{ $produtoDetalhe?->nome }}</strong> será deletado da base de dados. <br> Deseja realmente executar esta ação?</p>

        <x-slot name="footerSlot">
            <div class="justify-content-end">
                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>

                <button type="button" wire:click="delete({{ $produtoDetalhe?->id}})" class="btn btn-outline-success ml-2">
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
