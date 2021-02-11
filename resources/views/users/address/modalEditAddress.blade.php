<div id="edit-address" class="modal fade text-dark bd-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-default" style="text-align: center; display: inline;">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
          <i class="now-ui-icons ui-1_simple-remove" style="color: #fff"></i>
        </button>
        <h4 class="modal-title text-center">Cadastro de Endereço</h4>
      </div>
      <form action="{{route('address-user.store')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
        <div class="modal-body">
          <div class="content">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="principal" id="principal"
                    {{isset($user) && $user->principal != null && $user->principal == 1 ?	'checked' : ''}}>
                    <label class="custom-control-label pt-1" for="principal">Endereço Principal</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="endereco">Endereço*</label>
                  <input type="text" class="form-control" id="endereco" name="endereco" value="{{isset($user) ? $user->endereco : old('endereco')}}" placeholder="Rua:..." required>
                  @include('alerts.feedback', ['field' => 'endereco'])
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="numero">Número*</label>
                  <input type="text" class="form-control" id="numero" name="numero" value="{{isset($user) ? $user->numero : old('numero')}}" placeholder="000" required>
                  @include('alerts.feedback', ['field' => 'numero'])
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="bairro">Bairro*</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" value="{{isset($user) ? $user->bairro : old('bairro')}}" placeholder="Bairro" required>
                  @include('alerts.feedback', ['field' => 'bairro'])
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cidade">Cidade*</label>
                  <input type="text" class="form-control" id="cidade" name="cidade" value="{{isset($user) ? $user->cidade : old('cidade')}}" placeholder="Cidade." required>
                  @include('alerts.feedback', ['field' => 'cidade'])
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone">Telefone*</label>
                  <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{isset($user) ? $user->telefone : old('telefone')}}" placeholder="Ex. (99) 99999-9999">
                  @include('alerts.feedback', ['field' => 'telefone'])
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <center>
            <button type="submit" class="btn btn-danger">Salvar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </center>
        </div>
      </form>
    </div>
  </div>
</div>
