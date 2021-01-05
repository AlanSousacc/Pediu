@if($errors->any())
<div class="alert alert-danger alert-with-icon" data-notify="container">
	<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
		<i class="now-ui-icons ui-1_simple-remove"></i>
	</button>
	<span data-notify="icon" class="now-ui-icons travel_info"></span>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif

@if(\Session::has('success'))
<div class="alert alert-success alert-with-icon" data-notify="container">
	<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
		<i class="now-ui-icons ui-1_simple-remove"></i>
	</button>
	<span data-notify="icon" class="now-ui-icons ui-1_check"></span>
	<span data-notify="message">{{\Session::get('success')}}</span>
</div>
@elseif(\Session::has('error'))
<div class="alert alert-danger alert-with-icon" data-notify="container">
	<button type="button" aria-hidden="true" data-dismiss="alert" class="close">
		<i class="now-ui-icons ui-1_simple-remove"></i>
	</button>
	<span data-notify="icon" class="now-ui-icons travel_info"></span>
	<span data-notify="message">{{\Session::get('error')}}</span>
</div>
@endif
