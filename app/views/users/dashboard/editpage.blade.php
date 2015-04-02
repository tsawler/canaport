@extends('dashboard')

@section('content')	

<div class="container">

	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
	
	<h1>Edit Page</h1>
	
	@if(count($errors) > 0)
	<div class="alert alert-error">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	
	{{ Form::model($page, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/editpage', $page->id )
							) 
			   )
	}}
		
		<div class="form-group">
		{{ Form::label('page_name', 'Page title', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">A</span>
					{{ Form::text('page_name', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'Page title',
														'autofocus'=>'autofocus')); }}
				</div>
		    </div>
		</div>
		
		<div class="form-group">
		{{ Form::label('active', 'Page active?', array('class' => 'control-label')); }}
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
		{{ Form::label('page_content', 'Page Content', array('class' => 'control-label')); }}
		<div class="controls" style='max-width: 650px;'>
	    {{ Form::textarea('page_content', null, array('style' => 'max-width: 400px;') ); }}
	    </div>
	    </div>
	    
	    <div class="form-group">
		{{ Form::label('meta_tags', 'Meta Keywords', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-code"></i></span>
					{{ Form::text('meta_tags', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'keyword, keyword')); }}
				</div>
		    </div>
		</div>
		
	    <div class="form-group">
		{{ Form::label('meta', 'Meta Description', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-code"></i></span>
					{{ Form::text('meta', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'Description')); }}
				</div>
		    </div>
		</div>
		<hr>
	    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit')) }}
		    <a class="btn-normal btn-danger" href="#!" onclick='confirmDelete({{$page->id}})'>Delete this page</a>
	    </div>
</div>
<div>&nbsp;</div>

	{{ Form::close() }}
	</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
@stop

@section('bottom-js')
<script>
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this page?", function(result) {
		if (result==true)
		{
			window.location.href = '/admin/deletepage/'+x;
		}
	});
}
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
	
	CKEDITOR.replace( 'page_content',
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
