@extends('dashboard')

@section('browser-title')
Calendar Events
@stop

@section('content')

			<h1>Calendar Events</h1>

			<div class="panel panel-default">
			<div class="panel-heading text-center">
			{{ Form::open(array('url' => 'calendar/allevents', 'class' => 'form-inline', 
							'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
			  <div class="form-group">
			    <label class="sr-only" for="last_name">Event name</label>
			    {{  Form::text('title', $title, array('placeholder'=>'Event name', 
								'id' => 'title', 'autocomplete' => 'off','class' => 'form-control',));}}
			  </div>

			  <button type="submit" class="btn-color btn-small">Search</button>
			{{ Form::close() }}

			</div>
			
			<table class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Event name </th>
							<th> Date </th>
						</tr>
					</thead>
					
					<tbody>
					@foreach ($events as $event)
						<tr>
							<td><a href="/calendar/editevent/{{$event->id }}">{{ $event->title }}</a></td>
							<td>{{ date('Y-m-d', strtotime($event->post_date)) }}</td>
						</tr>
					@endforeach
					</tbody>
			</table>
			</div>
			{{ $events->links() }}

@stop