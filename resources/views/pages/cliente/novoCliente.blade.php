@extends('layouts.app_guest', [
'namePage' => 'novo contato',
'class' => 'sidebar-mini',
'activePage' => 'novocontato',
])
@section('content')
<div class="col-md-3 offset-md-8 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header">
  <h2 class="text-center text-white mt-4">Cadastro da Empresa</h2>
</div>
<div class="content">
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-body">
        <form action="{{route('cliente.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
          {{csrf_field()}}
          @include('alerts.success')
          @include('pages.cliente.formCliente')
          <div class="card-footer ">
            <button type="submit" class="btn btn-primary btn-round">{{__('Enviar Formulário')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/cliente/cliente.js')}}'></script>
@endpush
