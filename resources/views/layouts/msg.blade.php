@if(Session::has('success'))
<div class="alert alert-success p-2">
	<a style="text-align: center;" class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('success') }}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger p-2">
	<a style="text-align: center;" class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('error') }}
</div>
@endif