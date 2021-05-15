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
<!--Begin input email -->
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
<!--Begin input user type-->

<!--Begin input email -->
<div class="input-group {{ $errors->has('telefone') ? ' has-danger' : '' }}">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <i class="fa fa-phone"></i>
    </div>
  </div>
  <input class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="(00) 00000-0000" type="telefone" name="telefone" value="{{isset($user) ? $user->telefone : old('telefone')}}" required>
</div>
@if ($errors->has('telefone'))
<span class="invalid-feedback" style="display: block;" role="alert">
  <strong>{{ $errors->first('telefone') }}</strong>
</span>
@endif
<!--Begin input user type-->

<!--Begin input password -->
<div class="input-group {{ $errors->has('password') ? ' has-danger' : '' }}">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <i class="now-ui-icons objects_key-25"></i>
    </div>
  </div>
  <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('(Senha)') }}" type="password" name="password" required>
  @if ($errors->has('password'))
  <span class="invalid-feedback" style="display: block;" role="alert">
    <strong>{{ $errors->first('password') }}</strong>
  </span>
  @endif
</div>
<!--Begin input confirm password -->

<div class="input-group">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <i class="now-ui-icons objects_key-25"></i></i>
    </div>
  </div>
  <input class="form-control" placeholder="{{ __('Confirmação de Senha') }}" type="password" name="password_confirmation" required>
</div>