@extends('layouts.app', [
'namePage' => 'novo contato',
'class' => 'sidebar-mini',
'activePage' => '',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="content">
  <div class="row">
    <div class="col-md-12 text-center">
      <img src="{{URL::asset('assets/img/unauthorized-license.png')}}" style="width: 100%; max-width:600px; margin:110px auto 0" alt="Acesso não permitido" alt="Acesso não permitido">
    </div>
  </div>
</div>
@endsection
