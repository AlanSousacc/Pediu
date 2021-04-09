@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')

<section class="container tab-content py-4 py-sm-5">
  <input type="hidden" class="empresa_slug" value="{{$empresa->slug}}">
  <div class="row">
    <!-- Product gallery-->
    <div class="col-lg-7 col-md-6 pr-lg-0 text-center">
      <img src="{{ $produto->foto != 'default.png' ? url("storage/".$produto->foto) : url("storage/img/logos/default.png")}}" alt="{{$produto->descricao}}" alt="{{$produto->descricao }}"/>
    </div>
    <!-- Product details-->
    <div class="col-lg-5 col-md-6 pt-4 pt-lg-0 product_data">
      <div class="product-details ml-auto pb-3">
        <h4 class="modal-title" id="descricao">{{$produto->descricao}}</h4>
        <div class="mb-3"><span class="small">R$ <i class="fas fa-spinner fa-pulse loader"></i></span><span class="h3 font-weight-normal text-accent mr-1" id="precovenda"></span></div>
        <form class="">
          <div class="row mx-n2">
            @if ($produto->controlatamanho)
            <div class="col-12 px-2">
              <div class="mb-3">
                <h6 class="font-size-sm mb-2">Tamanho:</h6>
                <select class="form-select" id="tamanhoitem">
                  <option value="precopequeno">Pequeno</option>
                  <option value="precomedio">Médio</option>
                  <option value="precogrande">Grande </option>
                </select>
              </div>
            </div>
            @endif
          </div>
          <input type="hidden" class="item_id" value="{{$produto->id}}">
          <input type="hidden" class="produtosize" value="">
          <div class="row">
            <div class="col-md-12">
              <h6 class="font-size-sm mb-2">Quantas unidades:</h6>
              <input type="hidden" class="qty-input" value="1">
              <div class="form-group d-flex align-items-center">
                <select class="custom-select w-100" id="qtdeselect" style="width: 5rem;">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
              </div>
            </div>
          </div>
          @if (isset($produto->grupo) && $produto->grupo->descricao == 'Pizza')
          <div class="row">
            <div class="col-md-12">
              <h6 class="font-size-sm">Sabores: (Opcional)<small> Meio a Meio Até 4 sabores</small></h6>
              <select class="saboresdiversos" multiple="multiple" style="width: 100%">
                <option selected="selected" value="{{$produto->id}}">{{$produto->descricao}}</option>
                @foreach ($produtos as $item)
                <option value="{{$item->id}}">{{$item->descricao}}</option>
                @endforeach
              </select>
            </div>
          </div>
          @endif
        </form>
        @if (count($produto->complementos) > 0)
        <h6 class="font-size-sm">Adicional: (Opcional)</h6>
        @endif
        <div class="row">
          @foreach ($produto->complementos as $item)
          <div class="col-md-4 my-2">
            <div class="form-check pr-3" style="display: contents">
              <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-success w-100">
                  <input type="checkbox" autocomplete="off" name="complemento_id[]" value='{{$item->id}}' id="complemento_id[{{$item->id}}]">{{$item->descricao}}
                </label>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="row">
          <div class="col-12 mb-4">
            <label class="mb-3" for="observacaoitem"><span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Observação do Produto: (Opcional)</span></label>
            <textarea class="form-control" style="resize: none" name="observacaoitem" placeholder="Descreva aqui uma observação, por ex: Sem Cebola, Sem Alface, etc..." rows="2" id="observacaoitem"></textarea>
          </div>
        </div>
        <div class="row mt-4">
          <di class="col-md-12">
            <h5 class="h6 mb-3 pb-3"><i class="fa fa-info-circle text-muted font-size-lg align-middle mt-n1 mr-2"></i>Detalhes do Produto</h5>
            <h6 class="font-size-sm mb-2">Ingredientes:</h6>
            <p class="font-size-sm border-bottom pb-1" id="composicao">{{$produto->composicao}}</p>
          </di>
        </div>
        @auth
        <button class="btn btn-success btn-shadow btn-block add-to-cart-btn" type="submit">
          <i class="fas fa-cart-plus font-size-lg mr-2"></i></i>Adicionar ao Carrinho
        </button>
        @endauth
        @guest
        <a class="navbar-tool ml-2 btn btn-primary" href="#signin-modal" data-toggle="modal">
          <i class="far fa-user mr-2"></i> Faça login e adicione ao carrinho
        </a>
        @endguest
      </div>
    </div>
  </div>
</section>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- define quantidade de seleção de sabores --}}
<script>
  $(".saboresdiversos").select2({
    maximumSelectionLength: 4
  });
</script>

<script>
  $("#qtdeselect").change(function(){
    var qtde = $(this).val();
    $('.qty-input').val(qtde);
  });
</script>

<script>
  function carregaPrecoQtde(){
    let tamanho   = typeof($('#tamanhoitem').val()) != 'undefined' ? $('#tamanhoitem').val() : 'precovenda'
    let empresa   = $('.empresa_slug').val()
    let produtoid = $('.item_id').val()

    $.ajax({
      url: '{{route('busca.precoitem')}}' + '/' + empresa + '/' + produtoid + '/' + tamanho,
      type: "get",
      dataType: "json",
      beforeSend: function () {
        $('.loader ').show();
        $('.add-to-cart-btn').prop('disabled', 'true')
        $('#precovenda').hide()
      },
      complete: function () {
        $('.loader ').hide();
        $('.add-to-cart-btn').prop('disabled', false)
        $('#precovenda').show()
      }
    }).done(function(resposta) {
      let dados = resposta.data;
      $('#precovenda').text(resposta.data.toFixed(2))
      $('.produtosize').val(tamanho)
    }).fail(function(jqXHR, textStatus ) {
      alert("Falha ao carregar preço do produto: " + textStatus);
    });

  }

  $(document).ready(function() {
    carregaPrecoQtde();
  });

  $('#tamanhoitem').on('change',function(ev){
    carregaPrecoQtde();
  });
</script>
@endpush
@endsection

