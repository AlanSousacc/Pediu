@extends('layouts.app', [
'namePage' => 'novo complemento',
'class' => 'sidebar-mini',
'activePage' => 'novoComplemento',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div id="app">
    <div class="row">
      <div class="col-md-10 offset-1">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Novo Complemento")}}</h5>
          </div>
          <div class="card-body">
            <form action="{{route('complemento.store')}}" method="post" autocomplete="off">
              {{csrf_field()}}
              @include('alerts.success')
              @include('pages.complementos.formComplemento')
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Complemento')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/complementos/complementos.js')}}'></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> --}}
<script src='{{asset('js/vue/complementos.js')}}' type="module"></script>
@endpush
@endsection