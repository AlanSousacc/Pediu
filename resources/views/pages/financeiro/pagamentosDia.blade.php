@extends('layouts.app', [
'namePage' => 'Pagamentos do Dia',
'class' => 'sidebar-mini',
'activePage' => 'pagamentosdia',
])

@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card card-nav-tabs card-plain">
          <div class="card-body">
            <div class="tab-content text-center">
              <div class="card-header">
                <h4 class="card-title text-left"> Pagamentos do Dia</h4>
              </div>
              <div class="table-responsive" style="overflow: initial!important;">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>Contato</th>
                      <th>Valor Total</th>
                      <th>Pago</th>
                      <th>Forma de Pagamento</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fluxos as $item)
                    <tr>
                      <td>{{$item->movimentacao->contato == null ? 'Nenhum Contato' : $item->movimentacao->contato->nome}}</i></td>
                      <td>R$ {{number_format($item->valortotal, 2, ',', '.')}}</td>
                      <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                      <td>{{$item->forma_movimentacao}}</i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-10 text-left">
                  <p>Mostrando {{$fluxos->count()}} pagamentos de um total de: {{$fluxos->total()}}</p>
                </div>
                <div class="col-md-2">{{$fluxos->links()}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
@endpush
@endsection