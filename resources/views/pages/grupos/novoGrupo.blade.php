@extends('layouts.app', [
'namePage' => 'novo grupo',
'class' => 'sidebar-mini',
'activePage' => 'listagemGrupos',
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
          <h5 class="title">{{__(" Novo Grupo")}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('grupo.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('alerts.success')
            @include('pages.grupos.formGrupo')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Grupo')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src='{{asset('js/grupos/grupos.js')}}'></script>
@endpush
@endsection
