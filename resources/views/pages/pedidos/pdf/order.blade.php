<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Impressão do pedido #{{isset($pedidoloja) ? $pedidoloja->numberorder : $pedido->id}}</title>
</head>

<style>
  body{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
  }
  .details {
    width: 100%;
    max-width: 80px;
    margin: 0 auto;
  }
  .header-pedido{
    text-align: center;
    width: 100%;
    display: inline;
  }
  .details{
    width: 100%;
    min-width: 250px;
  }
  .pedido{
    width: 100%;
    text-align: left;
    margin-bottom: 5px;
  }
  .pedido p{
    margin: 0 auto
  }
  .itens{
    width: 100%;
    display: block;
  }
  .itens ul {
    list-style: none;
    padding: 0;
    margin-bottom: 0px;
  }
  .itens ul li {
    padding: 5px 0;
  }
  .logo-container img{
    width: 100%;
    max-width: 100px;
    text-align: center;
    margin: 0 0 0 70px
  }
  .cabecalho{
    text-align: center;
    margin-bottom: 5px;
  }
  .cabecalho p{
    margin: 0 auto;
    padding: 3px 0;
  }
  .titulo-sessao {
    font-size: 14px;
    font-weight: 600;
    text-align: left;
    margin-top: 0;
    background: #ccc;
    border: 1px solid #797979;
  }
  .detail-list {
    text-transform: uppercase;
    padding: 1px 3px;
    font-size: 12px;
    font-weight: 600;
  }
  .lista-itens{
    border-bottom: 1px solid #ccc;
    padding-bottom: 8px;
  }
  .cliente {
    margin-bottom: 5px;
  }
  .footer, h5, h6 {
    text-align: center;
    font-size: 12px;
    margin: 10px 0;
  }
  .footer {
    margin-top: 20px;
  }
  .assinatura-cliente {
    text-align: center;
  }
  .assinatura-cliente p {
    margin-bottom: 0;
    margin-top: 20px;
  }
</style>

<body>
  <div class="details">
    <div class="logo-container">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Impressão">
    </div>
    <div class="cabecalho">
      <p>Endereço: Epifânio Beletati Nº 181</p>
      <p>Cidade: Morro Agudo</p>
      <p>Telefone: (16) 99251-7031</p>
    </div>
    <p class="titulo-sessao">Detalhes do Pedido</p>
    <div class="pedido">
      <p>Pedido #ID: {{isset($pedidoloja) ? $pedidoloja->numberorder : $pedido->id}}</p>
      <p>Pedido Realizado: {{isset($pedidoloja) ? $pedidoloja->created_at->format('d/m/Y H:i:s') : $pedido->created_at->format('d/m/Y H:i:s')}}</p>
    </div>
    <div class="cliente">
      <p class="titulo-sessao">Dados do cliente</p>
      Nome: {{isset($pedidoloja) ? $pedidoloja->user->name : $pedido->contato->nome}}<br>
      Endereço: {{isset($pedidoloja) ? $pedidoloja->endereco->endereco : $pedido->endereco->endereco}}; Nº {{isset($pedidoloja) ? $pedidoloja->endereco->numero : $pedido->endereco->numero}}<br>
      Bairro: {{isset($pedidoloja) ? $pedidoloja->endereco->bairro : $pedido->endereco->bairro}}; Tel: {{isset($pedidoloja) ? $pedidoloja->endereco->telefone : $pedido->contato->telefone}}
      Observação: {{isset($pedidoloja) ? $pedidoloja->observacao : $pedido->observacao}}
    </div>
    <div class="itens">
      <p class="titulo-sessao">Detalhes dos Itens</p>
      <p>Qtde | Produto {{!isset($pedidoloja) ? '| Obs | Unit' : ''}} | Total</p>
      <ul>
      <li>
        @if(isset($pedidoloja))
        @foreach ($pedidoloja->orderitems as $item)
          {{$item->qtde}} |
          {{$item->produtos->descricao}}
          R$ {{number_format($item->preco * $item->qtde, 2, ',', '.')}}
            Adicional:
          @foreach ($pedidoloja->complementositemcart as $adicionais)
            @if($adicionais->cartitems_id == $item->id)
              {{$adicionais->complemento->descricao}}
            @endif
          @endforeach
        <br>

        </li>
        @endforeach
        @else
        @foreach ($pedido->produtos as $item)
        <li class="lista-itens">
          {{$item->pivot->qtde}} |
          {{$item->descricao}} |
          {{$item->pivot->obsitem != null ? $item->pivot->obsitem : 'Sem Obs'}} |
          R$ {{number_format($item->pivot->prvenda, 2, ',', '.')}} |
          R$ {{number_format($item->pivot->prvenda * $item->pivot->qtde, 2, ',', '.')}}
        </li>
        @endforeach
        @endif
      </ul>
    </div>
    <div class="pagamento">
      <p class="titulo-sessao">Detalhes de Pagamento</p>
      <p>Forma de Pagamento: <span class="detail-list">{{isset($pedidoloja) ? $pedidoloja->formapagamento : $pedido->forma_pagamento}}</span></p>
      <p clas="total">Total <span class="detail-list">R$ {{isset($pedidoloja) ? number_format($pedidoloja->totalpedido, 2, ',', '.') : number_format($pedido->total - $pedido->desconto, 2, ',', '.')}}</span></p>
      <p>Troco pra <span class="detail-list">R$ {{isset($pedidoloja) ? number_format($pedidoloja->valortroco, 2, ',', '.') : number_format($pedido->valortroco, 2, ',', '.')}}</span></p>
      <p>Devolver Troco <span class="detail-list">R$ {{isset($pedidoloja) ? number_format($pedidoloja->valortroco - $pedidoloja->totalpedido, 2, ',', '.') : number_format($pedido->devolvertroco, 2, ',', '.')}}</span></p>
      @if (!isset($pedidoloja))
      <p>Total Desconto <span class="detail-list">R$ {{number_format($pedido->desconto, 2, ',', '.')}}</span></p>
      @if ($pedido->forma_pagamento == "Conta do Cliente")
      <div class="assinatura-cliente">
        <p>_____________________________________</p>
        <span class="assinatura">Assinatura do Cliente</span>
      </div>
      @endif
      @endif
    </div>
    <div class="footer">
      <h5>Agradecemos a preferência.</h5>
      <h6>Volte Sempre</h6>
    </div>
  </div>
  <script src="{{ asset('js/jquery.js')}}"></script>
  <script type="text/javascript">
    window.print();
  </script>
</body>
</html>
