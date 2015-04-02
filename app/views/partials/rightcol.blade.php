<?php 
$latest = DB::table('blog_posts')->where('status','=','APPROVED')->orderby('published_date','desc')->limit(2)->remember(525949)->get();
?>
 <!-- News Widget Start -->
<h3 class="title">Latest news</h3>
<div class="widget category well"  style="opacity:0.8;filter:alpha(opacity=80)">
	<dl>
	@foreach ($latest as $item )
		<dt>{{ date('F j, Y', strtotime($item->published_date)) }}</dt>
		<dd><a href="/news/{{ $item->slug }}">{{ $item->title }}</a></dd>
		<dd>&nbsp;</dd>
	@endforeach

	<dd class="pull-right"><a href="/news">More news...</a></dd>
	</dl>
</div>
<!-- Latest news Widget End -->


<div id="twitter-feed" class="widget center-block"></div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
