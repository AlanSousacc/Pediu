<div class="row">
  <div class="form-group col-md-4">
    <label for="profile">Tipo de Usuário*</label>
    <select id="profile" class="form-control" name="profile" required>
      {{-- <option value="S" {{isset($empresa) &&  $empresa->active == 'S' ? 'selected' : ''}}>Ativo</option> --}}
      <option value="Administrador" >Administrador</option>
      <option value="Usuario" >Usuario</option>
    </select>
  </div>

  @if ((Auth::user()) && (Auth::user()->isAdmin == 1) && (Auth::user()->empresa_id == 1))
  <div class="form-check form-check-inline mt-2">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin" value="1"> É Super Usuário
      <span class="form-check-sign"></span>
    </label>
  </div>
  @endif

</div>

<hr>
<label for="profile">Dados de Login*</label>
<div class="row">
  <div class="col-md-6">
    <div class="input-group {{ $errors->has('name') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons users_circle-08"></i>
        </div>
      </div>
      <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome Completo') }}" type="text" name="name" value="{{isset($user) ? $user->name : old('name')}}" required autofocus>
      @if ($errors->has('name'))
      <span class="invalid-feedback" style="display: block;" role="alert">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="input-group {{ $errors->has('email') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons ui-1_email-85"></i>
        </div>
      </div>
      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{isset($user) ? $user->email : old('email')}}" required>
    </div>
    @if ($errors->has('email'))
    <span class="invalid-feedback" style="display: block;" role="alert">
      <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="input-group {{ $errors->has('password') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons objects_key-25"></i>
        </div>
      </div>
      <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('(Senha)') }}" type="password" name="password" {{!isset($user) ? 'required' : ''}}>
      @if ($errors->has('password'))
      <span class="invalid-feedback" style="display: block;" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
      @endif
    </div>  
  </div>

  <div class="col-md-6">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons objects_key-25"></i></i>
        </div>
      </div>
      <input class="form-control" placeholder="{{ __('Confirmação de Senha') }}" type="password" name="password_confirmation" {{!isset($user) ? 'required' : ''}} >
    </div>
  </div>
</div>

<hr>
<label for="profile">Endereço*</label>
<div class="row">
  <div class="col-md-6">
    <div class="input-group {{ $errors->has('cidade') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons users_circle-08"></i>
        </div>
      </div>
      <input class="form-control {{ $errors->has('cidade') ? ' is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" type="text" name="cidade" value="{{isset($endereco) ? $endereco->cidade : old('cidade')}}" required>
      @if ($errors->has('cidade'))
      <span class="invalid-feedback" style="display: block;" role="alert">
        <strong>{{ $errors->first('cidade') }}</strong>
      </span>
      @endif
    </div>
  </div>

  <div class="col-md-4">
    <div class="input-group {{ $errors->has('endereco') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons users_circle-08"></i>
        </div>
      </div>
      <input class="form-control {{ $errors->has('endereco') ? ' is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" type="text" name="endereco" value="{{isset($endereco) ? $endereco->endereco : old('endereco')}}" required>
      @if ($errors->has('endereco'))
      <span class="invalid-feedback" style="display: block;" role="alert">
        <strong>{{ $errors->first('endereco') }}</strong>
      </span>
      @endif
    </div>
  </div>

  <div class="col-md-2">
    <div class="input-group {{ $errors->has('numero') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="now-ui-icons users_circle-08"></i>
        </div>
      </div>
      <input class="form-control {{ $errors->has('numero') ? ' is-invalid' : '' }}" placeholder="{{ __('Número') }}" type="text" name="numero" value="{{isset($endereco) ? $endereco->numero : old('numero')}}" required>
      @if ($errors->has('numero'))
      <span class="invalid-feedback" style="display: block;" role="alert">
        <strong>{{ $errors->first('numero') }}</strong>
      </span>
      @endif
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="input-group {{ $errors->has('bairro') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fa fa-phone"></i>
        </div>
      </div>
      <input class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }} bairro" placeholder="Bairro" type="text" name="bairro" value="{{isset($endereco) ? $endereco->bairro : old('bairro')}}" required>
    </div>
    @if ($errors->has('bairro'))
    <span class="invalid-feedback" style="display: block;" role="alert">
      <strong>{{ $errors->first('bairro') }}</strong>
    </span>
    @endif
  </div>

  <div class="col-md-6">
    <div class="input-group {{ $errors->has('telefone') ? ' has-danger' : '' }}">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fa fa-phone"></i>
        </div>
      </div>
      <input class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }} telefone" placeholder="(00) 00000-0000" type="text" name="telefone" value="{{isset($endereco) ? $endereco->telefone : old('telefone')}}" required>
    </div>
    @if ($errors->has('telefone'))
    <span class="invalid-feedback" style="display: block;" role="alert">
      <strong>{{ $errors->first('telefone') }}</strong>
    </span>
    @endif
  </div>
</div>  

