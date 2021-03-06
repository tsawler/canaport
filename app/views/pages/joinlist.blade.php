@extends('inside')

@section('browser-title')
{{ $page_title }}: Canaport LNG | Clean. Safe. Energy.
@stop

@section('meta')
<meta name="description" content="{{ $meta }}" />
<meta name="tags" content="{{ $meta_tags }}" />
@stop

@section('content')
@if(Auth::check())
@if((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>

	{{ Form::open(array('url' => 'page/edit', 'id' => 'savetitledata', 'name' => 'savetitledata')) }}
	<h1>
	<article style='width: 100%'>
	@if ($active == 1)
	<span id="editablecontenttitle">{{ $page_title }}</span>
	@else
	<span id="editablecontenttitle">{{ $page_title }}</span> <small>[ Inactive ]</small>
	@endif
	</article>
	</h1>
	<input type="hidden" name="page_id" value="{{ $page_id }}">
	<input type="hidden" name="thetitledata" id="thetitledata">
	<article id="editablecontent" class='editablecontent' itemprop="description" style='width: 100%; line-height: 2em;'>
	{{ $page_content }}
	</article>
	<article class="admin-hidden">
		<a class="btn btn-primary" href="#!" onclick="saveEditedPage()">Save</a>
		<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
		&nbsp;&nbsp;&nbsp;
	</article>
	<input type="hidden" name="thedata" id="thedata">
	{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
	<h1>{{ $page_title}}</h1>
	<article style='width: 100%; line-height: 2em;'>{{ $page_content }}</article>
@endif
@endif

@if(!Auth::check())
	<h1>{{ $page_title }}</h1>
	<article style='width: 100%; line-height: 2em;'>{{ $page_content }}</article>
@endif

{{ Form::open(array('url' => '/Signup+For+Updates', 
					'class' => 'form', 
					'name' => 'bookform', 
					'id' => 'bookform',
					'method' => 'post')) }}
		
		
		
		<div class="form-group">
		{{ Form::label('email', 'Email Address', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-group">
		<span class="input-group-addon"><i class='icon-envelope'></i></span>
		{{ Form::email('email', null, array('class' => 'form-control required email',
	    											'style' => 'max-width: 400px;',
	    											'placeholder' => 'you@example.com')); }}
		</div>
		</div>
		</div>
		
		
		
		<div class="blog-divider"></div>
	
	    <div class="form-group">
		    <div class="controls">
			    {{ Form::submit('Send Form', array('class' => 'btn-normal btn-color submit')) }}
		    </div>
		</div>
	
{{ Form::close() }}
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		errorClass:'has-error',
		validClass:'has-success',
    	errorElement:'span',
    	highlight: function (element, errorClass, validClass) { 
        $(element).parents("div[class='form-group']").addClass(errorClass).removeClass(validClass); 
	    }, 
	    unhighlight: function (element, errorClass, validClass) { 
	        $(element).parents(".has-error").removeClass(errorClass).addClass(validClass); 
	    }
	});
});
</script>
@stop