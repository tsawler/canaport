@extends('dashboard')

@section('browser-title')
Upload Gallery Image
@stop

@section('content')

<h1>Edit Calendar Event</h1>

{{ Form::model($event, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('calendar/editevent', $event->id ),
							'enctype' => 'multipart/form-data',
							'method' => 'post'
							) 
			   )
}}



<div class="form-group">
	{{ Form::label('title', 'Event Name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">T</span>
			{{ Form::text('title', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'autocomplete' => 'off',
    											'placeholder' => 'A name for the event',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="/img/events/{{ $event->pic}}" alt="...">
    </a>
  </div>
</div>

<div class="form-group">
	{{ Form::label('pic', 'Image file', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<input type="file" name="pic" title="Browse for new Image" class="btn btn-info">
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
	{{ Form::label('description', 'Description', array('class' => 'control-label')); }}
	<div class="controls">
	    {{ Form::textarea('description', null ); }}
	</div>
</div>

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit'));}}
	    <a class="btn-normal btn-danger" href="#!" onclick='confirmDelete({{$event->id}})'>Delete this event</a>
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
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this event?", function(result) {
		if (result==true)
		{
			window.location.href = '/calendar/delete/'+x;
		}
	});
}

$(document).ready(function () {
	$('input[type=file]').bootstrapFileInput();
	$("#post_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
	
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
	
	CKEDITOR.replace( 'description',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
});
</script>
@stop