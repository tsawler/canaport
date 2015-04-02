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
@stop