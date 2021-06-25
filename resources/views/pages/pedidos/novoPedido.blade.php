@extends('layouts.app', [
'namePage' => 'novo pedido',
'class' => 'sidebar-mini',
'activePage' => 'novopedido',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
@push('scripts')
{{-- verifica se o pedido foi concluído com sucesso e abre o modal --}}
@if(session('pedido'))
<script>
  $(function() {
    $('#impressao').modal('show');
  });
</script>
@endif
@endpush

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card card-nav-tabs card-plain">
          <div class="card-header card-header-warning">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#novopedido" data-toggle="tab">Novo Pedido</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#pedidosRealizados" data-toggle="tab">Pedidos do Dia</a>
                  </li>
                  @if ($config->controlaentrega == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="#conferencia" data-toggle="tab">Conferência</a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link" href="#resumo" data-toggle="tab">Resumo Entregadores</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="card-body ">
            <div class="tab-content">
              {{-- tab de novo pedido --}}
              <div class="tab-pane active" id="novopedido">
                <form action="{{route('store.pedido')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                  {{csrf_field()}}
                  @include('alerts.success')
                  @include('pages.pedidos.formPedidos')
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success btn-round" disabled id="finalizarPedido"><i class="now-ui-icons ui-1_check"></i> Finalizar Pedido</button>
                  </div>
                </form>
              </div>
              {{-- tab fim novo pedido --}}

              {{-- tab listagem pedido --}}
              <div class="tab-pane" id="pedidosRealizados">
                <div class="card-header">
                  <h4 class="card-title"> Pedidos Realizados Hoje</h4>
                </div>
                @include('pages.pedidos.listagemPedidosBase')
              </div>
              {{-- tab fim listagem pedido --}}

              {{-- tab conferencia --}}
              @if ($config->controlaentrega == 1)
              <div class="tab-pane" id="conferencia">
                <div class="card-header">
                  <h4 class="card-title"> Pedidos por Entregadores</h4>
                </div>
                @include('pages.entregadores.listagemPedidosEntregadores')
              </div>
              @endif
              {{-- fim tab conferencia --}}

              {{-- tab resumo --}}              
              <div class="tab-pane" id="resumo">
                @include('pages.entregadores.listagemResumoEntregadores')
              </div>
              {{-- fim tab conferencia --}}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalStatusEntregador')
  {{-- modal Deletar--}}
  @include('pages.pedidos.modalExcluirPedido')
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalBaixarTotal')
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalImprimirPedido')
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalResumoPedido')
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>

{{-- toogle com o tolltip --}}
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
  var count = 0;
  var TotalGeral = 0;
  var desconto = 0;

  function carregaLocalEntrega(){
    $.ajax({
      url: '{{route('busca.enderecos')}}' + '/' + $('#contatoid').val(),
      type: "get",
      dataType: "json"

    }).done(function(resposta) {
      $('#entrega_id').attr('readonly', false);
      let str = '';
      $(resposta.data).each(function () {
        str += '<option value=' + this.id + '>' + this.endereco + ' - ' + this.numero  + ' - ' + this.bairro  + '</option>';

        var url = '{{ route("contato.edit", ":id") }}';
        url = url.replace(':id', resposta.data[0].contato_id);

        $('.contato-edit').attr("href", url)
      })

      $('#entrega_id').html(str);

    }).fail(function(jqXHR, textStatus ) {
      alert("Falha ao listar os dados de entrega: " + textStatus);
    });
  }

  // função de carregamento de local de entrega automático ao escolher o contato
  $('#contatoid').on('change',function(ev){
    carregaLocalEntrega();
  });

  // Ajax para carregar o preço do produto
  function carregaPrecoProduto(){
    $.ajax({
      url: '{{route('busca.precoproduto')}}' + '/' + $('#produto_id').val(),
      type: "get",
      dataType: "json"

    }).done(function(resposta) {
      let dados = resposta.data;
      $('#prvenda').val(dados[0].precovenda)

    }).fail(function(jqXHR, textStatus ) {
      alert("Falha ao carregar preço do produto: " + textStatus);
    });
  }

  // função de carregamento de preço do produto automático ao escolher o produto
  $('#produto_id').on('change',function(ev){
    carregaPrecoProduto();
  });

  // calcula o desconto com o valor total
  $('#desconto').on('change',function(ev){
    var total    = Number($('#total').val())
    var desconto_temp = Number($('#desconto').val()).toFixed(2);
    desconto = desconto_temp;
    $('#total').val(TotalGeral - desconto);
  });

  // verifica se a forma de pagamento e dinheiro e habilita o campo de troco, se não for deixa desabilitado
  $('#forma_pagamento').on('change',function(ev){
    if($('#forma_pagamento').val() == 'Dinheiro'){
      $('span.sifra-troco').removeClass("sifrao-troco")
      $('.troco').removeAttr('readonly');
    } else {
      $('.troco').attr('readonly', true);
      $('span.sifra-troco').addClass('sifrao-troco');
    }
  });


  $(document).ready(function() {
    $('#prvenda').mask("#.##0.00", {reverse: true});
    $('.troco').mask("#.##0.00", {reverse: true});
    $('#desconto').mask("#.##0.00", {reverse: true});

    $('#total').mask("#.##0.00", {reverse: true});

    carregaLocalEntrega();
    carregaPrecoProduto();
  });

  function limpaCampos(){
    $('#obsitem').val('');
    carregaPrecoProduto();
  }

  // Ajax para carregar o produto na grid ao selecionar o item e clicar no botão +
  $('#inserirProduto').click(function(){
    $.ajax({
      url: '{{route('busca.produto.pedido')}}' + '/' + $('#produto_id').val(),
      type: "get",
      dataType: "json"

    }).done(function(resposta) {
      let dados = resposta.data;
      var str = '<tr id="'+count+'">'
        str += '<input type="hidden" name="produtos_listagem_id[]" value="'+dados.id+'" />'
        str += '<input type="hidden" name="produtos_qtde[]" value="'+$('#qtde').val()+'" />'
        str += '<input type="hidden" name="obsitem[]" value="'+$('#obsitem').val()+'" />'
        str += '<input type="hidden" name="prvenda[]" value="'+$('#prvenda').val()+'" />'

        if($('#obsitem').val() == ''){
          str += '<td class="text-left">'+ dados.descricao + '</td>'
        } else{
          str += '<td class="text-left">'+ dados.descricao + '<br><small class="obs-item"> ' + $('#obsitem').val() + '</small>' + '</td>'
        }
        str += '<td class="text-center">'+ $('#qtde').val() +'</td>'
        str += '<td class="text-center">'+ $('#prvenda').val() +'</td>'
        str += '<td class="text-center">'+ ($('#qtde').val() * $('#prvenda').val()).toFixed(2) +'</td>'
        str += '<td class="text-center"><button class="btn btn-outline-primary btn-sm btn-fab btn-icon btn-round" type="button" onclick="removerItem('+count+')"><i class="now-ui-icons ui-1_simple-remove"></i></button></td>'
        str += '</tr>';

        $('#total').val();

        TotalGeral += $('#qtde').val() * $('#prvenda').val();
        $('#total').val(TotalGeral - desconto);

        // habilita botão de finalizar pedido
        $('#finalizarPedido').prop('disabled', false);

        // habilita inserir desconto
        $('#desconto').removeAttr("readonly");
        $('.sifrao').removeClass('sifrao');

        $('#qtde').val(1);
        $('#listaProd').append(str);
        count++;

        limpaCampos();
      }).fail(function(jqXHR, textStatus ) {
        alert("Falha ao inserir produto no pedido!" + textStatus);
      });
    });

    // remove o item da grid e atualiza o preço total
    function removerItem(id){
      var valorTotal = $('#'+ id).children('td');
      valorTotal = valorTotal[3];
      valorTotal = $(valorTotal).text();

      valorTotal = Number(valorTotal);
      TotalGeral -= valorTotal;
      $('#total').val(TotalGeral - desconto);
      $('#'+ id).remove()
    }

  </script>

  {{-- fecha modal de impressao --}}
  <script>
    $('.imprimir').click(function(){
      $('#impressao').modal('hide');
    })
  </script>

  @endpush
  @endsection
