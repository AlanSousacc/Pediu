@extends('layouts.app', [
'namePage' => 'Listagem de Pedidos da loja',
'class' => 'sidebar-mini',
'activePage' => 'listagemPedidosLoja',
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
        <nav class="navbar navbar-expand-md navbar-light" style="background-color: #446280!important;">
          <a class="navbar-brand" href="#">Filtrar Pedidos Por Status</a>
          <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.index')}}"><i class="fa fa-certificate"></i> Todos</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 0)}}"><i class="fa fa-clock"></i> Pendente</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 1)}}"><i class="fa fa-check"></i> Aprovado</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 2)}}"><i class="fa fa-concierge-bell"></i> Preparando</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 3)}}"><i class="fa fa-shipping-fast"></i> Saiu para Entrega</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 4)}}"><i class="fa fa-check-double"></i> Entregue</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{route('pedidosloja.filterstatus', 5)}}"><i class="fa fa-ban"></i> Cancelado</a></li>
          </ul>
          <div class="form-inline col-sm-12 col-md-4 d-block w-100">
            <div class="form-group">
              <a class="navbar-brand ml-3" href="#">Filtrar Por Período</a>
              <input type="date" name="datapedido" class="form-control form-control-md mx-sm-3" id="filtro_por" value="{{isset(Request::route()->parameters['dia']) ? Request::route()->parameters['dia'] : ''}}" />
              <a href="{{route('pedidosloja.all')}}">Limpar</a>
            </div>
          </div>
        </nav>
        <div class="card-header">
          <h4 class="card-title"> Pedidos da Loja</h4>
          <small>* Mantenha essa página aberta! A cada minuto ela te atualiza sobre novos pedidos!</small>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="overflow: initial!important;">
            <table class="table">
              <thead class=" text-primary">
                <th class="text-center">#Pedido</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Telefone</th>
                <th class="text-center">Total</th>
                <th class="text-center">Status</th>
                <th class="text-center">Opções Pedido</th>
              </thead>
              <tbody>
                @foreach ($pedidos as $item)
                <tr style="{{$item->statuspedido == 0 ? 'border-left: 15px solid #18ce0f' : ''}}">
                  <td class="text-center">{{$item->numberorder}}</td>
                  <td class="text-center">{{$item->created_at->format('H:i:s')}}</td>
                  <td class="text-center">{{$item->user->name}}</td>
                  <td class="text-center">{{$item->endereco->telefone}}</td>
                  <td class="text-center">R$ {{number_format($item->totalpedido, 2, ',', '.')}}</td>
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
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opções
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('detalhe.pedido.loja', $item->id)}}"><i class="now-ui-icons files_paper"></i>Detalhar Pedido</a>
                        @if ($item->statuspedido != 4)
                        <a class="dropdown-item" href="{{$item->id}}"
                          data-pedidoid={{$item->id}}
                          data-target="#mudarStatus"
                          data-toggle="modal"><i class="now-ui-icons ion-shuffle"></i>Atualizar Status</a>
                        @endif
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td class="text-center" colspan="4"></td>
                    <td class="text-center" style="font-weight:600">R$ {{number_format($pedidos->sum('totalpedido'), 2, ',', '.')}}</td>
                    <td class="text-center" colspan="2"></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="row">
              <div class="col-md-6"><p>Mostrando {{$pedidos->count()}} pedidos de um total de {{$pedidos->total()}}</p></div>
              <div class="col-md-6">{{$pedidos->links()}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- modal Status pedido--}}
    @include('pages.pedidos.loja.modalStatusPedido')
  </div>
  @push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
              url: '{{route('pedidoloja.status')}}' + '/' + $('#pedidoid').val(),
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
              url: '{{route('pedidoloja.status')}}' + '/' + $('#pedidoid').val(),
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
                window.location.reload()
              }
            });
          }
        })
      })
    });
  </script>

  {{-- configura modal edita status --}}
  <script>
  $(document).ready(function () {
    $('#mudarStatus').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var pedidoid = button.data('pedidoid');
      var modal  = $(this);
      modal.find('.modal-body #pedidoid').val(pedidoid);
    });
  });
  </script>

{{-- atualiza página de minuto a minuto --}}
  <script>
    setTimeout(function(){
      window.location.reload(1);
    }, 60000);
  </script>

{{-- carrega o text box com mensagem da configuracao da empresa --}}
  <script type="text/javascript">
    $(document).ready(function() {
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

<script>
  $('#filtro_por').on('change', function (e) {
    var dia = this.value;
    $.ajax({
      url: '{{route('filtro.por.dia')}}' + '/' +  dia,
      method: "GET",
      success: function (response) {
        window.location.href = '{{route('filtro.por.dia')}}' + '/' +  dia;
      },
      error: function(response){
      }
    });
  });
</script>
  @endpush
  @endsection
