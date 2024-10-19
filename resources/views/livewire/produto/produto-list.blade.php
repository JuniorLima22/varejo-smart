<div>
    <h2>Produtos</h2>
    <div class="row">
        @foreach($produtos as $produto)
            <div class="col-md-4">
                <div class="card">
                    @if (!is_null($produto->imagem_url))
                        <img src="{{ asset('storage/' . $produto->imagem_url) }}" alt="{{ $produto->nome }}" class="card-img-top mx-auto">
                    @else
                        <img src="{{ asset('img/default-150x150.webp') }}" alt="{{ $produto->nome }}" class="card-img-top mx-auto">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>

                        <p class="card-text">{{ formatar_moeda($produto->preco_venda) }}</p>

                        <button type="button" wire:click="AdicionarAoCarrinho({{ $produto->id }})" wire:key="adicionar-carrinho-{{ $produto->id }}" title="Adicionar ao Carrinho" class="btn btn-outline-secondary">
                            <i class="fa fa-lg fa-fw fa-cart-plus" wire:loading.remove wire:target="AdicionarAoCarrinho({{ $produto->id }})"></i>
                            <span wire:loading wire:target="AdicionarAoCarrinho({{ $produto->id }})">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Carregando...</span>
                            </span>
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>