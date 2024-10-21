@component('mail::message')
# Confirmação de Compra

Olá, {{ $venda->cliente->nome }}!

Agradecemos por sua compra. Seguem os detalhes do seu pedido:

**Número do Pedido:** {{ $venda->codigo_venda }}  
**Data da Compra:** {{ $venda->data_venda->format('d/m/Y H:i') }}

@component('mail::table')
| Produto       | Quantidade | Preço Unitário | Total  |
| ------------- |:----------:|:--------------:|-------:|
@foreach ($venda->itens as $item)
| {{ $item->produto->nome }} | {{ $item->quantidade }} | {{ formatar_moeda($item->preco_unitario) }} | {{ formatar_moeda($item->subtotal) }} |
@endforeach
@endcomponent

**Total da Compra:** {{ formatar_moeda($venda->total) }}

Para acompanhar o status do seu pedido, clique no link abaixo:

@component('mail::button', ['url' => route('venda.acompanhar-venda', ['codigoVenda' => $venda->codigo_venda])])
Acompanhar Pedido
@endcomponent

Caso tenha dúvidas, entre em contato conosco respondendo a este email.

Agradecemos por sua preferência!

Atenciosamente,  
Equipe {{ config('app.name') }}

@endcomponent
