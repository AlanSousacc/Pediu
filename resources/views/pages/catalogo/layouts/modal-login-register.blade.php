<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#signin-tab" data-toggle="tab" role="tab" aria-selected="true">
              <i class="fas fa-user-lock"></i> Logar
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#signup-tab" data-toggle="tab" role="tab" aria-selected="false">
              <i class="fas fa-user-alt"></i> Registrar
            </a>
          </li>
        </ul>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body tab-content py-4">
        <form class="needs-validation tab-pane fade show active" action="{{ route('login') }}" method="POST" autocomplete="off" id="signin-tab">
          @csrf
          <div class="form-group">
            <label for="si-email">Endereço de Email</label>
            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="si-email" name="email" placeholder="maria@example.com" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span class="invalid-feedback" style="display: block;" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="si-password">Senha</label>
            <div class="password-toggle">
              <input class="form-control" type="password" name="password" id="si-password" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox">
                <i class="far fa-eye"></i>
                <span class="sr-only">Mostrar Senha</span>
              </label>
            </div>
          </div>
          <div class="form-group d-flex flex-wrap justify-content-between">
            <div class="custom-control custom-checkbox mb-2">
              <input class="custom-control-input" type="checkbox" id="si-remember">
              <label class="custom-control-label" for="si-remember">Lembrar-me</label>
            </div><a class="font-size-sm" href="#">Esqueceu a Senha?</a>
          </div>
          <button class="btn btn-primary btn-block btn-shadow" type="submit">Logar</button>
        </form>
        <form class="needs-validation tab-pane fade" action="{{ route('register') }}" method="POST" autocomplete="off" id="signup-tab">
          @csrf
          <h6 class="text-center">Preencha todos os campos abaixo</h6>
          <input type="hidden" name="principal" value="1">
          <div class="form-group">
            <label for="su-name">Nome Completo</label>
            <input class="form-control" type="text" id="su-name" name="name" placeholder="John Doe" required>
            <div class="invalid-feedback">Por favor, preencha seu nome.</div>
          </div>
          <input type="hidden" name="profile" value="User Loja">
          <input type="hidden" name="empresa_id" value="{{$empresa->id}}">
          <div class="form-group">
            <label for="su-email">Endereço de Email</label>
            <input class="form-control" type="email" id="su-email" name="email" placeholder="johndoe@example.com" required>
            <div class="invalid-feedback">Por favor, forneça um endereço de e-mail válido.</div>
          </div>
          <div class="form-group">
            <label for="su-password">Senha</label>
            <div class="password-toggle">
              <input class="form-control" type="password" name="password" id="su-password" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox">
                <i class="far fa-eye"></i>
                <span class="sr-only">Mostrar Senha</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="su-password-confirm">Confirme a Senha</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="su-password-confirm" name="password_confirmation" required>
              <label class="password-toggle-btn">
                <input class="custom-control-input" type="checkbox">
                <i class="far fa-eye"></i>
                <span class="sr-only">Mostrar Senha</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="su-cidade">Cidade</label>
            <input class="form-control" type="text" id="su-cidade" name="cidade" placeholder="Cidade" required>
            <div class="invalid-feedback">Por favor, informe sua cidade.</div>
          </div>
          <div class="form-group">
            <label for="su-endereco">Endereco</label>
            <input class="form-control" type="text" id="su-endereco" name="endereco" placeholder="Endereço" required>
            <div class="invalid-feedback">Por favor, informe seu endereço.</div>
          </div>
          <div class="form-group">
            <label for="su-numero">Número</label>
            <input class="form-control" type="text" id="su-numero" name="numero" placeholder="123" required>
            <div class="invalid-feedback">Por favor, informe o número da sua residência.</div>
          </div>
          <div class="form-group">
            <label for="su-bairro">Bairro</label>
            <input class="form-control" type="text" id="su-bairro" name="bairro" placeholder="Bairro" required>
            <div class="invalid-feedback">Por favor, informe seu bairro.</div>
          </div>
          <div class="form-group">
            <label for="su-telefone">Telefone*</label>
            <input class="form-control" type="tel" id="su-telefone" name="telefone" placeholder="(16) 99999-9999" required>
            <div class="invalid-feedback">Por favor, forneça seu telefone.</div>
          </div>
          <button class="btn btn-primary btn-block btn-shadow" type="submit">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
