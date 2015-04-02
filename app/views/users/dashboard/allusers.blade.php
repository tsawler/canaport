@extends('dashboard')

@section('browser-title')
Users
@stop

@section('content')

<h1>All Users</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allusers', 'class' => 'form-inline', 
						'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		  <div class="form-group">
		    <label class="sr-only" for="last_name">Last name</label>
		    {{  Form::text('last_name', $last_name, array('placeholder'=>'Last name', 
							'id' => 'last_name', 'autocomplete' => 'off','class' => 'form-control',));}}
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="email">Password</label>
		    {{ Form::email('email', $email, array('class' => 'form-control','placeholder'=>'Email')); }}
		  </div>
	
		  <button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	
	</div>	
	<table class="responsive table table-striped table-bordered">
			<thead>
				<tr>
					<th> Last name </th>
					<th> First Name </th>
					<th> Email </th>
					<th> Status </th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($allusers as $user)
				<tr>
					<td><a href="/admin/edituser/{{$user->id }}">{{ $user->last_name }}</a></td>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->email }}</td>
					@if($user->user_active == 1)
					<td><span style="color: green;">Active</span></td>
					@else
					<td><span style="color: red;">Inactive</span></td>
					@endif
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $allusers->links() }}

@stop