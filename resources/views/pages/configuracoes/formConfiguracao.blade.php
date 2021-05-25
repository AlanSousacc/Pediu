<div class="content">
  <h4 class="mt-1">Configurações de Pedidos</h4>
  <span class="d-block mb-3">Esta opção define se a empresa realiza pedidos de venda dentro do sistema.</span>
  <div class="row">
    <div class="col-md-2 mt-1" data-toggle="tooltip" data-placement="top" title="Esta opção determina se o lojista fará pedidos no balcão, atendimento a clientes.">
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="controlepedidosbalcao" id="controlepedidosbalcao"
          {{$config->controlepedidosbalcao != null && $config->controlepedidosbalcao == 1 ?	'checked' : ''}}>
          <label class="custom-control-label pt-1" for="controlepedidosbalcao">Faz Pedidos Balcão</label>
        </div>
      </div>
    </div>
  </div>
  <hr>

  <h4 class="mt-1">Configurações de Entrega</h4>
  <div class="row">
    <div class="col-md-2 mt-1" data-toggle="tooltip" data-placement="top" title="Esta opção determina se o usuário escolherá um entregador para fazer a entrega, caso esteja habilitado, o usuário deverá fazer o a conferência do valor recebido pelo entregador, caso contrário, o cliente ficará em débito no sistema!">
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="controlaentrega" id="controlaentrega"
          {{$config->controlaentrega != null && $config->controlaentrega == 1 ?	'checked' : ''}}>
          <label class="custom-control-label pt-1" for="controlaentrega">Controla Entrega Balcao</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="d-flex align-items-center">
        <label class="text-nowrap mr-3 mb-2" for="fd-change">Valor padrão de entrega:</label>
        <div class="input-group" style="width: 8rem;">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar-sign"></i></span></div>
          <input class="form-control bg-0 pr-3" type="text" id="valorentrega" name="valorentrega" value="{{number_format($config->valorentrega, 2, ',', '.')}}">
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="d-flex align-items-center">
        <label class="text-nowrap mr-3 mb-2" for="fd-change">Tempo Mínimo de Entrega:</label>
        <div class="input-group">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-stopwatch"></i></span></div>
          <input class="form-control bg-0 pr-3" type="text" name="tempominimoentrega" value="{{$config->tempominimoentrega}}">
        </div>
      </div>
    </div>
  </div>
  <hr>

  <h4 class="mt-1">Mensagens de Status</h4>
  <span class="d-block mb-3">Defina aqui os textos padrões que será exibido ao selecionar um status do pedido</span>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="statusrecebido">Recebimento de Pedido*</label>
        <input type="text" class="form-control" id="statusrecebido" name="statusrecebido" value="{{$config->statusrecebido. ' Tempo médio para entrega de: '. $config->tempominimoentrega}}" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="statuspreparando">Preparando Pedido*</label>
        <input type="text" class="form-control" id="statuspreparando" name="statuspreparando" value="{{$config->statuspreparando}}"  required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="statusentregando">Pedido a Caminho*</label>
        <input type="text" class="form-control" id="statusentregando" name="statusentregando" value="{{$config->statusentregando}}" placeholder="Bairro">
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="statusentregue">Pedido Entregue*</label>
        <input type="text" class="form-control" id="statusentregue" name="statusentregue" value="{{$config->statusentregue}}" required>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="statuscancelado">Pedido Cancelado*</label>
      <input type="text" class="form-control" id="statuscancelado" name="statuscancelado" value="{{$config->statuscancelado}}" required>
    </div>
  </div>
</div>

<hr>
<h4 class="mt-1">Personalização visual</h4>
<span class="d-block mb-3">Escolha uma cor para personalizar o menu à esquerda</span>
<div class="row">
  <div class="col-md-12 my-2">
    <input type="checkbox" name="colorsidebar" value="red" {{$config->colorsidebar == 'red' ?	'checked' : ''}}> <i class="fa fa-circle text-danger"></i> Vermelho
  </div>
  <div class="col-md-12 my-2">
    <input type="checkbox" name="colorsidebar" value="yellow" {{$config->colorsidebar == 'yellow' ?	'checked' : ''}}> <i class="fa fa-circle text-warning"></i> Amarelo
  </div>
  <div class="col-md-12 my-2">
    <input type="checkbox" name="colorsidebar" value="blue" {{$config->colorsidebar == 'blue' ?	'checked' : ''}}> <i class="fa fa-circle text-info"></i> Azul
  </div>
  <div class="col-md-12 my-2">
    <input type="checkbox" name="colorsidebar" value="green" {{$config->colorsidebar == 'green' ?	'checked' : ''}}> <i class="fa fa-circle text-success"></i> Verde
  </div>
</div>