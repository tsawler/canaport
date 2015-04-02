@extends('insidewide')

@section('browser-title')
Canaport LNG: Reset Your Password
@stop

@section('content')
    <h1>Need to reset your password?</h1>

    {{ Form::open(array('role' => 'forml', 'name' => 'bookform', 'id' => 'bookform')) }}
        <div class="form-group">
		{{ Form::label('username', 'E-Mail Address', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">@</span>
					{{ Form::email('email', null, array('class' => 'required email form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'you@example.com',
														'autofocus'=>'autofocus')); }}
				</div>
		    </div>
		</div>
	    
	    <div class="form-group">
		    <div class="controls">
			    {{ Form::submit('Send Reminder', array('class' => 'btn-normal btn-color submit'));}}
		    </div>
	    </div>
    {{ Form::close() }}

    @if (Session::has('error'))
        <div class="alert alert-error">{{ Session::get('error') }}</div>
    @elseif (Session::has('status'))
        <div class="alert alert-error">{{ Session::get('status') }}</div>
    @endif
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

