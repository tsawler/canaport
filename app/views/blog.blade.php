<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
@include('partials.head')
<body class="blog">
@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
	@include('partials/modals')
@endif

<div class="wrap">

@include('partials/preheader')
@include('partials/header')

<div id="main">
	<div id="bluewave" class="content">
		<div class="container">
			<div class="row">
				<div class="posts-block col-lg-8 col-md-7 col-sm-6 col-xs-12">
					@yield('content')
				</div>
				<div class="sidebar col-lg-4 col-md-5 col-sm-6 col-xs-12">
					@include('blog.partials.blog_rightcol')
				</div>
			</div>
			@yield('second-row')
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

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="/js/jquery.pnotify.min.js"></script>
@yield('bottom-js')
@include('partials/messages')

</body>
</html>