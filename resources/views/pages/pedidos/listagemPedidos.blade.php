@extends('layouts.app', [
'namePage' => 'Listagem de Pedidos',
'class' => 'sidebar-mini',
'activePage' => 'listagemPedidos',
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
        <div class="card-header">
          <h4 class="card-title"> Pedidos</h4>
        </div>
        @include('pages.pedidos.listagemPedidosBase')
      </div>
    </div>
  </div>
  {{-- modal Deletar--}}
  @include('pages.pedidos.modalExcluirPedido')
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalStatusEntregador')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>
@endpush
@endsection