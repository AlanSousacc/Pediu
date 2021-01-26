<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <a class="navbar-brand" href="#pablo">{{ $namePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="now-ui-icons users_single-02"></i> {{Auth::user()->name}}
        </button>
        <div class="dropdown-menu">
          @if (Auth::user()->profile == 'Administrador')
          <a class="dropdown-item" href="{{ route('empresa.edit', Auth::user()->empresa->uuid)}}">{{ __("Minha Empresa") }}</a>
          @endif
          <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("Editar Perfil") }}</a>
          <a class="dropdown-item" href="{{ route('register') }}">{{ __("Novo Usuário") }}</a>
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
      </div>
    </div>
  </div>
</div>
</nav>
<!-- End Navbar -->
