@extends('dashboard')

@section('browser-title')
Gallery Images
@stop

@section('content')

<h1>Gallery Images</h1>


<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allgalleryimages', 'class' => 'form-inline', 'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
			<div class="form-group">
				<label class="sr-only" for="label">Last name</label>
				{{  Form::text('label', $label, array('placeholder'=>'Image name', 
					'id' => 'label', 'autocomplete' => 'off','class' => 'form-control',));}}
			</div>
			<button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	</div>
	<div class="panel-body">		

@foreach ($images as $image)
	<div class="col-xs-6 col-md-3" style="border: 1px solid silver;">
		<a href="/admin/editimage/{{ $image->id }}" class="thumbnail">
			<img src="/img/gallery/{{ $image->img}}" alt="..."></a>
			<div class="caption">
			<p class='text-center'>{{ $image->label}} </p>
			</div>
	</div>
@endforeach
</div>
<div class="clearfix"></div>
</div>
{{ $images->links(); }}

@stop