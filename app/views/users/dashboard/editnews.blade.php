@extends('dashboard')

@section('browser-title')
Add News Item
@stop

@section('content')	



	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
	
	<h1>Edit News Item</h1>
	
	@if(count($errors) > 0)
	<div class="alert-danger alert" style='max-width: 400px;'>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	
	{{ Form::model($news, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/editnews', $news->id )
							) 
			   )
	}}
	
		
		<div id="editmsg" class='alert alert-success hidden'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span id="theeditmsg">&nbsp;</span>
		</div>
		
		<div class="form-group">
		{{ Form::label('title', 'Title', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">A</span>
					{{ Form::text('title', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
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
					{{ Form::text('post_date', date('Y-m-d',strtotime($news->published_date)), array('class' => 'required dateISO form-control',
		    											'style' => 'max-width: 400px;')); }}
				</div>
		    </div>
		</div>
		
		<div class="form-group">
		{{ Form::label('status', 'Status', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon">?</span>
					{{ Form::select('status', array(
							'DRAFT' => 'Draft',
							'APPROVED' => 'Approved'),
							null,
							array('class' => 'form-control',
								'style' => 'max-width: 400px;')) }}
				</div>
		    </div>
		</div>
		

		
		<div class="form-group">
		{{ Form::label('summary', 'Post Summary', array('class' => 'control-label')); }}
		<div class="controls">
	    {{ Form::textarea('summary', null ); }}
	    </div>
	    </div>
	    
	    <div class="form-group">
		{{ Form::label('content', 'Full Post', array('class' => 'control-label')); }}
		<div class="controls">
	    {{ Form::textarea('content', null ); }}
	    </div>
	    </div>
	    
	    <div class="form-group">
		{{ Form::label('meta_keywords', 'Meta Keywords', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-code"></i></span>
					{{ Form::text('meta_keywords', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'keyword, keyword')); }}
				</div>
		    </div>
		</div>
		
	    <div class="form-group">
		{{ Form::label('meta_description', 'Meta Description', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-group">
					<span class="input-group-addon"><i class="icon-code"></i></span>
					{{ Form::text('meta_description', null, array('class' => 'required form-control',
		    											'style' => 'max-width: 400px;',
		    											'placeholder' => 'Description')); }}
				</div>
		    </div>
		</div>
	    
		<div class="blog-divider"></div>
	    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit'))
		    }}

			@if (($news->id != null) && ($news->id > 0))
                <a href="#!" class="btn-normal btn-danger" onclick="confirmDelete({{ $news->id }})">Delete</a>
            @endif
	    </div>
	</div>
	
	{{ Form::close() }}

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
	
	
	$("#post_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
	
	CKEDITOR.replace( 'content',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
	CKEDITOR.replace( 'summary',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
});

function saveDate(){
    var options = { target: '#theeditmsg', success: showResponse };
    $("#dateform").unbind('submit').ajaxSubmit(options);
    return false;
}

function confirmDelete(x){
    bootbox.confirm("Are you sure you want to delete this item?", function(result) {
        if (result==true)
        {
            window.location.href = '/admin/deletenewsitem?id=' + x;
        }
    });
}
</script>
@stop
