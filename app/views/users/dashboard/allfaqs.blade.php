@extends('dashboard')

@section('browser-title')
FAQs
@stop

@section('content')

<h1>All FAQs</h1>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		{{ Form::open(array('url' => 'admin/allfaqs', 'class' => 'form-inline', 
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
					<th> FAQ </th>
				</tr>
			</thead>
			
			<tbody>
			@foreach ($faqs as $faq)
				<tr>
					<td><a href="/admin/editfaq/{{$faq->id }}">{{ $faq->label }}</a></td>
				</tr>
			@endforeach
			</tbody>
	</table>
</div>
			
{{ $faqs->links() }}

@stop