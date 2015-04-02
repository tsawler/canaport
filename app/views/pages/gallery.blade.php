@extends('insidegallery')

@section('browser-title')
Image Gallery
@stop

@section('meta')
<meta name="description" content="Frequently Asked Questions: Canaport LNG" />
@stop

@section('content')

<h1>Image Gallery</h1>	

<p>To request high res photos please contact Kate Shannon at <a href="mailto:kshannonm@canaportlng.com">kshannonm@canaportlng.com</a>.	
</p>
<!-- categories -->
<!-- <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
	<div id="options">
	   <ul id="filters" class="option-set clearfix" data-option-key="filter">
	      <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
	      <li><a href="#filter" data-option-value=".gallery_1">Category 1</a></li>
	      <li><a href="#filter" data-option-value=".gallery_2">Category 2</a></li>
	      <li><a href="#filter" data-option-value=".gallery_3">Category 3</a></li>
	      <li><a href="#filter" data-option-value=".gallery_4">Category 4</a></li>
	   </ul>
	</div>
</div> -->
 <!-- end categories -->
<div class="clearfix"></div>
<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 portfolio-wrap">
	<div class="row">
		<div class="portfolio">
		
			@foreach($images as $image)
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 {{ $image->category }} item">
				<div class="portfolio-item">
					<a href="/img/gallery/{{ $image->img }}" class="portfolio-item-link" data-rel="prettyPhoto" >
						<span class="portfolio-item-hover"></span>
						<span class="fullscreen"><i class="icon-search"></i></span><img src="/img/gallery/{{ $image->img }}" alt=" "/>
					</a>
					<div class="portfolio-item-title">
						{{ $image->label }}
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			@endforeach
			
		</div> <!-- portfolio -->
	</div> <!-- row -->
</div> <!-- col -->
<div class="clearfix"></div>
{{ $images->links() }}

<p>&nbsp;</p>	
<span id="theeditmsg" class="hidden">&nbsp;</span>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {
	$(".flash").removeClass("hidden");
});
</script>
@stop