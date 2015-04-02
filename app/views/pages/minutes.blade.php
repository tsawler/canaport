@extends('inside')

@section('browser-title')
Canaport Community Liaison Committee (CCELC)
@stop

@section('meta')
<meta name="description" content="CCELC Minutes: Canaport LNG" />
@stop

@section('content')


<h1>Canaport Community Liaison Committee (CCELC)</h1>	
	
@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag1', 'name' => 'savefrag1')) }}
<article class="editablefragment" id="f1" data-id="7">
{{ $fragment->fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(1)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<span id="thetitle1"></span>
<input type="hidden" name="fid" value="7">
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

@foreach($minutes as $minute)
	@if ($first_time_through)
		<?php
		$first_time_through = false;
		?>
		<div class="accordion-item">
			<h4 class="accordion-toggle">{{ $minute->year }}</h4>
			<section class="accordion-inner panel-body">
	@elseif($minute->year != $old_year)
				</section>
				</div>
		<div class="accordion-item">
			<h4 class="accordion-toggle">{{ $minute->year }}</h4>
			<section class="accordion-inner panel-body">
	@endif
		<p>
		<img src="/img/adobe_reader_icon.jpg" alt="PDF">&nbsp;
		<a href="/pdf/minutes/{{ $minute->pdf }}">{{ $minute->title }}</a>
		</p>
	<?php
	$old_year = $minute->year;
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
<input type="hidden" name="fid" value="9">
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
			window.location.href = '/admin/deleteminutes/'+x;
		}
	});
}
@endif
$(document).ready(function () {

});
</script>
@stop