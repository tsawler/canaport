<?php 
$latest = DB::table('blog_posts')->where('status','=','APPROVED')->orderby('published_date','desc')->limit(2)->remember(525949)->get();
?>
 <!-- News Widget Start -->
<h3 class="title">Latest Tweets</h3>



<div id="twitter-feed" class="widget center-block"></div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
