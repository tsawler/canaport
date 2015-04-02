@if (!$posts->isEmpty())

	@foreach ($posts as $post)
	
		<article class="post hentry">
		    
		    <header class="post-header">
	          <h3 class="content-title"><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
	          <div class="blog-entry-meta">
	             <div class="blog-entry-meta-date">
	                <i class="icon-time"></i>
	                @if($post->status == 'DRAFT')
						<span class="label label-warning">Draft</span>
					@endif
					@if(strtotime($post->published_date) > strtotime('now'))
						<span class="label label-warning">Pending</span>
					@endif
	                <span class="blog-entry-meta-date-month">{{ date('F', strtotime($post->published_date)) }}</span>
	                <span class="blog-entry-meta-date-day">{{ date('d', strtotime($post->published_date)) }},</span>
	                <span class="blog-entry-meta-date-year">{{ date('Y', strtotime($post->published_date)) }}</span>
	             </div>
	          </div>
	       </header>
	       
	       <div class="post-content">
	            {{ $post->summary }}
	       </div>
	       <footer class="post-footer">
	          <a href="{{ $post->getUrl() }}" title="{{ $post->title }}" class="btn-small btn-color">Read More</a>
	       </footer>
	       <p>&nbsp;</p>
	    </article>
	                
	@endforeach
	
	<div class='pagination'>
	{{ $posts->links() }}
	</div>

@else

	<p class="blog--empty">
		{{ trans('laravel-blog::messages.list.no_posts') }}
	</p>

@endif