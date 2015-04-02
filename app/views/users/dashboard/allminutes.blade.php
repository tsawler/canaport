@extends('dashboard')

@section('browser-title')
Minutes
@stop

@section('content')

<h1>All CCELC Minutes</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allminutes', 'class' => 'form-inline', 
						'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		  <div class="form-group">
		    <label class="sr-only" for="title">Title</label>
		    {{  Form::text('title', $title, array('placeholder'=>'Title', 
							'id' => 'title', 'autocomplete' => 'off','class' => 'form-control',));}}
		  </div>
	
		  <button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	
	</div>	
	<table class="responsive table table-striped table-bordered">
			<thead>
				<tr>
					<th> Title </th>
					<th> Post Date </th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($minutes as $minute)
				<tr>
					<td><a href="/admin/editminute/{{$minute->id }}">{{ $minute->title }}</a></td>
					<td>{{ $minute->post_date }}</td>
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $minutes->links() }}

@stop