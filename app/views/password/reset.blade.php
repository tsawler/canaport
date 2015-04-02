@extends('insidewide')

@section('browser-title')
Set your new password
@stop

@section('content')
    <h1>Set Your New Password</h1>

    {{ Form::open(array('class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
        <input type="hidden" name="token" value="{{ $token }}">
        
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
	    {{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'control-label')); }}
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
			    {{ Form::submit('Reset Password', array('class' => 'btn-normal btn-color submit'));}}
		    </div>
	    </div>
	    
    {{ Form::close() }}

    @if (Session::has('error'))
        <p style="color: red;">{{ Session::get('error') }}</p>
    @endif
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
