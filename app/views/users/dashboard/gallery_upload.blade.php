@extends('dashboard')

@section('browser-title')
Upload Gallery Image
@stop

@section('content')

<h1>Gallery Image</h1>

{{ Form::open(array('role' => 'form', 
					'name' => 'bookform', 'id' => 'bookform',
					'url' => 'admin/galleryupload',
					'enctype' => 'multipart/form-data',
					'method' => 'post'
					) 
	)
}}



<div class="form-group">
	{{ Form::label('label', 'Image Name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">T</span>
			{{ Form::text('label', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'autocomplete' => 'off',
    											'placeholder' => 'A name for your image',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>

<div class="form-group">
	{{ Form::label('img', 'Image file', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<input type="file" name="img" title="Browse for Image" class="btn btn-info required">
		</div>
    </div>
</div>

<div class="form-group">
	<div class="controls">
		<div class="input-group">
			<label class="radio">
				<input type='radio' name='category' value="gallery_1">Category 1
			</label>
			<label class="radio">
				<input type='radio' name="category" value="gallery_2">Category 2
			</label>
			<label class="radio">
				<input type='radio' name='category' value="gallery_3">Category 3
			</label>
			<label class="radio">
				<input type='radio' name="category" value="gallery_4">Category 4
			</label>
		</div>
    </div>
</div>

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Upload Image', array('class' => 'btn-normal btn-color submit'));}}
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