@extends('dashboard')

@section('browser-title')
User
@stop

@section('content')

		
<h1>User: {{ $user->first_name }} {{ $user->last_name }}</h1>


{{ Form::model($user, array(
							'role' => 'form', 
							'name' => 'bookform', 'id' => 'bookform',
							'url' => array('admin/edituser', $user->id )
							) 
			   )
}}
			
			
<div class="form-group">
{{ Form::label('first_name', 'First name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">A</span>
			{{ Form::text('first_name', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'First name',
												'autofocus'=>'autofocus')); }}
		</div>
    </div>
</div>
			
<div class="form-group">
{{ Form::label('last_name', 'Last name', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">A</span>
			{{ Form::text('last_name', null, array('class' => 'required form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'Last name')); }}
		</div>
    </div>
</div>

<div class="form-group">
{{ Form::label('email', 'Email', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">@</span>
			{{ Form::email('email', null, array('class' => 'required email form-control',
    											'style' => 'max-width: 400px;',
    											'placeholder' => 'you@example.com')); }}
		</div>
    </div>
</div>
			

<div class="form-group">
{{ Form::label('access_level', 'Admin user', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">?</span>
			{{ Form::select('access_level', array(
					'3' => 'Yes',
					'1' => 'No'),
					null,
					array('class' => 'form-control',
						'style' => 'max-width: 400px;')) }}
		</div>
    </div>
</div>	

<div class="form-group">
{{ Form::label('user_active', 'Active?', array('class' => 'control-label')); }}
	<div class="controls">
		<div class="input-group">
			<span class="input-group-addon">?</span>
			{{ Form::select('user_active', array(
					'1' => 'Yes',
					'0' => 'No'),
					null,
					array('class' => 'form-control',
						'style' => 'max-width: 400px;')) }}
		</div>
    </div>
</div>			    

<div class="blog-divider"></div>

<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Update', array('class' => 'btn-normal btn-color submit'));}}
    </div>
</div>
			
{{ Form::close() }}
			
			
			
@if ($user->access_level == 3)
	<hr>
	<p>&nbsp;</p>
	<h3 class="short_headline"><span>Roles</span></h3>
	
	{{ Form::model($user->roles, array(
								'role' => 'form', 
								'name' => 'roleform', 'id' => 'roleform',
								'url' => array('/admin/edituserroles', $user->id )
								) 
				   )
	}}


	<div class="form-group">
			<div class="controls">
				<div class="input-group">
					
					
	@foreach (Role::all() as $role)			
		<?php
		$hasRole = false;
		if ($user->roles->contains($role->id))
			$hasRole = true;?>
					<label class="checkbox">
						{{ Form::checkbox('r_'.$role->id, $role->id, $hasRole); }} {{ $role->role_name }}
					</label>
	@endforeach
	
						
				</div>
		    </div>
		</div>

<div class="blog-divider"></div>

	<div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit'));}}
	    </div>
	</div>
				
	{{ Form::close() }}
@endif
			


@stop