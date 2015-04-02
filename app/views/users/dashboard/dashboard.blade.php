@extends('dashboard')

@section('browser-title')
Dashboard
@stop

@section('content')
<h1>Dashboard</h1>

<br>
<br>
  
<section class="col-lg2 col-md-2 col-xs-12 col-sm-2 text-center">
	<a href="/users/account">
	<span class="icon-2x"><i class="icon icon-user"></i></span>
	</a>
	<br>
	Your Account
</section>

@if((Auth::check()) && (Auth::user()->access_level == 3))
	
	@if (Auth::user()->roles->contains(7))
	<section class="col-lg-2 col-md-2 col-xs-12 col-sm-2 text-center">
		<a href="/calendar/addevent">
		<i class="icon-calendar icon-2x"></i>
		</a>
		<br>
		Add Calendar Event
	</section>
	@endif
	
	@if (Auth::user()->roles->contains(6))
	<section class="col-lg-2 col-md-2 col-xs-12 col-sm-2 text-center">
		<a href="/admin/galleryupload">
		<i class="icon-camera icon-2x"></i>
		</a>
		<br>
		Add Gallery Image
	</section>
	@endif
	
	@if (Auth::user()->roles->contains(1))
	<section class="col-lg2 col-md-2 col-xs-12 col-sm-2 text-center">
		<a href="/admin/createpage">
		<span class="icon-2x"><i class="icon icon-plus"></i></span>
		</a>
		<br>
		Add Site Page
	</section>
	@endif
	
	@if (Auth::user()->roles->contains(2))
	<section class="col-lg2 col-md-2 col-xs-12 col-sm-2 text-center">
		<a href="/admin/addnews">
		<span class="icon-2x"><i class="icon icon-plus"></i></span>
		</a>
		<br>
		Add News Item
	</section>
	@endif
	
	@if (Auth::user()->roles->contains(5))
	<section class="col-lg2 col-md-2 col-xs-12 col-sm-2 text-center">
		<a href="/admin/addfaq">
		<i class="icon-question icon-2x"></i>
		</a>
		<br>
		Add FAQ
	</section>
	@endif
	
@endif


@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$('.tt').tooltip();
});
</script>
@stop