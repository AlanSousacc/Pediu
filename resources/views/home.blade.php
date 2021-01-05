@extends('layouts.app', [
'namePage' => 'Dashboard',
'class' => 'login-page sidebar-mini ',
'activePage' => 'home',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
<div class="panel-header panel-header-lg">
  <canvas id="bigDashboardChart"></canvas>
</div>
<div class="content">
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Ultimos 5 dias</h5>
          <h4 class="card-title">Total de Pedidos</h4>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @if (count($weekSales) != 0)
              @foreach ($weekSales as $item)
              <li class="list-group-item">{{\Carbon\Carbon::parse($item->datapedido)->format('d/m/Y')}} <span>Total: R$ {{number_format($item->somatotal, 2, ',', '.')}}</span></li>
              @endforeach
            @else
              <h5>Nenhum pedido realizado neste período!</h5>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Top 5</h5>
          <h4 class="card-title">Produtos Mais Vendidos</h4>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @if (count($topProducts) != 0)
              @foreach ($topProducts as $item)
              <li class="list-group-item">{{$item->descricao}} <span>Qtde: {{$item->qtde}}</span></li>
              @endforeach
            @else
              <h5>Nenhum pedido realizado neste período!</h5>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Top 5</h5>
          <h4 class="card-title">Clientes Mais Ativos</h4>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @if (count($topClients) != 0)
              @foreach ($topClients as $item)
              <li class="list-group-item">{{$item->nome}} <span>Qtde: {{$item->qtde}}</span></li>
              @endforeach
            @else
              <h5>Nenhum pedido realizado neste período!</h5>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initDashboardPageCharts();
    
  });
</script>
@endpush