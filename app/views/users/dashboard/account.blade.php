@extends('dashboard')

@section('browser-title')
Dashboard: Account Details
@stop

@section('content')

<h1><span>Account Details</h1>

<p>Please note that if you <strong>change your email</strong>, you will have to
<strong>use the new email to log in</strong> to the site.</p>

{{ Form::model($user, array(
					'role' => 'form', 
					'name' => 'bookform', 'id' => 'bookform',
					'url' => array('users/account', $user->id )
					) 
	   )
}}

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>


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

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Update Account', array('class' => 'btn-normal btn-color submit'));}}
    </div>
</div>

{{ Form::close() }}

@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		rules: {
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