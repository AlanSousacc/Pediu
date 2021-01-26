<div class="card-body pt-0">
  <div class="row">
    <div class="col-md-10 mb-4 mt-0">
      <small>OBS: Por padrão a tela é carregada com a consulta das ultimas 12 horas!</small><br>
      <a href="relatorio.periodo.contato" data-target="#resumoperiodo" data-toggle="modal" class="btn btn-primary btn-outline-primary btn-sm">
        <i class="fa fa-filter"></i> Filtrar
      </a>
    </div>
  </div>

  <div class="row">

    <div class="card {{isset($config) && $config->controlaentrega == 1 ? 'col-md-6' : 'col-md-12'}} pt-3" style="width: 20rem;">
      <h5 class="card-title"> Caixa <i class="ion-icons ion-ios-information-outline" id="tooltip" data-toggle="tooltip" data-placement="top" title="Movimentações Diárias"></i></h5></h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="left">Dinheiro:</div>
          <div class="right">R$ {{number_format($resumo->where('forma_pagamento', 'Dinheiro')->sum('total'), 2, ',', '.')}}</div>
        </li>
        <li class="list-group-item">
          <div class="left">Cartão de Crédio:</div>
          <div class="right">R$ {{number_format($resumo->where('forma_pagamento', 'Cartão de Crédito')->sum('total'), 2, ',', '.')}}</div>
        </li>
        <li class="list-group-item">
          <div class="left">Cartão de Débito:</div>
          <div class="right">R$ {{number_format($resumo->where('forma_pagamento', 'Cartão de Débito')->sum('total'), 2, ',', '.')}}</div>
        </li>
        <li class="list-group-item">
          <div class="left">Conta do Cliente</div>
          <div class="right">R$ {{number_format($resumo->where('forma_pagamento', 'Conta do Cliente')->sum('total'), 2, ',', '.')}}</div>
        </li>
        <li class="list-group-item">
          <div class="left">TOTAL</div>
          <div class="right">R$ {{number_format($resumo->sum('total'), 2, ',', '.')}}</div>
        </li>
      </ul>
    </div>

    @if (isset($config) && $config->controlaentrega == 1)
    <div class="card {{isset($config) && $config->controlaentrega == 1 ? 'col-md-6' : 'col-md-12'}} pt-3" style="width: 20rem;">
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
