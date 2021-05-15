@extends('layouts.app', [
'namePage' => 'Dashboard',
'class' => 'login-page sidebar-mini ',
'activePage' => 'home',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  @php $config = App\Models\Configuracao::where('empresa_id', Auth::user()->empresa_id)->first()@endphp
  <div class="row">
    <div class="col-md-6" style="{{$config->controlepedidosbalcao == 0 ? 'display: none;' : ''}}">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Vendas do Balcão Mensal</h5>
        </div>
        <canvas id="pedidosbalcaomes"></canvas>
      </div>
    </div>
    <div class="{{$config->controlepedidosbalcao == 1 ? 'col-md-6' : 'col-md-12'}}">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Vendas da Loja Mensal</h5>
        </div>
        <canvas id="pedidoslojames" height="{{$config->controlepedidosbalcao == 0 ? '80' : ''}}"></canvas>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6" style="{{$config->controlepedidosbalcao == 0 ? 'display: none;' : 'display: flex'}}">
      <div class="col-md-6 pl-0">
        <div class="card card-chart" style="background-image: linear-gradient(to bottom right, #05bfd2, #5bbf7e);">
          <div class="card-header">
            <h5 class="card-category text-white">Top 5 Produtos Mais Vendidos Balcao <i class="fa fa-shopping-bag"></i></h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @if (count($topProductsBalcao) != 0)
              @foreach ($topProductsBalcao as $item)
              <li class="list-group-item text-lowercase font-weight-light"  style="background-color: transparent; color: #fff">{{$item->descricao}} <span>Qtde: {{$item->qtde}}</span></li>
              @endforeach
              @else
              <h5>Nenhum pedido realizado neste período!</h5>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 pr-0">
        <div class="card card-chart" style="background-image: linear-gradient(to bottom right, #5bbf7e, #05bfd2);">
          <div class="card-header">
            <h5 class="card-category text-white">Top 5 Clientes Mais Ativos Balcao <i class="fa fa-user-tie"></i></h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @if (count($topClientsBalcao) != 0)
              @foreach ($topClientsBalcao as $item)
              <li class="list-group-item text-lowercase font-weight-light"  style="background-color: transparent; color: #fff">{{$item->nome}} <span>Qtde: {{$item->qtde}}</span></li>
              @endforeach
              @else
              <h5>Nenhum pedido realizado neste período!</h5>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="{{$config->controlepedidosbalcao == 1 ? 'col-md-6' : 'col-md-12'}} d-flex">
      <div class="col-md-6 pl-0">
        <div class="card card-chart" style="background-image: linear-gradient(to bottom right, #1e5db1, #d7ffda);">
          <div class="card-header">
            <h5 class="card-category text-white">Top 5 Produtos Mais Vendidos Loja <i class="fa fa-shopping-bag"></i></h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @if (count($topProductsLoja) != 0)
              @foreach ($topProductsLoja as $item)
              <li class="list-group-item text-lowercase font-weight-light" style="background-color: transparent; color: #fff">{{$item->descricao}} <span>Qtde: {{$item->qtde}}</span></li>
              @endforeach
              @else
              <h5>Nenhum pedido realizado neste período!</h5>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 pr-0">
        <div class="card card-chart" style="background-image: linear-gradient(to bottom right, #d7ffda, #1e5db1);">
          <div class="card-header">
            <h5 class="card-category text-white">Top 5 Clientes Mais Ativos Loja <i class="fa fa-user-tie"></i></h5>
          </div>
          <div class="card-body bg-gradient-warning">
            <ul class="list-group list-group-flush">
              @if (count($topClientsLoja) != 0)
              @foreach ($topClientsLoja as $item)
              <li class="list-group-item text-lowercase font-weight-light" style="background-color: transparent; color: #fff">{{$item->name}} <span>Qtde: {{$item->qtde}}</span></li>
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
</div>
@endsection

@push('scripts')
<script src='{{asset('js/dashboard/dashboard.js')}}'></script>
@endpush