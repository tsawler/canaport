<article class="entry-post">    
	<h1>Add News Item</h1>
	{{ Form::open(array('url' => '/post/save',  'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
	<header class="entry-header">
		
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
					{{ Form::text('post_date', null, array('class' => 'required dateISO form-control',
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
							'DRAFT',
							array('class' => 'form-control',
								'style' => 'max-width: 400px;')) }}
				</div>
		    </div>
		</div>
		
	</header>

	<div class="entry-content">
		
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
	    
	    <hr>
	    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit'))
		    }}
	    </div>
	</div>
	
	{{ Form::close() }}
	
</article>

<div>&nbsp;</div>
<div>&nbsp;</div>

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
</script>
@stop
