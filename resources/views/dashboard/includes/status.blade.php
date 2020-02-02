@if ($errors->any())
<div class="mt-4 alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

@if (session()->has('msg_success'))
<div class="mt-4 alert alert-success text-sm-center">
	<button class="close" type="button" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
	<h5>{{ session('msg_success') }}</h5>
</div>
@endif

@if (session()->has('msg_danger'))
<div class="mt-4 alert alert-danger text-sm-center">
	<button class="close" type="button" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
	<h5>{{ session('msg_danger') }}</h5>
</div>
@endif
