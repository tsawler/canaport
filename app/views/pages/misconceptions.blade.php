@extends('insidewide')

@section('browser-title')
Misconceptions About LNG
@stop

@section('meta')
<meta name="description" content="Frequently Asked Questions: Canaport LNG" />
@stop

@section('content')

<h1>Common Misconceptions About LNG</h1>		

@if ((Auth::check()) && ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5))))
	<div class="accordionMod panel-group flash hidden">
		@foreach($misconceptions as $misconception)
			<div class="accordion-item">
				{{ Form::open(array('url' => 'misconceptions/edit', 'name' => 'faqform_'.$misconception->id, 'id' => 'faqform_'.$misconception->id)) }}
					<h4 class="accordion-toggle"><span class='editable' id="labeldata_{{$misconception->id }}">{{ $misconception->label }}</span></h4>
					<section class="accordion-inner panel-body">
						<p class="faqedit">
							<strong><span class='editable' id="questiondata_{{$misconception->id }}">{{ $misconception->question }}</span></strong><br>
							<article id="answerdata_{{ $misconception->id }}" class='editable'>{{ $misconception->answer }}</article>
						</p>
						<article class="admin-hidden">
						<a class="btn btn-primary" href="#!" onclick="saveEditedFaq({{ $misconception->id }})">Save</a>
						<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
						&nbsp;&nbsp;&nbsp;
					</article>
					</section>
					<input type="hidden" name="misconception_id" value="{{ $misconception->id }}">
					<input type="hidden" name="thelabeldata_{{ $misconception->id }}" id="thelabeldata_{{ $misconception->id }}">
					<input type="hidden" name="thequestiondata_{{ $misconception->id }}" id="thequestiondata_{{ $misconception->id }}">
					<input type="hidden" name="theanswerdata_{{ $misconception->id }}" id="theanswerdata_{{ $misconception->id }}">
				{{ Form::close() }}
			</div>
		@endforeach
	</div>
@else
<div class="accordionMod panel-group flash hidden">
	@foreach($misconceptions as $misconception)
		<div class="accordion-item">
			<h4 class="accordion-toggle">{{ $misconception->label }}</h4>
			<section class="accordion-inner panel-body">
					<strong>{{ $misconception->question }}</strong><br>
					{{ $misconception->answer }}
			</section>
		</div>
	@endforeach
</div>
@endif

@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag2', 'name' => 'savefrag2')) }}
<article class="editablefragment" id="f2" data-id="9">
{{ $fragment->fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(2)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<span id="thetitle1"></span>
<input type="hidden" name="fid" value="13">
<input type="hidden" name="thedata" id="thedata2">
<input type="hidden" name="thetitle" id="thetitledata2">
{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
<article>
{{ $fragment->fragment_content }}
</article>
@endif
@endif

@if(! Auth::check())
<article>
{{ $fragment->fragment_content }}
</article>
@endif
	
<span id="theeditmsg" class="hidden">&nbsp;</span>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {
	$(".flash").removeClass("hidden");
});
</script>
@stop