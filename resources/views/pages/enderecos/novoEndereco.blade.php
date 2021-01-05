@extends('layouts.app', [
'namePage' => 'novo endereço',
'class' => 'sidebar-mini',
'activePage' => 'novocontato',
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
          <h5 class="title">{{__("Novo Endereço do contato - ". \App\Models\Contato::where('id', $id)->first()->nome)}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('endereco.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="contato_id" value="{{ $id }}">
            @include('alerts.success')
            @include('pages.enderecos.formEndereco')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Endereço')}}</button>
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
@endpush
@endsection