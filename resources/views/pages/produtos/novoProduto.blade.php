@extends('layouts.app', [
'namePage' => 'novo produto',
'class' => 'sidebar-mini',
'activePage' => 'novoproduto',
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
          <h5 class="title">{{__(" Novo Produto")}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('produto.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('alerts.success')
            @include('pages.produtos.formProduto')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Produto')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/produtos/produtos.js')}}'></script>
@endpush
@endsection