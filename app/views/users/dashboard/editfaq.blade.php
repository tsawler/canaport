@extends('dashboard')

@section('browser-title')
Edit FAQ
@stop

@section('content')	

<div class="container">

	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
	
	<h1>Create New FAQ</h1>
	
	@if(count($errors) > 0)
	<div class="alert-danger alert" style='max-width: 400px;'>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	
	{{ Form::model($faq, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/editfaq', $faq->id )
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
		{{ Form::label('active', 'FAQ active?', array('class' => 'control-label')); }}
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
		{{ Form::label('question', 'Question', array('class' => 'control-label')); }}
		<div class="controls" style='max-width: 650px;'>
	    {{ Form::textarea('question', null, array('style' => 'max-width: 400px;') ); }}
	    </div>
	    </div>
	    
	    <div class="form-group">
		{{ Form::label('answer', 'Answer', array('class' => 'control-label')); }}
		<div class="controls" style='max-width: 650px;'>
	    {{ Form::textarea('answer', null, array('style' => 'max-width: 400px;') ); }}
	    </div>
	    </div>
	    
	    
		<div class="blog-divider"></div>
		
	    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit')) }}
		    <a class="btn-normal btn-danger" href="#!" onclick='confirmDelete({{$faq->id}})'>Delete this FAQ</a>
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
	bootbox.confirm("Are you sure you want to delete this FAQ?", function(result) {
		if (result==true)
		{
			window.location.href = '/admin/deletefaq/'+x;
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
	
	CKEDITOR.replace( 'question',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
	
	CKEDITOR.replace( 'answer',
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
