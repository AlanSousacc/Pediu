@extends('layouts.app', [
'namePage' => 'novo entregador',
'class' => 'sidebar-mini',
'activePage' => 'novoentregador',
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
          <h5 class="title">{{__(" Novo Entregador")}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('entregador.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('alerts.success')
            @include('pages.entregadores.formEntregador')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Entregador')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/contato/contato.js')}}'></script>

<script>
  $(document).ready(function () {
	$('#telefone').mask('(00) 00000-0000');
  $('#cep').mask('00000-000');
});
</script>
@endpush
@endsection