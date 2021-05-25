@extends('layouts.app', [
'namePage' => 'Novo Usuário',
'class' => 'sidebar-mini',
'activePage' => 'novousuario',
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
        <div class="card-header">
          <h4 class="card-title"> Novo Usuário</h4>
          <h6>Preencha Todos os Campos a Seguir</h6>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <!--Begin input name -->
            @include('users.formUsers')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Cadastrar')}}</button>
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
  $(document).ready(function() {
    demo.checkFullPageBackgroundImage();
  });

  $('.telefone').mask('(00) 00000-0000');
</script>
@endpush
@endsection
