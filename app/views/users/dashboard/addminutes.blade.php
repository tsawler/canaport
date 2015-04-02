@extends('dashboard')

@section('browser-title')
Add CCELC Minutes
@stop

@section('content')

<h1>Add CCELC Minutes</h1>

{{ Form::open(array('role' => 'form', 
					'name' => 'bookform', 'id' => 'bookform',
					'url' => 'admin/addminutes',
					'enctype' => 'multipart/form-data',
					'method' => 'post'
					) 
	)
}}



<div class="form-group">
	{{ Form::label('title', 'Title', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">T</span>
			{{ Form::text('title', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'autocomplete' => 'off',
    											'placeholder' => 'Title',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>


<div class="form-group">
{{ Form::label('post_date', 'Date', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon"><i class="icon-calendar"></i></span>
			{{ Form::text('post_date', null, array('class' => 'required dateISO form-control',
    											'style' => 'max-width: 400px;')); }}
		</div>
    </div>
</div>


<div class="form-group">
	{{ Form::label('pdf', 'PDF file', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<input type="file" name="pdf" title="Browse for PDF" class="btn btn-info required">
		</div>
    </div>
</div>

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Upload', array('class' => 'btn-normal btn-color submit'));}}
    </div>
</div>
<input type="hidden" name="active">

<div>
<?php for($i=1; $i<=10; $i++){
	echo "<br>";
}
?>
</div>
{{ Form::close() }}

@stop

@section('bottom-js')
<script src="/js/bootstrap.file-input.js"></script>
<script>
$(document).ready(function () {
	$("#post_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
	
	$('input[type=file]').bootstrapFileInput();
	
	$("#bookform").validate({
		rules: {
			category: {
				required: true
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