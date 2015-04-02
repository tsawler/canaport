<!-- Search Widget Start -->
{{ Form::open(array('url' => '/searchnews', 'class' => '', 'method' => 'post')) }}
<div class="widget search-form">
   <div class="input-group">
			{{ Form::text('searchterm', null, array('class' => 'search-input form-control', 'id' => 'search-box', 'placeholder' => 'Search news...')); }}
			<span class="input-group-btn">
			<button type="submit" class="subscribe-btn btn"><i class="icon-search"></i></button>
			</span>
   </div>
   <!-- /input-group -->
</div>
{{ Form::close() }}
<!-- Search Widget End -->




@include('blog.partials.archives')