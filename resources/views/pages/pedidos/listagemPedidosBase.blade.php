<div class="card-body">
  <div class="table-responsive" style="overflow: initial!important;">
    <table class="table">
      <thead class=" text-primary">
        <th class="text-center">Hora</th>
        <th class="text-center">Cliente</th>
        <th class="text-center">Sub.</th>
        <th class="text-center">Total</th>
        <th class="text-center">Desc.</th>
        <th class="text-center">Troco</th>
        <th class="text-center">status</th>
        <th class="text-center">Opções</th>
      </thead>
      <tbody>
        @foreach ($consulta as $item)
        <tr>
          <td class="text-center">{{$item->created_at->format('d/m/Y H:i:s')}}</td>
          <td class="text-center">{{$item->contato->nome}}</td>
          <td class="text-center">R$ {{number_format($item->subtotal, 2, ',', '.')}}</td>
          <td class="text-center">R$ {{number_format($item->total, 2, ',', '.')}}</td>
          <td class="text-center">R$ {{number_format($item->desconto, 2, ',', '.')}}</td>
          <td class="text-center">R$ {{number_format($item->valortroco, 2, ',', '.')}}</td>
          @if ($item->entregador_id != null)
          <td class="text-center text-success">Entregue / A caminho</td>
          @else
          <td class="text-center text-warning">Aguard. Entregador</td>
          @endif
          {{-- <td class="text-center text-success">Processado</td> --}}
          <td class="text-center">
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->id)}}"><i class="now-ui-icons files_paper"></i>Detalhar Pedido</a>
                @if ($item->entregador_id == null)
                <a class="dropdown-item" href="{{$item->id}}" 
                  data-pedidoid={{$item->id}} 
                  data-target="#mudarStatus" 
                  data-statusentrega="{{$item->statusentrega}}" 
                  data-entregador_id="{{$item->entregador_id}}" 
                  data-valortroco="{{$item->valortroco}}" 
                  data-troco="{{$item->troco}}" 
                  data-toggle="modal"><i class="now-ui-icons shopping_delivery-fast"></i>Definir Entregador</a>
                  <a class="dropdown-item" href="{{ route('pedido.edit', $item->id) }}"><i class="now-ui-icons education_paper"></i>Alterar</a>
                  <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="now-ui-icons ui-1_simple-remove"></i>Remover</a>
                  @endif
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td class="text-center" colspan="2"></td>
            <td class="text-center" style="font-weight:600">R$ {{number_format($consulta->sum('subtotal'), 2, ',', '.')}}</td>
            <td class="text-center" style="font-weight:600">R$ {{number_format($consulta->sum('total'), 2, ',', '.')}}</td>
            <td class="text-center" style="font-weight:600">R$ {{number_format($consulta->sum('desconto'), 2, ',', '.')}}</td>
            <td class="text-center" colspan="3"></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6"><p>Mostrando {{$consulta->count()}} pedidos de um total de {{$consulta->total()}}</p></div>
      <div class="col-md-6">{{$consulta->links()}}</div>
    </div>
  </div>