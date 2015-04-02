@extends('dashboard')

@section('browser-title')
Pages
@stop

@section('content')

<h1>All Pages</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allpages', 'class' => 'form-inline', 
						'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		  <div class="form-group">
		    <label class="sr-only" for="page_name">Page name</label>
		    {{  Form::text('page_name', $page_name, array('placeholder'=>'Page name', 
							'id' => 'last_name', 'autocomplete' => 'off','class' => 'form-control',));}}
		  </div>
	
		  <button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	
	</div>	
	<table class="responsive table table-striped table-bordered">
			<thead>
				<tr>
					<th> Page name </th>
					<th> Status </th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($allpages as $page)
				<tr>
					<td><a href="/admin/editpage/{{$page->id }}">{{ $page->page_name }}</a></td>
					@if($page->active == 1)
					<td><span style="color: green;">Active</span></td>
					@else
					<td><span style="color: red;">Inactive</span></td>
					@endif
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $allpages->links() }}

@stop