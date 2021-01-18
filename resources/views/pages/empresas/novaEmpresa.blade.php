@extends('layouts.app', [
'namePage' => 'nova empresa',
'class' => 'sidebar-mini',
'activePage' => 'novaempresa',
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
          <h5 class="title">{{__(" Nova Empresa")}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('empresa.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('alerts.success')
            @include('pages.empresas.formEmpresa')
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Salvar Empresa')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/empresas/empresas.js')}}'></script>

<script>
  // Ajax para o cliente e preencher os campos do formulário
  function carregaDadosCliente(){
    $.ajax({
      url: '{{route('busca.clienteid')}}' + '/' + $('#cliente_id').val(),
      type: "get",
      dataType: "json"

    }).done(function(resposta) {
      console.log(resposta.data)
      let dados = resposta.data;
      $('#nome').val(dados[0].nome)
      $('#bairro').val(dados[0].bairro)
      $('#celular').val(dados[0].celular)
      $('#cidade').val(dados[0].cidade)
      $('#cnpj').val(dados[0].cnpj)
      $('#email').val(dados[0].email)
      $('#endereco').val(dados[0].endereco)
      $('#fantasia').val(dados[0].fantasia)
      $('#numero').val(dados[0].numero)
      $('#razao').val(dados[0].razao)
      $('#telefone').val(dados[0].telefone)
      $('#imglogo').attr('src', '{{url("storage")}}' + '/' + dados[0].logo)
      $('#carregalogo').val(dados[0].logo)



    }).fail(function(jqXHR, textStatus ) {
      alert("Falha ao carregar os campos com as informações deste cliente: " + textStatus);
    });
  }

  $('#cliente_id').on('change',function(ev){
    carregaDadosCliente();
  });

  $("#logo").change(function() {
    readURL(this);
  });

  // carrega imagem
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#imglogo').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
@endsection
