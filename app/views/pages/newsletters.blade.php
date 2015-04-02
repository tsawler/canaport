@extends('inside')

@section('browser-title')
Newsletters
@stop

@section('meta')
<meta name="description" content="Canaport LNG Connections newsletter" />
@stop

@section('content')

<h1>Newsletters</h1>		

@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag1', 'name' => 'savefrag1')) }}
<article class="editablefragment" id="f1" data-id="8">
{{ $fragment->fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(1)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<span id="thetitle1"></span>
<input type="hidden" name="fid" value="8">
<input type="hidden" name="thedata" id="thedata1">
<input type="hidden" name="thetitle" id="thetitledata1">
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


<?php
$first_time_through = true;
$old_year = date("Y") +1;
?>

<div class="accordionMod panel-group flash">
	@foreach($newsletters as $newsletter)
		@if ($first_time_through)
			<?php
			$first_time_through = false;
			?>
			<div class="accordion-item">
				<h4 class="accordion-toggle"><span id="labeldata_{{$newsletter->id }}">{{ $newsletter->year }}</span></h4>
				<section class="accordion-inner panel-body">
		@elseif($newsletter->year != $old_year)
					</section>
					</div>
			<div class="accordion-item">
				<h4 class="accordion-toggle"><span id="labeldata_{{$newsletter->id }}">{{ $newsletter->year }}</span></h4>
				<section class="accordion-inner panel-body">
		@endif
			<p>
			<img src="/img/adobe_reader_icon.jpg" alt="PDF">&nbsp;
			<a href="/pdf/newsletters/{{ $newsletter->pdf }}">{{ $newsletter->title }}</a> ({{ $newsletter->filesize}} MB PDF )
			</p>
		<?php
		$old_year = $newsletter->year;
		?>
	@endforeach
</section>
</div>
</div>

@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag2', 'name' => 'savefrag2')) }}
<article class="editablefragment" id="f2" data-id="9">
{{ $fragment2->fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(2)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<span id="thetitle1"></span>
<input type="hidden" name="fid" value="11">
<input type="hidden" name="thedata" id="thedata2">
<input type="hidden" name="thetitle" id="thetitledata2">
{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
<article>
{{ $fragment2->fragment_content }}
</article>
@endif
@endif

@if(! Auth::check())
<article>
{{ $fragment2->fragment_content }}
</article>
@endif


<span id="theeditmsg" class="hidden">&nbsp;</span>
@stop

@section('bottom-js')
<script>
@if ((Auth::user()) && (Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this item?", function(result) {
		if (result==true)
		{
			window.location.href = '/admin/deletenewsletter/'+x;
		}
	});
}
@endif
$(document).ready(function () {

});
</script>
@stop