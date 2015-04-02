@extends('insidewide')

@section('content')

<div class="container">
{{ Form::open(array('url' => 'users/create', 'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
<h3 class="short_headline" style="text-transform: none;"><span>Create an Account</span></h3>

<div class="form-group">
{{ Form::label('first_name', 'First name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">A</span>
			{{ Form::text('first_name', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'First name',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>
		
<div class="form-group">
{{ Form::label('last_name', 'Last name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">A</span>
			{{ Form::text('last_name', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'Last name')); }}
		</div>
    </div>
</div>

<div class="form-group">
{{ Form::label('email', 'Email', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">@</span>
			{{ Form::email('email', null, array('class' => 'required email form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'you@example.com')); }}
		</div>
    </div>
</div>

<div class="form-group">
{{ Form::label('verify_email', 'Verify Email', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">@</span>
			{{ Form::email('verify_email', null, array('class' => 'required email form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'you@example.com')); }}
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
{{ Form::label('password_confirmation', 'Confirm password', array('class' => 'control-label')); }}
    <div class="controls">								
		<div class="input-group">
			<span class="input-group-addon"><i class="icon-lock"></i></span>
			{{ Form::password('password_confirmation', array('class' => 'form-control required',
												'placeholder' => 'Password again',
												'style' => 'max-width: 400px;')); }}
    	</div>
    </div>
</div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Create Account', array('class' => 'btn-normal btn-color submit'));}}
    </div>
</div>
<br><br>
{{ Form::close() }}

</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		rules: {
			password: {
				required: true,
				minlength: 6,
				maxlength: 32
			},
			password_confirmation: {
				required: true,
				equalTo: "#password"
			},
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
			}
		},
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