<div>
    <h2 class="text-center display-4">Acompanhar Pedido</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form wire:submit.prevent="pesquisar">
                <x-adminlte-input type="search" wire:model="codigoVenda" name="codigoVenda" placeholder="Pesquisar por Codigo do Pedido" igroup-size="lg">
                    <x-slot name="appendSlot">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-lg fa-fw fa-search" wire:loading.remove wire:target="pesquisar"></i>
                            <span wire:loading wire:target="pesquisar">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Carregando...</span>
                            </span>
                        </button>
                    </x-slot>
                </x-adminlte-input>
            </form>
        </div>
    </div>

    @if (!empty($codigoVenda))
    <div class="d-flex justify-content-center">
        <x-adminlte-card class="col-md-8 shadow" body-class="p-0">
            <div class="table-responsive">
                <table class="table table-hover table-valign-middle">
                    <tbody>
                        <tr>
                            <th>Cliente:</th>
                            <td>{{ $vendaDetalhe->cliente->nome }}</td>
                        </tr>
                        <tr>
                            <th>Número do Pedido:</th>
                            <td>{{ $vendaDetalhe->codigo_venda }}</td>
                        </tr>
                        <tr>
                            <th>Data da Compra:</th>
                            <td>{{ $vendaDetalhe->data_venda->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Total da Compra:</th>
                            <td>{{ formatar_moeda($vendaDetalhe->total) }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <hr>

                <table class="table table-hover table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-nowrap">Produto</th>
                            <th>Quantidade</th>
                            <th class="text-nowrap">Preço Unitário</th>
                            <th class="text-nowrap">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendaDetalhe->itens as $item)
                            <tr>
                                <td>
                                    <div>
                                        @if (!is_null($item->imagem_url))
                                            <img src="{{ asset('storage/' . $item->imagem_url) }}" alt="{{ $item->nome }}" class="rounded mx-auto" style="width: 100px; height: 150px;">
                                        @else
                                            <img src="{{ asset('img/default-150x150.webp') }}" alt="{{ $item->nome }}" class="rounded mx-auto" style="width: 100px; height: 150px;">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $item->produto->nome }}</td>
                                <td class="text-center">{{ $item->quantidade }}</td>
                                <td class="text-center">{{ formatar_moeda($item->preco_unitario) }}</td>
                                <td class="text-center">{{ formatar_moeda($item->subtotal) }}</td>
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
        </x-adminlte-card>
    </div>
    @endif
    
</div>
