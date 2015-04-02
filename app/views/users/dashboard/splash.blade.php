@extends('dashboard')

@section('browser-title')
Splash Image/Text
@stop

@section('content')

<h1>Splash Image/Text</h1>
			
			


{{ Form::model($splash, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/splash', $splash->id ),
							'enctype' => 'multipart/form-data',
							'method' => 'post'
							) 
			   )
}}




 <div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img src="{{ $splash->image}}" alt="...">
    </a>
  </div>
</div>
  
<div class="form-group">
	{{ Form::label('label', 'Caption', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">T</span>
			{{ Form::text('text', null, array('class' => 'required form-control',
    											
    											'autocomplete' => 'off',
    											'placeholder' => 'Caption',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>

<div class="form-group">
	{{ Form::label('img', 'Image file', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">

			{{ Form::file('img',array('class' => 'btn btn-info','title' => 'Browse for new image')) }}
		</div>
    </div>
</div>


<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Save Changes', array('class' => 'btn-normal btn-color submit'));}}
    </div>
</div>
<input type="hidden" name="active">
{{ Form::close() }}

@stop

@section('bottom-js')
<script src="/js/bootstrap.file-input.js"></script>
<script>
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this image?", function(result) {
		if (result==true)
		{
			window.location.href = '/admin/deletegalleryimage/'+x;
		}
	});
}
$(document).ready(function () {
	$('input[type=file]').bootstrapFileInput();
});
</script>
@stop