@extends('dashboard')

@section('browser-title')
Admin Users
@stop

@section('content')

			<h1><span>Admin Users</h1>
			
			<div class="panel panel-default">
				<div class="panel-heading text-center">
				Admin Users
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
						@foreach ($adminusers as $user)
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
			
			<div class="pagination">
			{{ $adminusers->links(); }}
			</div>
		    

@stop