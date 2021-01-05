<div class="card-body">
  <div class="table-responsive" style="overflow: initial!important;">
    <table class="table">
      <thead class=" text-primary">
        <th class="text-center">#PEDIDO</th>
        <th class="text-center">Nome</th>
        <th class="text-center">Total Pedido(A)</th>
        <th class="text-center">Troco(B)</th>
        <th class="text-center">Total A+B</th>
        <th class="text-center">Baixado</th>
        <th class="text-center">Opções</th>
      </thead>
      <tbody>
        @foreach ($consulta as $item)
        <tr>
          <td class="text-center">{{$item->id}}</td>
          <td class="text-center">{{!isset($item->entregador->nome) ? 'ENTREGADOR NÃO ATRIBUIDO!' : $item->entregador->nome}}</td>
          <td class="text-center">R$ {{number_format($item->total - $item->desconto, 2, ',', '.')}}</td>
          <td class="text-center">R$ {{number_format($item->valortroco, 2, ',', '.')}}</td>
          <td class="text-center">R$ {{number_format($item->subtotal + $item->valortroco, 2, ',', '.')}}</td>
          @if ($movimentacao->where('pedido_id', $item->id)->first()->status == 0)
          <td class="text-center"><i class="ionicons ion-close-circled text-danger" id="tooltip" data-toggle="tooltip" data-placement="top" title="Só será baixado esta movimentação ao receber na Conta do Cliente"></i></td>
          @else
          <td class="text-center"><i class="ionicons ion-checkmark-circled text-success" id="tooltip" data-toggle="tooltip" data-placement="top" title="Movimentação baixada com sucesso!"></i></td>
          @endif
          @if ($movimentacao->where('pedido_id', $item->id)->first()->status != 1)
          @if ($item->forma_pagamento != "Conta do Cliente")
          <td class="text-center"><a href="{{$item->id}}"
            data-contid={{$item->id}}
            data-total={{$item->subtotal + $item->valortroco}}
            data-entregador="{{!isset($item->entregador->nome) ? 'ENTREGADOR NÃO ATRIBUIDO!' : $item->entregador->nome}}" data-target="#baixar" data-toggle="modal"><i class="fa fa-donate"></i> Receber</a></td>
            @else
            <td class="text-center text-warning"><i class="now-ui-icons travel_info" id="tooltip" data-toggle="tooltip" data-placement="top" title="O pedido foi lançado na Conta do Cliente"></i> Conta do Cliente</td>
            @endif
            @else
            <td class="text-center text-success"><i class="now-ui-icons ui-2_like" id="tooltip" data-toggle="tooltip" data-placement="top" title="Este pedido foi recebido do Entregador"></i> Concluído</td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-10"><p>Mostrando {{$consulta->count()}} entregadores de um total de {{$consulta->total()}}</p></div>
      <div class="col-md-2">{{$consulta->links()}}</div>
    </div>
  </div>