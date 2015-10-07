@extends('insidewide')

@section('browser-title')
Search
@stop

@section('meta')
<meta name="description" content="Search Canaport LNG" />
@stop

@section('content')
	<h3 class="short_headline" style="text-transform: none;"><span id="editablecontenttitle">Search</span></h3>
	{{ Form::open(array('url' => 'search', 'role' => 'form', 'class' => 'form-inline', 'method' => 'post')) }}
	<div class="input-group" style="max-width: 400px">
		<input type="text" value="Search..." onfocus="if(this.value=='Search...')this.value='';" 
			onblur="if(this.value=='')this.value='Search...';" name="searchterm" id="searchterm" 
			class="search-input form-control">
		<span class="input-group-btn">
		<button type="submit" class="subscribe-btn btn"><i class="icon-search"></i></button>
		</span>
		</div>
	{{ Form::close() }}
	<dl>
	<dt>&nbsp;</dt>
	<dd>&nbsp;</dd>
	@if (isset($results))
	@if ($results)
		@foreach ($results as $result)
			<dt><a href="{{ $result->target }}">{{ $result->the_title }}</a></dt>
			<dd>{{ str_ireplace($searchterm,"<span style='background: yellow'>".$searchterm."</span>",strip_tags($result->the_content)) }} </dd>
			<dd>&nbsp;</dd>
		@endforeach
	@else
	<dt>&nbsp;</dt>
	<dt>No results</dt>
	
	<dd>Your search for {{ $searchterm }} did not return any results.</dd>
	@endif
	@endif
	</dl>
<p>&nbsp;</p>	
@stop