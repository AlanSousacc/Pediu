<div class="card-body pt-0">
  <div class="row">
    @if (isset($config) && $config->controlaentrega == 1)
    <div class="card {{isset($config) && $config->controlaentrega == 1 ? 'col-md-12' : 'col-md-12'}} pt-3" style="width: 20rem;">
      <h5 class="card-title"> Entregadores <i class="ion-icons ion-ios-information-outline" id="tooltip" data-toggle="tooltip" data-placement="top" title="Somente movimentações entregues na qual o pedido não seja 'Conta do Cliente'"></i></h5>
      @if (count($resumoEntre) != 0)
      @foreach ($resumoEntre as $item)
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="left">{{$item->nomeEntregador}}</div>
          <div class="right">R$ {{number_format($item->somaTotal, 2, ',', '.')}}</div>
        </li>
        @endforeach
        <li class="list-group-item">
          <div class="left">TOTAL</div>
          <div class="right">R$ {{number_format($resumo->where('statusentrega', 0)->sum('total'), 2, ',', '.')}}</div>
        </li>
      </ul>
      @else
      <p><em>Não foi atribuido nenhum pedido a entregadores!</p></em>
      @endif
    </div>
    @endif
  </div>
</div>
