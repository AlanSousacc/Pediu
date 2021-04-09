@extends('pages.catalogo.layouts.master-catalogo')
@section('content')
<!-- Sign in / sign up modal-->
@extends('pages.catalogo.layouts.modal-login-register')
{{-- header --}}
@extends('layouts.messages.message-loja')
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
      <h1 class="h3 text-light mb-0">Informações do Perfil</h1>
    </div>
  </div>
</div>
{{-- end header --}}
<section class="container tab-content py-4 py-sm-5">
  <div class="row">
    {{-- content --}}
    <div class="container pb-5 mb-2 mb-md-3">
      <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-3 pt-4 pt-lg-0">
          <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
            <div class="px-4 mb-4">
              <div class="media align-items-center">
                <div class="media-body pl-3">
                  <h3 class="font-size-base mb-0">{{auth()->user()->name}}</h3><span class="text-accent font-size-sm">{{auth()->user()->email}}</span>
                </div>
              </div>
            </div>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Dashboard</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('profile.pedidos', array($empresa->slug, auth()->user()->id))}}">
                  <i class="fas fa-shopping-bag opacity-60 mr-2"></i>  Pedidos
                </a>
              </li>
            </ul>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="{{route('profile', array($empresa->slug, auth()->user()->id))}}">
                  <i class="fas fa-info-circle opacity-60 mr-2"></i>Informações do Perfil</a>
                </li>
                <li class="border-bottom mb-0">
                  <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('profile-address', array($empresa->slug, auth()->user()->id))}}">
                    <i class="fas fa-map-marked-alt opacity-60 mr-2"></i>Endereço</a>
                  </li>
                  <li class="border-top mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                      <i class="fa fa-sign-in-alt opacity-60 mr-2"></i>Sair
                      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </a>
                  </li>
                </ul>
              </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-9">
              <!-- Toolbar-->
              <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
              </div>
              <form action="{{route('user.update', auth()->user()->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="name">Nome Completo</label>
                      <input class="form-control" type="text" name="name" id="name" value="{{auth()->user()->name}}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">Endereço de Email</label>
                      <input class="form-control" type="email" name="email" id="email" value="{{auth()->user()->email}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-phone">Número de Telefone</label>
                      <input class="form-control" type="tel" name="telefone" id="telefone" value="{{auth()->user()->telefone}}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password">Nova Senha</label>
                      <div class="password-toggle">
                        <input class="form-control" type="password" name="password" id="password">
                        <label class="password-toggle-btn">
                          <input class="custom-control-input" type="checkbox">
                          <i class="far fa-eye"></i>
                          <span class="sr-only">Mostrar Senha</span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-confirm-pass">Confirmar Senha</label>
                      <div class="password-toggle">
                        <input class="form-control" type="password" id="account-confirm-pass">
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                      <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Atualizar Perfil</button>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </div>
        {{-- endcontent --}}
      </div>
    </section>
    @push('scripts')
    <script type="text/javascript">
      $(document).ready(function () {
        $('#telefone').mask('(00) 00000-0000');
      });
    </script>
    @endpush
    @endsection

