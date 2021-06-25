@extends('layouts.app', [
'namePage' => 'Detalhes do pedido',
'class' => 'sidebar-mini',
'activePage' => 'detalhefinanceiro',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row" >
    <div class="col-md-10 offset-1">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{__("Registrar Movimentação")}}</h5>
        </div>
        <form action="{{route('movimentacao.caixa')}}" method="post">
        {{csrf_field()}}
        <div class="card-body details">
          <div class="card card-nav-tabs card-plain">
            <div class="card-body ">
              @include('pages.financeiro.formMovimentacao')
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-success btn-round"><i class="fa fa-check-double"></i> Realizar Movimentação</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  $(document).ready(function () {  
    $('.valortotal').mask("#.##0.00", {reverse: true});
    $('.valorrecebido').mask("#.##0.00", {reverse: true});
  });
</script>
@endpush
@endsection
