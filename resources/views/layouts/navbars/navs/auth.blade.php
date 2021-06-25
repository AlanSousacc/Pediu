<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid d-inline">
    <div class="d-flex justify-content-between">
      <div class="top-menu d-flex align-items-center">
        <div class="navbar-wrapper">
          <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
          <a class="navbar-brand" href="#">{{ $namePage }}</a>
        </div>
      </div>
      <div class="top-menu d-flex align-items-center">
        <div class="dropdown">
          <a class="text-decoration-none mr-4" href="{{route('caixa')}}"><i class="fa fa-inbox"></i> Caixa</a>
        </div>

        <div class="dropdown">
          <a class="dropdown-toggle text-decoration-none" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons users_single-02"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            @if (Auth::user()->profile == 'Administrador')
            <a class="dropdown-item"
              href="{{ route('empresa.edit', Auth::user()->empresa->uuid)}}">{{ __("Minha Empresa") }}</a>
            @endif
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("Editar Perfil") }}</a>
            <a class="dropdown-item" href="{{ route('register') }}">{{ __("Novo Usuário") }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>