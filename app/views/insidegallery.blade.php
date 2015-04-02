<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
@include('partials.head')
<body class="page">
@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
	@include('partials/modals')
@endif

<div id="main">

	@include('partials/preheader')
	@include('partials/header')
	
	<div id="content">
		<div id="bluewave" class="content">
			<div class="container">
				<div class="row">
					
						@yield('content')
					
				</div>
			</div>
		</div>
		@yield('pre-footer')
	</div>
	
	@include('partials/bottom_of_page')
	
</div>

@include('partials/layout_javascript')
@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
	<input type="hidden" name="old" id="old">
	<input type="hidden" name="oldtitle" id="oldtitle">
@endif
<script src="/js/jquery.isotope.js"></script>
<script src="/js/portfolio.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="/js/jquery.pnotify.min.js"></script>
@yield('bottom-js')
@include('partials/messages')

</body>
</html>