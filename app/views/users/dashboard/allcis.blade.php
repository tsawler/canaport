@extends('dashboard')

@section('browser-title')
CIs
@stop

@section('content')

<h1>All Community Involvement Items</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allinvolvement', 'class' => 'form-inline', 
						'role' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		  <div class="form-group">
		    <label class="sr-only" for="page_name">Label</label>
		    {{  Form::text('label', $label, array('placeholder'=>'Label', 
							'id' => 'label', 'autocomplete' => 'off','class' => 'form-control',));}}
		  </div>
	
		  <button type="submit" class="btn-color btn-small">Search</button>
		{{ Form::close() }}
	
	</div>	
	<table class="responsive table table-striped table-bordered">
			<thead>
				<tr>
					<th> ITEM </th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($cis as $ci)
				<tr>
					<td><a href="/admin/editinvolvement/{{$ci->id }}">{{ $ci->label }}</a></td>
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $cis->links() }}

@stop