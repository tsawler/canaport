@extends('insidewide')

@section('browser-title')
	Canaport LNG | Clean. Safe. Energy.
@stop

@section('meta')
<meta name="description" content="" />
<meta name="tags" content="" />
@stop

@section('content')

{{ Form::open(array('url' => '/emailconsent', 
					'class' => 'form', 
					'name' => 'bookform', 
					'id' => 'bookform',
					'method' => 'post')) }}
					
	<p>In order to comply with Canadian Anti-Spam Legislation (CASL), Canaport LNG needs your consent to continue to send you important information.</p>
	
	<fieldset>
		
		<div class="form-group">
		{{ Form::label('name', 'Your first name', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-group">
		<span class="input-group-addon"><i class='icon-font'></i></span>
		{{ Form::text('first-name', null, array('class' => 'required form-control',
	    											'style' => 'max-width: 400px;',
	    											'placeholder' => 'Your first name')); }}
		</div>
		</div>
		</div>
		
		<div class="form-group">
		{{ Form::label('name', 'Your last name', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-group">
		<span class="input-group-addon"><i class='icon-font'></i></span>
		{{ Form::text('last-name', null, array('class' => 'required form-control',
	    											'style' => 'max-width: 400px;',
	    											'placeholder' => 'Your first name')); }}
		</div>
		</div>
		</div>
		
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
			    {{ Form::submit('Submit', array('class' => 'btn-normal btn-color submit')) }}
		    </div>
		</div>
	
	</fieldset>
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