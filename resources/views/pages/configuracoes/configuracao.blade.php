@extends('layouts.app', [
'namePage' => 'Configurações da empresa',
'class' => 'sidebar-mini',
'activePage' => '',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-10 offset-1">
      <div class="card">
        <div class="card-body">
          <form action="{{route('configuracao.update', $config->id)}}" method="post" autocomplete="off">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
            @include('alerts.success')
            @include('pages.configuracoes.formConfiguracao')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Configurações')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>

  function verificaCobraEntrega(){
    if($('#cobraentrega').prop("checked", "true")){
      $("#valorentrega").css("display", "inherit")
    } else {
      $("#valorentrega").css("display", "none")
    }
  }

  $('#cobraentrega').on('change',function(ev){
    verificaCobraEntrega();
  });

  $(document).ready(function() {
    verificaCobraEntrega();
    $('#valorentrega').mask("#.##0,00", {reverse: true});
  });

</script>
@endpush
@endsection
