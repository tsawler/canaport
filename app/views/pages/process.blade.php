@extends('inside')

@section('browser-title')
LNG Process: Canaport LNG | Clean. Safe. Energy.
@stop

@section('content')

<?php
$frag = Fragment::find(1);
$content1 = $frag->fragment_content;

$frag = Fragment::find(2);
$content2 = $frag->fragment_content;

$frag = Fragment::find(3);
$content3 = $frag->fragment_content;

$frag = Fragment::find(5);
$content4 = $frag->fragment_content;

$frag = Fragment::find(12);
$content5 = $frag->fragment_content;
?>
<h1>LNG Process</h1>
<img src="/img/process.jpg" style="width: 100%">
<br><br>
<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
</div>
@if(Auth::check())
@if((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
<div id="horizontal-tabs">
	<ul class="tabs">

		
		<li id="tab1" class="current">LNG History</li>
		<li id="tab2">LNG Shipping</li>
		
		<li id="tab4">LNG Unloading</li>
		
		<li id="tab3">LNG Storage</li>
		
		<li id="tab5">Regasification</li>
		
	</ul>
	<div class="contents">
		<div class="tabscontent" id="content1" style="display: block;">
			{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag1', 'name' => 'savefrag1')) }}
			<article class="editablefragment" id="f1" data-id="1">
			{{ $content1 }}
			</article>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="#!" onclick="saveEditedFragment(1)">Save</a>
				<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
			</article>
			<input type="hidden" name="fid" value="1">
			<input type="hidden" name="thedata" id="thedata1">
			<input type="hidden" name="thetitle" id="thetitledata1">
			{{ Form::close() }}
		</div>
		<div class="tabscontent" id="content2">
			{{ Form::open(array('url' => '/admin/savefragment', 'id' => 'savefrag2', 'name' => 'savefrag2')) }}
			<article class="editablefragment" id="f2" data-id="3">
			{{ $content2 }}
			</article>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(2)">Save</a>
				<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
			</article>
			<input type="hidden" name="fid" value="2">
			<input type="hidden" name="thedata" id="thedata2">
			<input type="hidden" name="thetitle" id="thetitledata2">
			{{ Form::close() }}
			</article>
		</div>
		
		
		<div class="tabscontent" id="content4">
			{{ Form::open(array('url' => '/admin/savefragment', 'id' => 'savefrag4', 'name' => 'savefrag4')) }}
			<article class="editablefragment" id="f4" data-id="5">
			{{ $content4 }}
			</article>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(4)">Save</a>
				<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
			</article>
			<input type="hidden" name="fid" value="5">
			<input type="hidden" name="thedata" id="thedata4">
			<input type="hidden" name="thetitle" id="thetitledata4">
			{{ Form::close() }}
			</article>
		</div>
		
		<div class="tabscontent" id="content3">
			{{ Form::open(array('url' => '/admin/savefragment', 'id' => 'savefrag3', 'name' => 'savefrag3')) }}
			<article class="editablefragment" id="f3" data-id="5">
			{{ $content3 }}
			</article>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(3)">Save</a>
				<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
			</article>
			<input type="hidden" name="fid" value="3">
			<input type="hidden" name="thedata" id="thedata3">
			<input type="hidden" name="thetitle" id="thetitledata3">
			{{ Form::close() }}
			</article>
		</div>
		
		<div class="tabscontent" id="content5">
			{{ Form::open(array('url' => '/admin/savefragment', 'id' => 'savefrag5', 'name' => 'savefrag5')) }}
			<article class="editablefragment" id="f5" data-id="12">
			{{ $content5 }}
			</article>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(5)">Save</a>
				<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
			</article>
			<input type="hidden" name="fid" value="12">
			<input type="hidden" name="thedata" id="thedata5">
			<input type="hidden" name="thetitle" id="thetitledata5">
			{{ Form::close() }}
			</article>
		</div>
	</div>
</div>
<p>&nbsp;</p>
<input type="hidden" name="content" id="content1">
<input type="hidden" name="content" id="content2">
<input type="hidden" name="content" id="content3">
<input type="hidden" name="content" id="content4">
<input type="hidden" name="content" id="content5">

<input type="hidden" name="oldcontent1" id="oldcontent1">
<input type="hidden" name="oldcontent2" id="oldcontent2">
<input type="hidden" name="oldcontent3" id="oldcontent3">
<input type="hidden" name="oldcontent4" id="oldcontent4">
<input type="hidden" name="oldcontent5" id="oldcontent5">
@endif
@endif

@if(!Auth::check())
<div id="horizontal-tabs">
	<ul class="tabs">
		<li id="tab1" class="current">LNG History</li>
		<li id="tab2">LNG Shipping</li>
		<li id="tab4">LNG Unloading</li>
		
		<li id="tab3">LNG Storage</li>
		<li id="tab5">Regasification</li>
	</ul>
	<div class="contents">
		<div class="tabscontent" id="content1" style="display: block;">
			{{ $content1 }}
		</div>
		<div class="tabscontent" id="content2">
			{{ $content2 }}
		</div>
		<div class="tabscontent" id="content4">
			{{ $content4 }}
		</div>
		<div class="tabscontent" id="content3">
			{{ $content3 }}
		</div>
		<div class="tabscontent" id="content5">
			{{ $content5 }}
		</div>
	</div>
</div>
@endif
@stop

@section('bottom-js')
<script>

</script>
@stop
