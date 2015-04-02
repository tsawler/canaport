@extends('dashboard')

@section('browser-title')
News Items
@stop

@section('content')

<h1>All News Items</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allnews', 'class' => 'form-inline', 
						'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		  <div class="form-group">
		    <label class="sr-only" for="page_name">Title</label>
		    {{  Form::text('title', $title, array('placeholder'=>'News title', 
							'id' => 'title', 'autocomplete' => 'off','class' => 'form-control',));}}
		  </div>
	
		  <button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	
	</div>	
	<table class="responsive table table-striped table-bordered">
			<thead>
				<tr>
					<th> News Item </th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($newsitems as $news)
			<?php
			$string = (strlen($news->title) > 68) ? substr($news->title,0,65).'...' : $news->title;
			?>
				<tr>
					<td><a href="/admin/editnews/{{$news->id }}">{{ $string }}</a></td>
					@if($news->status == 'APPROVED')
					<td><span style="color: green;">Active</span></td>
					@else
					<td><span style="color: red;">Inactive</span></td>
					@endif
					<td>{{ date("Y-m-d", strtotime($news->published_date)) }}</td>
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $newsitems->links() }}

@stop