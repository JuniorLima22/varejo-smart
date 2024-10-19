<div>
    <h2>Carrinho de Compras</h2>    
    <div class="table-responsive">
        <table class="table table-hover table-valign-middle">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Qtd</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Ação</th>
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
    </div>

    @if(!empty($carrinho))
        <button wire:click="limparCarrinho" class="btn btn-outline-warning">Limpar Carrinho</button>
    @endif
</div>