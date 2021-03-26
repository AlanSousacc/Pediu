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
          <h5 class="">{{__(" Novo Produto")}}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('produto.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('alerts.success')
            @include('pages.produtos.formProduto')
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-success btn-round">{{__('Salvar Produto')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal Deletar--}}
@include('pages.produtos.modalCriarGrupo')
{{-- modal Deletar--}}
@include('pages.produtos.modalCriarComplemento')
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src='{{asset('js/produtos/produtos.js')}}'></script>
<script src='{{asset('js/grupos/grupos.js')}}'></script>
<script src='{{asset('js/complementos/complementos.js')}}'></script>

<script>
  var count = 0;
  // Ajax para carregar o preço do complemento
  function carregaPrecoComplemento(){
    $.ajax({
      url: '{{route('busca.precocomplemento')}}' + '/' + $('#complemento_id').val(),
      type: "get",
      dataType: "json",
      global: false,
      beforeSend: function () {
        $('#inserirComplemento').prop('disabled', 'true');
        $('#inserirComplemento').text('Aguarde...');
      },
      complete: function () {
        $('#inserirComplemento').removeAttr('disabled');
        $('#inserirComplemento').text('Inserir a Este Produto');
      }
    }).done(function(resposta) {
      let dados = resposta.data;
      $('#precocomplemento').val(Number(dados[0].preco).toFixed(2));
      // Number($('#precocomplemento').val()).toFixed(2)

    }).fail(function(jqXHR, textStatus ) {
      alert("Falha ao carregar preço do complemento: " + textStatus);
    });
  }

  // função de carregamento de preço do complemento automático ao escolher o complemento
  $('#complemento_id').on('change',function(ev){
    carregaPrecoComplemento();
  });

  $(document).ready(function() {
    carregaPrecoComplemento();
    $('.loading').hide();
  });

  // Ajax para carregar o complemento na grid ao seleciona-lo e clicar no botão +
  $('#inserirComplemento').click(function(){
    $.ajax({
      url: '{{route('busca.complemento.produto')}}' + '/' + $('#complemento_id').val(),
      type: "get",
      dataType: "json"
    }).done(function(resposta) {
      let dados = resposta.data;
      var str = '<tr id="'+count+'">'
        str += '<input type="hidden" name="complemento_listagem_id[]" value="'+dados.id+'" />'
        str += '<input type="hidden" name="preco[]" value="'+$('#precocomplemento').val()+'" />'

        str += '<td class="text-center">'+ dados.descricao + '</td>'
        str += '<td class="text-center"> '+ Number($('#precocomplemento').val()).toFixed(2) +'</td>'
        str += '<td class="text-center"><button class="btn btn-outline-primary btn-sm btn-fab btn-icon btn-round" type="button" onclick="removerItem('+count+')"><i class="now-ui-icons ui-1_simple-remove"></i></button></td>'
        str += '</tr>';

        // habilita inserir desconto
        $('#listaProd').append(str);
        count++;

      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao inserir complemento ao produto!" + textStatus);
      });
    });

    // carrregamento
    $(document).ajaxStart(function(){
      $('.loading').show();
    }).ajaxStop(function(){
      $('.loading').hide();
    });

    // remover complemento da listagem
    function removerItem(id){
      $('#'+ id).remove()
    }
  </script>
  @endpush
  @endsection
