@extends('dashboard')

@section('browser-title')
Edit Community Involvement Item
@stop

@section('content')	

<div class="container">

	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
	
	<h1>Edit Community Involvement</h1>
	
	@if(count($errors) > 0)
	<div class="alert-danger alert" style='max-width: 400px;'>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	
	{{ Form::model($cis, array(
							'role' => 'form', 
							'enctype' => 'multipart/form-data',
							'name' => 'bookform',
							'method' => 'post',
							'url' => array('admin/editinvolvement', $cis->id )
							) 
			   )
	}}
		<div class="form-group">
			{{ Form::label('label', 'Label', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">A</span>
					{{ Form::text('label', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'Label',
														'autofocus'=>'autofocus')); }}
				</div>
		    </div>
		</div>
		
		<div class="form-group">
		{{ Form::label('date_posted', 'Date', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-calendar"></i></span>
					{{ Form::text('date_posted', null, array('class' => 'required dateISO form-control',
		    											'style' => 'max-width: 400px;')); }}
				</div>
		    </div>
		</div>
		
		<div class="row">
		  <div class="col-xs-6 col-md-4">
		    <a href="#" class="thumbnail">
		      <img src="/img/ci/{{ $cis->pic}}" alt="...">
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
			{{ Form::label('active', 'Item active?', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">?</span>
					{{ Form::select('active', array(
							'1' => 'Yes',
							'0' => 'No'),
							1,
							array('class' => 'form-control',
								'style' => 'max-width: 400px;')) }}
				</div>
		    </div>
		</div>
	    
	    <div class="form-group">
		{{ Form::label('question', 'Content', array('class' => 'control-label')); }}
		<div class="controls" style='max-width: 650px;'>
	    {{ Form::textarea('content', null, array('style' => 'max-width: 400px;') ); }}
	    </div>
	    </div>
	    
	    
		<div class="blog-divider"></div>
		
	    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit')) }}
		    <a class="btn-normal btn-danger" href="#!" onclick='confirmDelete({{$cis->id}})'>Delete this Item</a>
	    </div>
</div>
<div>&nbsp;</div>

	{{ Form::close() }}
	</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
@stop

@section('bottom-js')
<script src="/js/bootstrap.file-input.js"></script>
<script>
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this item?", function(result) {
		if (result==true)
		{
			window.location.href = '/admin/deleteinvolvement/'+x;
		}
	});
}
$(document).ready(function () {	
	$('input[type=file]').bootstrapFileInput();
	$("#date_posted").datepicker({format: 'yyyy-mm-dd', autoclose: true});
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
	
	CKEDITOR.replace( 'content',
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
