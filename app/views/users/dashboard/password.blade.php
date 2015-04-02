@extends('dashboard')

@section('browser-title')
Password Change
@stop

@section('content')

<h1>Update Password</h1>

{{ Form::open(array('role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
			    
<div class="form-group">
{{ Form::label('password', 'Old Password', array('class' => 'control-label')); }}
    <div class="controls">								
		<div class="input-group">
			<span class="input-group-addon"><i class="icon-lock"></i></span>
			{{ Form::password('password', array('class' => 'form-control required',
												'placeholder' => 'Old password',
												'style' => 'max-width: 400px;')); }}
    	</div>
    </div>
</div>
			    
<div class="form-group">
{{ Form::label('new_password', 'New Password', array('class' => 'control-label')); }}
    <div class="controls">								
		<div class="input-group">
			<span class="input-group-addon"><i class="icon-lock"></i></span>
			{{ Form::password('new_password', array('class' => 'form-control required',
												'placeholder' => 'New password',
												'style' => 'max-width: 400px;')); }}
    	</div>
    </div>
</div>

<div class="form-group">
{{ Form::label('new_password_confirmation', 'Confirm new password', array('class' => 'control-label')); }}
    <div class="controls">								
		<div class="input-group">
			<span class="input-group-addon"><i class="icon-lock"></i></span>
			{{ Form::password('new_password_confirmation', array('class' => 'form-control required',
												'placeholder' => 'New password again',
												'style' => 'max-width: 400px;')); }}
    	</div>
    </div>
</div>

<div class="blog-divider"></div>

<div class="form-group">
<div class="controls">
<div class="input-group">
<button class="btn-normal btn-color submit">Change Password</button>
</div>
</div>
</div>

<div>
<?php for($i=1; $i<=10; $i++){
	echo "<br>";
}
?>
</div>		    
{{ Form::close() }}

@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		rules: {
			new_password: {
				required: true,
				minlength: 6,
				maxlength: 32
			},
			new_password_confirmation: {
				required: true,
				equalTo: "#new_password"
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