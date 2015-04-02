@extends('layout')

@section('browser-title')
Log in to your account
@stop

@section('meta')
<meta name="description" content="" />
@stop


@section('content')

	<div class="container">
		<h3 class="short_headline" style="text-transform: none;"><span>Validation Code</span></h3>

	{{ Form::open(array('url' => 'users/checktfa', 'role' => 'forml', 'name' => 'bookform', 'id' => 'bookform')) }}

		<div class="form-group">
			{{ Form::label('tfa', 'Enter your validation code', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">@</span>
					{{ Form::text('tfa', null, array('style' => 'max-width: 400px;','class' => 'required digits form-control', 'autofocus'=>'autofocus')); }}
				</div>
		    </div>
	    </div>
	    

	    
	    <div class="form-group">
			<div class="controls">
				<label class="checkbox">
					Remember this computer for 30 days
					<input type="checkbox" name="remember" id="remember" value="1">
				</label>
			</div>
		</div>
	    
	    <div class="control-group">
	    <div class="controls">
	    {{ Form::submit('Submit', array('class' => 'btn btn-primary'));}}
	    </div>
	    </div>

	{{ Form::close() }}

	</div>

<!-- end row-fluid-->
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@stop