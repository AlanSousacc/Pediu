@extends('layouts.app', [
'namePage' => 'Listagem de Pedidos Balcão',
'class' => 'sidebar-mini',
'activePage' => 'listagemPedidos',
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
      <div class="col-md-12">
        <div class="card">
          <nav class="navbar navbar-expand-md navbar-light" style="background-color: #3f51b5!important">
            <a class="navbar-brand" href="#">Filtrar Pedidos Por Status</a>
            <ul class="navbar-nav">
              <li class="nav-item active"><a class="nav-link" href="{{route('pedido.index')}}"><i class="fa fa-certificate"></i> Todos</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 0)}}"><i class="fa fa-clock"></i> Pendente</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 1)}}"><i class="fa fa-check"></i> Aprovado</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 2)}}"><i class="fa fa-concierge-bell"></i> Preparando</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 3)}}"><i class="fa fa-shipping-fast"></i> Saiu para Entrega</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 4)}}"><i class="fa fa-check-double"></i> Entregue</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('pedidosbalcao.filterstatus', 5)}}"><i class="fa fa-ban"></i> Cancelado</a></li>
            </ul>
            <div class="form-inline col-sm-12 col-md-4 d-block w-100">
              <div class="form-group">
                <a class="navbar-brand ml-3" href="#">Filtrar Por Período</a>
                <input type="date" name="datapedido" class="form-control form-control-md mx-sm-3" id="filtro_por" value="{{isset(Request::route()->parameters['dia']) ? Request::route()->parameters['dia'] : ''}}" />
                <a href="{{route('pedido.index')}}">Limpar</a>
              </div>
            </div>
          </nav>
          <div class="card-header">
            <h4 class="card-title"> Pedidos Balcão - <small> Dia: {{isset(Request::route()->parameters['dia']) ? date('d/m/Y', strtotime(Request::route()->parameters['dia'])) : Carbon\Carbon::now()->format('d/m/Y')}}</small></h4>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="overflow: initial!important;">
              <table class="table">
                <thead class=" text-primary">
                  <th class="text-center">#ID</th>
                  <th class="text-center">Hora</th>
                  <th class="text-center">Cliente</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Troco Para</th>
                  <th class="text-center">Status Pedido</th>
                  @if (isset($config) && $config->controlaentrega == 1)
                  <th class="text-center">Status Entregador</th>
                  @endif
                  <th class="text-center">Opções</th>
                </thead>
                <tbody>
                  @foreach ($consulta as $item)
                  <tr>
                    <td class="text-center">Pedido-{{$item->id}}</td>
                    <td class="text-center">{{$item->created_at->format('d/m/Y H:i:s')}}</td>
                    <td class="text-center">{{$item->contato->nome}}</td>
                    <td class="text-center">R$ {{number_format($item->total, 2, ',', '.')}}</td>
                    <td class="text-center">R$ {{number_format($item->valortroco, 2, ',', '.')}}</td>
                    <td class="text-center">
                      @if ($item->statuspedido == 0)
                      <span class="text-light bg-warning p-1 rounded">Pendente</span>
                      @elseif($item->statuspedido == 1)
                      <span class="text-light bg-info p-1 rounded">Aprovado</span>
                      @elseif($item->statuspedido == 2)
                      <span class="text-light bg-secondary p-1 rounded">Preparando</span>
                      @elseif($item->statuspedido == 3)
                      <span class="text-light bg-dark p-1 rounded">Saiu para Entrega</span>
                      @elseif($item->statuspedido == 4)
                      <span class="text-light bg-success p-1 rounded">Entregue</span>
                      @elseif($item->statuspedido == 5)
                      <span class="text-light bg-danger p-1 rounded">Cancelado</span>
                      @endif
                    </td>
                    @if (isset($config) && $config->controlaentrega == 1)
                    @if ($item->entregador_id != null)
                    <td class="text-center text-success">Entregue / A caminho</td>
                    @else
                    <td class="text-center text-warning">Aguard. Entregador</td>
                    @endif
                    @endif
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ação </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('pedido.detalhe', $item->id)}}"><i class="now-ui-icons files_paper"></i>Detalhar Pedido</a>
                          <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="now-ui-icons ui-1_simple-remove"></i>Remover</a>
                          @if ($item->entregador_id == null)
                          @if (isset($config) && $config->controlaentrega == 1)
                            <a class="dropdown-item" href="{{$item->id}}" data-pedidoid={{$item->id}} data-target="#mudarStatus" data-statusentrega="{{$item->statusentrega}}" data-entregador_id="{{$item->entregador_id}}" data-valortroco="{{$item->valortroco}}" data-troco="{{$item->troco}}" data-toggle="modal"><i class="now-ui-icons shopping_delivery-fast"></i>Definir Entregador</a>
                          @endif
                          @endif
                          @if ($item->statuspedido != 4)
                            <a class="dropdown-item" href="{{$item->id}}" data-pedidoid={{$item->id}} data-target="#mudarStatusPedido" data-toggle="modal"><i class="now-ui-icons ion-shuffle"></i>Atualizar Status</a>
                          @endif
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td class="text-center" colspan="3"></td>
                    <td class="text-center" style="font-weight:600">R$
                      {{number_format($consulta->sum('total'), 2, ',', '.')}}</td>
                    <td class="text-center" colspan="4"></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p>Mostrando {{$consulta->count()}} pedidos de um total de {{$consulta->total()}}</p>
              </div>
              <div class="col-md-6">{{$consulta->links()}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- modal Deletar--}}
  @include('pages.pedidos.modalExcluirPedido')
  {{-- modal mudar status--}}
  @include('pages.pedidos.modalStatusEntregador')
  {{-- modal Status pedido--}}
  @include('pages.pedidos.balcao.modalStatusPedido')
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src='{{asset('js/vue/app.js')}}' type="module"></script>
<script src='{{asset('js/pedidos/pedidos.js')}}'></script>

<script>
  $(document).ready(function () {
    // envia pelo whatsapp caso clique em enviar
    $('.define-envia').click(function (e) {
      Swal.fire({
      title: 'Mudar Status e Enviar',
      text: "Você enviará o novo status selecionado a seu cliente!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim',
      }).then((result) => {
        if (result.isConfirmed) {
          e.preventDefault();
          $.ajax({
            url: '{{route('pedido.status.balcao')}}' + '/' + $('#pedidoid').val(),
            method: "get",
            dataType: 'json',
            data : $('#formstatus').serialize(),
            dataType: 'json',
            success: function (response) {
              Swal.fire({
                title: 'Status modificado com Sucesso!',
                text: 'O novo status será enviado ao cliente após clicar em OK!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                  window.open(response.url, '_blank')
                  window.location.reload()
                }
              });
            },
            error: function(response){
              Swal.fire(
                'Ops, algo deu errado!',
                'Infelizmente houve um problema e não conseguimos modificar o status e assim não enviamos o novo status a seu cliente!',
                'error'
              )
              window.location.reload()
            }
          });
        }
      })
    })

    // somente modifica o status
    $('.define-somente').click(function (e) {
      Swal.fire({
        title: 'Mudar Status Pedido',
        text: "Você deseja somente modificar o status do pedido?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
      }).then((result) => {
        if (result.isConfirmed) {
          e.preventDefault();
          $.ajax({
            url: '{{route('pedido.status.balcao')}}' + '/' + $('#pedidoid').val(),
            method: "get",
            dataType: 'json',
            data : $('#formstatus').serialize(),
            dataType: 'json',
            success: function (response) {
              Swal.fire({
                title: 'Status modificado com Sucesso!',
                text: 'O novo status foi aplicado, clique em OK para fechar!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.reload()
                }
              });
            },
            error: function(response){
              Swal.fire(
                'Ops, algo deu errado!',
                'Infelizmente houve um problema e não conseguimos modificar o status do pedido!',
                'error'
              )
              // window.location.reload()
            }
          });
        }
      })
    })

    // filtro por dia
    $('#filtro_por').on('change', function (e) {
    var dia = this.value;
      $.ajax({
        url: '{{route('filtro.por.dia.balcao')}}' + '/' +  dia,
        method: "GET",
        success: function (response) {
          window.location.href = '{{route('filtro.por.dia.balcao')}}' + '/' +  dia;
        },
        error: function(response){
        }
      });
    });
  });
</script>

{{-- carrega o text box com mensagem da configuracao da empresa --}}
<script type="text/javascript">
  $(document).ready(function() {
    //configura modal edita status
    $('#mudarStatusPedido').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var pedidoid = button.data('pedidoid');
        var modal  = $(this);
        modal.find('.modal-body #pedidoid').val(pedidoid);
      });

    $('.status').change(function (){
      var newStatus = $(this).val();

      if(newStatus == '1'){
        $("#campomsg").val({!! json_encode($config->statusrecebido) !!});

      }else if(newStatus == '2'){
        $("#campomsg").val({!! json_encode($config->statuspreparando) !!});
      }else if(newStatus == '3'){
        $("#campomsg").val({!! json_encode( $config->statusentregando) !!});
      }else if(newStatus == '4'){
        $("#campomsg").val({!! json_encode( $config->statusentregue) !!});
      }else if(newStatus == '5'){
        $("#campomsg").val({!! json_encode( $config->statuscancelado) !!});
      }
    });
  });
</script>

@endpush
@endsection