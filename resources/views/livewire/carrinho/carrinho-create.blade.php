<div>
    <h2>Carrinho de Compras</h2>
    <x-adminlte-card body-class="p-0" footer-class="p-0">
        <div class="table-responsive">
            <table class="table table-hover table-valign-middle">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Preço</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carrinho as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['quantidade'] }}</td>
                            <td>{{ formatar_moeda($item['preco']) }}</td>
                            <td>{{ formatar_moeda($item['quantidade'] * $item['preco']) }}</td>
                            <td>
                                <button type="button" wire:click="removerProduto({{ $item['id'] }})" wire:key="deletar-item-{{ $item['id'] }}" title="Remover Produto" class="btn btn-xs btn-default text-danger mx-1 shadow">
                                    <i class="fa fa-lg fa-fw fa-trash" wire:loading.remove wire:target="removerProduto({{ $item['id'] }})"></i>
                                    <span wire:loading wire:target="removerProduto({{ $item['id'] }})">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="sr-only">Carregando...</span>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted font-italic font-weight-normal vertical-align-middle bg-light">
                                <i class="fas fa-exclamation-circle"></i> Adicione um produto.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if(!empty($carrinho))
                <button wire:click="limparCarrinho" class="btn btn-block btn-outline-secondary mb-2">Limpar Carrinho</button>
            @endif
        </div>

        @if(!empty($carrinho))
            <x-slot name="footerSlot">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <span class="nav-link text-reset text-bold">
                            Subtotal:
                            <span class="float-right text-dark">
                                {{ formatar_moeda($this->subTotal) }}
                            </span>
                        </span>
                    </li>

                    @if($desconto > 0)
                        <li class="nav-item">
                            <span class="nav-link text-reset text-bold">
                                Desconto Aplicado:
                                <span class="float-right text-dark">
                                    {{ $desconto }}%
                                </span>
                            </span>
                        </li>
                    @endif

                    <li class="nav-item">
                        <span class="nav-link text-reset text-bold">
                            Total:
                            <span class="float-right text-dark">
                                {{ formatar_moeda($this->total) }}
                            </span>
                        </span>
                    </li>
                </ul>
            </x-slot>
        @endif
    </x-adminlte-card>

    @if(!empty($carrinho))
        <div>
            <x-adminlte-input wire:model="cupomCodigo" wire:keydown.enter="aplicarCupom" name="cupomCodigo" placeholder="Inserir cupom" autocomplete="off" enable-old-support>
                <x-slot name="appendSlot">
                    <button type="button" wire:click="aplicarCupom" title="Aplicar Cumpom" class="btn btn-outline-dark">
                        <span wire:loading wire:target="aplicarCupom">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Carregando...</span>
                        </span>
                        Aplicar
                    </button>
                </x-slot>
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Insira um código de cupom válido similar: <strong>CUP-LYEUZA</strong>
                    </span>
                </x-slot>
            </x-adminlte-input>
        </div>
    @endif
</div>