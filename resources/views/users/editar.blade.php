@extends('layouts.app', [
'namePage' => 'editar usuário',
'class' => 'sidebar-mini',
'activePage' => 'editarusuario',
])
@section('content')
<div class="col-md-3 offset-md-9 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-10 offset-1">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{__(" Editar Usuário")}}</h5>
        </div>
        <div class="card-body">
				<form action="{{route('user.update', $user->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="user_id" value="{{$user->id}}">
					<input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @csrf
					@include('alerts.success')
					@include('users.formUsers')
					<div class="card-footer ">
						<button type="submit" class="btn btn-primary btn-round">{{__('Salvar Alterações')}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
{{-- <script src='https://cdnjs.com/libraries/jquery.mask'></script> --}}
<script src='{{asset('js/contato/contato.js')}}'></script>
@endpush
@endsection