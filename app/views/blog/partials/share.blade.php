<div class="pull-right">
	<i class="icon-twitter"></i> 
	<a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title . ' ' . $post->getUrl()) }}" target="_blank">
		Tweet
	</a>&nbsp;&nbsp;
	<i class="icon icon-facebook"></i> 
	<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->getUrl()) }}" target="_blank">
		Share 
	</a>
</div>