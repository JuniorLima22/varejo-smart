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
                        <th colspan="2">Total</th>
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
                            @error('carrinho')
                                <td colspan="5" class="text-center vertical-align-middle">
                                    <span class="invalid-feedback d-block mt-0" role="alert">
                                        <strong><i class="fas fa-exclamation-circle"></i> {{ $message }}</strong>
                                    </span>
                                </td>
                            @else
                                <td colspan="5" class="text-center text-muted font-italic font-weight-normal vertical-align-middle bg-light">
                                    <i class="fas fa-exclamation-circle"></i> Adicione um produto.
                                </td>
                            @enderror
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
                        Insira um código de cupom válido.
                        @forelse ($cupons as $cupom)
                            <strong>{{ $cupom->codigo }}</strong>@if(!$loop->last), @endif
                        @empty
                            <strong>CUP-LYEUZA</strong>
                        @endforelse
                    </span>
                </x-slot>
            </x-adminlte-input>
        </div>
    @endif

    <x-adminlte-card>
        <h2>Dados do Cliente</h2>
        <div class="form-row">
            <div class="col">
                @php
                    $options = [];
                    foreach ($clientes as $key => $value) {
                        $options[$value->id] = $value->nome;
                    }
                    $cliente_id = $cliente_id ?? null;
                @endphp

                <x-adminlte-select wire:change="detalhesCliente" wire:model="cliente_id" name="cliente_id" enable-old-support>
                    <x-adminlte-options :options="$options" :selected="$cliente_id" placeholder="Selecione um cliente" />
                </x-adminlte-select>
            </div>
        </div>

        @if (isset($clienteDetalhe))
            <div class="form-row">
                <div class="col">
                    <address>
                        <strong>Telefone:</strong> {{ $clienteDetalhe->telefone ?? '' }}<br>
                        <strong>CPF:</strong> {{ $clienteDetalhe->cpf ?? '' }}<br>
                        <strong>Email:</strong> {{ $clienteDetalhe->email ?? '' }}<br>
                        <strong>Endereço:</strong> 
                        {{ $clienteDetalhe?->logradouro }}, 
                        {{ $clienteDetalhe?->numero }}, 
                        {{ $clienteDetalhe?->cidade }}, 
                        {{ $clienteDetalhe?->bairro }},
                        {{ $clienteDetalhe?->cep }}, 
                        {{ $clienteDetalhe?->complemento }}
                    </address>
                </div>
            </div>
        @endif

        <button type="button" wire:click="finalizarCompra" class="btn btn-success btn-block" @if (!isset($clienteDetalhe)) disabled @endif>
            <span wire:loading wire:target="finalizarCompra">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="sr-only">Carregando...</span>
            </span>
            FINALIZAR COMPRA
        </button>
    </x-adminlte-card>

    @section('js')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
    @stop
</div>