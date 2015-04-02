@extends('insidewide')

@section('browser-title')
Log in to your account
@stop

@section('meta')
<meta name="description" content="Login to your account" />
@stop


@section('content')

	<div class="container">
		<h1><span>Login</span></h1>


	{{ Form::open(array('role' => 'form', 'url' => 'users/signin', 'name' => 'bookform', 'id' => 'bookform')) }}

		<div class="form-group">
		{{ Form::label('username', 'E-Mail Address', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">@</span>
					{{ Form::email('username', null, array('class' => 'required email form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'you@example.com',
														'autofocus'=>'autofocus')); }}
				</div>
		    </div>
		</div>
			    
	    <div class="form-group">
	    {{ Form::label('password', 'Password', array('class' => 'control-label')); }}
		    <div class="controls">								
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-lock"></i></span>
					{{ Form::password('password', array('class' => 'form-control required',
														'placeholder' => 'Password',
														'style' => 'max-width: 400px;')); }}
		    	</div>
		    </div>
	    </div>

	    <div class="form-group">
		    <div class="controls">
			    {{ Form::submit('Login', array('class' => 'btn-normal btn-color submit'));}}
		    </div>
	    </div>
	    
	    
	    <a href="/password/remind">Forgot password?</a>
	    <br><br>
	    
		<input type="hidden" name="targetUrl" value="{{ Session::get('targetUrl') }}">


	{{ Form::close() }}

	</div>
	
	
	

<!-- end row-fluid-->
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