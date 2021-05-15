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
  <div class="col-md-8 offset-md-2 mt-2">
    <h5 class="title font-weight-light mt-2"><a href="{{route('site')}}">Voltar ao Site</a></h5>
    <div class="card">
      <div class="card-body">
        <form action="{{route('cliente.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
          {{csrf_field()}}
          @include('alerts.success')
          @include('pages.cliente.formCliente')
          <div class="card-footer ">
            <button type="submit" class="btn btn-primary btn-round salvar-empresa" disabled>{{__('Enviar Formulário')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/cliente/cliente.js')}}'></script>
<script>
  $('#tooltip').tooltip('update')
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

<script>
  $('.verificar-slug').click(function (e) {
    $.ajax({
      url: '{{route('verificar.slug')}}' + '/' + $('#slug').val(),
      type: "get",
      dataType: "json",
      success: function (response) {
        Swal.fire(
          response.data.status,
          response.data.message,
          response.data.status == 'Disponível' ? 'success' : 'error'
        )
        if(response.data.status == 'Indisponível'){
          $('#slug').val('')
          $('.salvar-empresa').prop('disabled', true)
        } else{
          $('.salvar-empresa').prop('disabled', false)
          var str = $('#slug').val()
          str = str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase()
          $('#slug').val(str)
        }
      },
      error: function(response){
        Swal.fire(
          'Ops!',
          'Estamos com problemas para validar este nome, tente contatar o nosso adminstrador',
          'error'
        )
      }
    });
  })
</script>
@endpush
