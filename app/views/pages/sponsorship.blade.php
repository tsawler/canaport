@extends('inside')

@section('browser-title')
{{ $page_title }}: Canaport LNG | Clean. Safe. Energy.
@stop

@section('meta')
<meta name="description" content="{{ $meta }}" />
<meta name="tags" content="{{ $meta_tags }}" />
@stop

@section('content')
@if(Auth::check())
@if((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>

	{{ Form::open(array('url' => 'page/edit', 'id' => 'savetitledata', 'name' => 'savetitledata')) }}
	<h1>
	<article style='width: 100%'>
	@if ($active == 1)
	<span id="editablecontenttitle">{{ $page_title }}</span>
	@else
	<span id="editablecontenttitle">{{ $page_title }}</span> <small>[ Inactive ]</small>
	@endif
	</article>
	</h1>
	<input type="hidden" name="page_id" value="{{ $page_id }}">
	<input type="hidden" name="thetitledata" id="thetitledata">
	<article id="editablecontent" class='editablecontent' itemprop="description" style='width: 100%; line-height: 2em;'>
	{{ $page_content }}
	</article>
	<article class="admin-hidden">
		<a class="btn btn-primary" href="#!" onclick="saveEditedPage()">Save</a>
		<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
		&nbsp;&nbsp;&nbsp;
	</article>
	<input type="hidden" name="thedata" id="thedata">
	{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
	<h1>{{ $page_title}}</h1>
	<article style='width: 100%; line-height: 2em;'>{{ $page_content }}</article>
@endif
@endif

@if(!Auth::check())
	<h1>{{ $page_title }}</h1>
	<article style='width: 100%; line-height: 2em;'>{{ $page_content }}</article>
@endif

<p>&nbsp;</p>

{{ Form::open(array('role' => 'form', 'url' => '/Apply+For+Sponsorship', 'name' => 'bookform', 'id' => 'bookform')) }}

	<div class="form-group">
	{{ Form::label('organization', 'Name of Organization or Group conducting the project', array('class' => 'control-label')); }}
		<div class="controls">
			<div class="input-group">
				<span class="input-group-addon"><i class='icon-font'></i></span>
				{{ Form::text('organization', null, array('class' => 'required form-control',
	    											'style' => 'max-width: 400px;',
													'autofocus'=>'autofocus')); }}
			</div>
	    </div>
	</div>
	
	
	<div class="form-group">
	{{ Form::label('proposed_work', 'Describe the proposed work and how it will be conducted:', array('class' => 'control-label')); }}
	<div class="controls" style='max-width: 800px;'>
    {{ Form::textarea('content', null, array('class' => 'required', 'style' => 'max-width: 800px;','cols' => '80') ); }}
    </div>
    </div>
    
    <div class="form-group">
	{{ Form::label('how_benefit', 'How will this project benefit the Saint John community?', array('class' => 'control-label')); }}
	<div class="controls" style='max-width: 800px;'>
    {{ Form::textarea('how_benefit', null, array('class' => 'required', 'style' => 'max-width: 800px;','cols' => '80') ); }}
    </div>
    </div>
    
    <div class="form-group">
	{{ Form::label('budget', 'Please include a project/organization budget, including other sources of funding:', 
													array('class' => 'control-label')); }}
	<div class="controls" style='max-width: 800px;'>
    {{ Form::textarea('budget', null, array('class' => 'required', 'style' => 'max-width: 800px;','cols' => '80') ); }}
    </div>
    </div>
    
    <div class="form-group">
	{{ Form::label('timeline', 'What is the timeline of the project?', array('class' => 'control-label')); }}
	<div class="controls" style='max-width: 800px;'>
    {{ Form::textarea('timeline', null, array('class' => 'required', 'style' => 'max-width: 800px;','cols' => '80') ); }}
    </div>
    </div>
    
    <div class="form-group">
	{{ Form::label('other_information', 'Please include any other relevant information applicable to your project:', 
													array('class' => 'control-label')); }}
	<div class="controls" style='max-width: 800px;'>
    {{ Form::textarea('other_information', null, array('class' => 'required', 'style' => 'max-width: 800px;','cols' => '80') ); }}
    </div>
    </div>
	
	<div class="form-group">
	{{ Form::label('contact_name', 'Contact Name', array('class' => 'control-label')); }}
		<div class="controls">
			<div class="input-group">
				<span class="input-group-addon"><i class='icon-user'></i></span>
				{{ Form::text('contact_name', null, array('class' => 'required form-control',
	    											'style' => 'max-width: 400px;',
	    											'placeholder' => 'Primary contact')); }}
			</div>
	    </div>
	</div>
	
	<div class="form-group">
	{{ Form::label('contact_email', 'Contact E-Mail Address', array('class' => 'control-label')); }}
		<div class="controls">
			<div class="input-group">
				<span class="input-group-addon"><i class="icon-envelope"></i></span>
				{{ Form::email('contact_email', null, array('class' => 'required email form-control',
													'placeholder' => 'you@example.com',
	    											'style' => 'max-width: 400px;')); }}
			</div>
	    </div>
	</div>
	
	<div class="form-group">
	{{ Form::label('contact_phone', 'Contact Phone Number', array('class' => 'control-label')); }}
		<div class="controls">
			<div class="input-group">
				<span class="input-group-addon"><i class="icon-phone"></i></span>
				{{ Form::text('contact_phone', null, array('class' => 'required form-control',
													'placeholder' => '506-XXX-XXXX',
	    											'style' => 'max-width: 400px;')); }}
			</div>
	    </div>
	</div>
	
	<div class="blog-divider"></div>
	
    <div class="form-group">
	    <div class="controls">
		    {{ Form::submit('Send Form', array('class' => 'btn-normal btn-color submit')) }}
	    </div>
	</div>
		
{{ Form::close() }}

<p>Please fill out the form, e-mail or mail a proposal letter to:<br />
<br />
Kate Shannon, Communications<br />
Canaport LNG<br />
<a href="mailto:kshannonm@canaportlng.com?subject=Apply%20For%20Sponsorship">kshannonm@canaportlng.com</a><br />
2530 Red Head Road<br />
PO Box 2029<br />
Saint John, NB<br />
E2L 3T5</p><p>&nbsp;</p>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		errorClass:'has-error',
		validClass:'has-success',
    	errorElement:'span',
    	highlight: function (element, errorClass, validClass) { 
        $(element).parents("div[class='form-group']").addClass(errorClass).removeClass(validClass); 
	    }, 
	    unhighlight: function (element, errorClass, validClass) { 
	        $(element).parents(".has-error").removeClass(errorClass).addClass(validClass); 
	    }
	});
});
</script>
@stop