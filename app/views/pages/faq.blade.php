@extends('insidewide')

@section('browser-title')
Frequently Asked Questions
@stop

@section('meta')
<meta name="description" content="Frequently Asked Questions: Canaport LNG" />
@stop

@section('content')

<h1>Frequently Asked Questions</h1>		

@if ((Auth::check()) && ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5))))
	<div class="accordionMod panel-group flash hidden">
		@foreach($faqs as $faq)
			<div class="accordion-item">
				{{ Form::open(array('url' => 'faq/edit', 'name' => 'faqform_'.$faq->id, 'id' => 'faqform_'.$faq->id)) }}
					<h4 class="accordion-toggle"><span class='editable' id="labeldata_{{$faq->id }}">{{ $faq->label }}</span></h4>
					<section class="accordion-inner panel-body">
						<p class="faqedit">
							<strong><span class='editable' id="questiondata_{{$faq->id }}">{{ $faq->question }}</span></strong><br>
							<article id="answerdata_{{ $faq->id }}" class='editable'>{{ $faq->answer }}</article>
						</p>
						<article class="admin-hidden">
						<a class="btn btn-primary" href="#!" onclick="saveEditedFaq({{ $faq->id }})">Save</a>
						<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
						&nbsp;&nbsp;&nbsp;
					</article>
					</section>
					<input type="hidden" name="faq_id" value="{{ $faq->id }}">
					<input type="hidden" name="thelabeldata_{{ $faq->id }}" id="thelabeldata_{{ $faq->id }}">
					<input type="hidden" name="thequestiondata_{{ $faq->id }}" id="thequestiondata_{{ $faq->id }}">
					<input type="hidden" name="theanswerdata_{{ $faq->id }}" id="theanswerdata_{{ $faq->id }}">
				{{ Form::close() }}
			</div>
		@endforeach
	</div>
@else
<div class="accordionMod panel-group flash hidden">
	@foreach($faqs as $faq)
		<div class="accordion-item">
			<h4 class="accordion-toggle">{{ $faq->label }}</h4>
			<section class="accordion-inner panel-body">
					<strong>{{ $faq->question }}</strong><br>
					{{ $faq->answer }}
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
<input type="hidden" name="fid" value="10">
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