<!-- Header Start -->
<header id="header">
<!-- Header Top Bar Start -->
<div class="top-bar">
   <div class="slidedown collapse">
      <div class="container">
         <div class="pull-right">
            <ul class="social pull-left" style="line-height: 12px">
               <li class="dribbble" style="visibility: hidden;"><a href="#"><i class="icon-dribbble"></i></a></li>
               <li class="linkedin" style="visibility: hidden;"><a href="#"><i class="icon-linkedin"></i></a></li>
               <li class="facebook"><a href="https://www.facebook.com/pages/Canaport-LNG/209370655760311"><i class="icon-facebook"></i></a></li>
               <li class="twitter"><a href="https://twitter.com/canaportlng"><i class="icon-twitter"></i></a></li>
               <li class="rss"><a href="/news.rss"><i class="icon-rss"></i></a></li>
            </ul>
            <div id="search-form" class="pull-right" style="line-height: 12px">
	        	{{ Form::open(array('url' => 'search', 'method' => 'post')) }}
	              {{ Form::text('searchterm', null, array('class' => 'search-text-box hidden-phone hidden-tablet')) }}
	            {{ Form::close() }}
	        </div>
         </div>
      </div>
   </div>
</div>
