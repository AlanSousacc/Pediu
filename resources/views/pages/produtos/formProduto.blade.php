<div class="content">
  <div class="row">
    <div class="form-group col-md-2">
      <label for="status">Status*</label>
      <select id="status" class="form-control" name="status" required>
        <option value="1" >Ativo</option>
        <option value="0" >Inativo</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="controlatamanho">Controla Tamanho*</label>
      <select id="controlatamanho" class="form-control" name="controlatamanho" required>
        <option {{isset($produto) && $produto->controlatamanho == 0 ? 'selected' : ''}} value="0" >Não</option>
        <option {{isset($produto) && $produto->controlatamanho == 1 ? 'selected' : ''}} value="1" >Sim</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="saboresdiversos">Permite meio a meio*</label>
      <select id="saboresdiversos" class="form-control" name="saboresdiversos" required>
        <option {{isset($produto) && $produto->saboresdiversos == 0 ? 'selected' : ''}} value="0" >Não</option>
        <option {{isset($produto) && $produto->saboresdiversos == 1 ? 'selected' : ''}} value="1" >Sim</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="grupo_id">Grupo</label>
      <select id="grupo_id" class="form-control" name="grupo_id" required>
        {{-- <option value="0" >Escolha um grupo</option> --}}
        @foreach ($grupos as $item)
        <option {{isset($produto) && $produto->grupo_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->descricao}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-3 mt-3">
      <a href="" class="btn btn-primary" data-contid="{{$item->id ?? ''}}" data-target="#creategrupo" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Criar Grupo</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="descricao">Descrição*</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{isset($produto) ? $produto->descricao : old('nome')}}" placeholder="Descrição do Produto" required>
        @include('alerts.feedback', ['field' => 'descricao'])
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <label for="composicao">Composição*</label>
        <input type="text" class="form-control" id="composicao" name="composicao" value="{{isset($produto) ? $produto->composicao : old('composicao')}}" placeholder="Ingredientes que compões este produto" required>
        @include('alerts.feedback', ['field' => 'composicao'])
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-2 precocusto">
          <label for="precocusto" class="col-sm-12 col-form-label">Pr. Custo</label>
          <div class="input-group input-group-md">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" name="precocusto" class="form-control" value="{{isset($produto) ? number_format($produto->precocusto, 2, ',', '.') : old('precocusto')}}" id="precocusto">
          </div>
        </div>
        <div class="col-md-2 precovenda">
          <label for="precovenda" class="col-sm-12 col-form-label">Pr. Venda</label>
          <div class="input-group input-group-md">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" name="precovenda" class="form-control" value="{{isset($produto) ? number_format($produto->precovenda, 2, ',', '.') : old('precovenda')}}" id="precovenda">
          </div>
        </div>
        <div class="col-md-2 precopequeno">
          <label for="precopequeno" class="col-sm-12 col-form-label">Pr. Pequeno</label>
          <div class="input-group input-group-md">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" name="precopequeno" class="form-control" value="{{isset($produto) ? number_format($produto->precopequeno, 2, ',', '.') : old('precopequeno')}}" id="precopequeno">
          </div>
        </div>
        <div class="col-md-2 precomedio">
          <label for="precomedio" class="col-sm-12 col-form-label">Pr. Médio</label>
          <div class="input-group input-group-md">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" name="precomedio" class="form-control" value="{{isset($produto) ? number_format($produto->precomedio, 2, ',', '.') : old('precomedio')}}" id="precomedio">
          </div>
        </div>
        <div class="col-md-2 precogrande">
          <label for="precogrande" class="col-sm-12 col-form-label">Pr. Grande</label>
          <div class="input-group input-group-md">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" name="precogrande" class="form-control" value="{{isset($produto) ? number_format($produto->precogrande, 2, ',', '.') : old('precogrande')}}" id="precogrande">
            @include('alerts.feedback', ['field' => 'precogrande'])
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label for="foto">Imagem</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="foto" name="foto">
            <label class="custom-file-label" for="customFile">Escolha sua Imagem</label>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="col-md-8 offset-3">
        <img id="imgfoto" src="{{ isset($produto) && $produto->foto != 'default.png' ? url("storage/".$produto->foto) : url("storage/img/logos/default.png")}} " alt="Imagem do produto" style="width: 150px; height:150px"/>
      </div>
    </div>
  </div>
  <input type="hidden" id="carregafoto" name="carregafoto" value="">
  <hr class="mt-4">
  <div class="row">
    <div class="col-md-9">
      <h4 class="mt-0">Complementos / Adicionais</h4>
    </div>
    <div class="col-md-3 text-right">
      <a href="#" class="btn btn-primary" data-contid={{$item->id ?? '' }} data-target="#createcomplemento" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Complemento</a>
    </div>
  </div>

  {{-- selecionar complemento --}}
  <div class="row">
    <div class="form-group col-md-4">
      <label class="col-md-12 control-label ml-2" for="complemento_id">#ID - Nome do Complemento</label>
      <div class="col-md-12">
        <select id="complemento_id" name="complemento_id" class="form-control js-example-basic-single">
          @foreach($complementos as $item)
          <option value="{{ $item->id }}">{!! $item->id !!} - {!! $item->descricao !!}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-md-2">
      <label for="precocomplemento" class="col ml-3">Preço</label>
      <div class="input-group col">
        <div class="input-group-prepend">
          <span class="input-group-text" style="background: #e3e3e3;">R$</span>
        </div>
        <input type="text" class="form-control precocomplemento text-center" id="precocomplemento" readonly>
      </div>
    </div>

    <div class="form-group col-md-3 mt-2">
      <button type="button" class="btn btn-primary btn-round mt-3" id="inserirComplemento" data-type="plus"></button>
    </div>
  </div>
  {{-- fim seleção de produtos --}}
  {{-- <hr class="divider"><br> --}}

  {{-- listagem dos itens --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
        <h6 class="">Complementos Inseridos a Este Produto</h6>
      </div>
      <div class="card-body">
        <table class="table">
          <thead class=" text-primary">
            <th class="text-center">Complemento / Adicional</th>
            <th class="text-center">Preço</th>
            <th class="text-center">Remover</th>
          </thead>
          <tbody id="listaProd">
            <td class="loading bg-info text-center" colspan="3">Aguarde <i class="fas fa-spinner fa-pulse fa-2x"></i></td>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <hr class="divider"><br>
  {{-- fim listagem dos itens --}}
</div>
