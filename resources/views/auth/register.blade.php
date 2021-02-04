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
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <!--Begin input name -->
            @include('users.formUsers')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round btn-lg">{{__('Cadastrar')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
  $(document).ready(function() {
    demo.checkFullPageBackgroundImage();
  });
</script>
@endpush
@endsection
