@extends('dashboard')

@section('browser-title')
Gallery Image
@stop

@section('content')

<h1>Gallery Image</h1>
			
			


{{ Form::model($image, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/editimage', $image->id ),
							'enctype' => 'multipart/form-data',
							'method' => 'post'
							) 
			   )
}}




 <div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img src="/img/gallery/{{ $image->img}}" alt="...">
    </a>
  </div>
</div>
  
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

			{{ Form::file('img',array('class' => 'btn btn-info','title' => 'Browse for new image')) }}
		</div>
    </div>
</div>

<div class="form-group">
	<div class="controls">
		<div class="input-group">
			<label class="radio">
				{{ Form::radio('category', 'gallery_1') }} Category 1
			</label>
			<label class="radio">
				{{ Form::radio('category', 'gallery_2') }} Category 2
			</label>
			<label class="radio">
				{{ Form::radio('category', 'gallery_3') }} Category 3
			</label>
			<label class="radio">
				{{ Form::radio('category', 'gallery_4') }} Category 4
			</label>
		</div>
    </div>
</div>

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Save Changes', array('class' => 'btn-normal btn-color submit'));}}
	   <a class="btn-normal btn-danger" href="#!" onclick='confirmDelete({{$image->id}})'>Delete this image</a>
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