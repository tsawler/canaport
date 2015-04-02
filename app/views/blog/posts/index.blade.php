@extends('blog')



@section('hero-unit')
<div class="hero-unit">
	<div class="container">
		<h1>News</h1>
	</div>
	<!--close container--> 
</div>
<!--close hero-unit-->
@endsection

@section('content')

	@include('blog.partials.list')

@stop