<article class="entry-post">

	<header class="entry-header">

		@if(Auth::check())
		@if(Auth::user()->access_level == 3)
			<div id="editmsg" class='alert alert-success hidden'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span id="theeditmsg">&nbsp;</span>
			</div>

			{{ Form::open(array('url' => '/post/edit',  'name' => 'savetitledata', 'id' => 'savetitledata')) }}

				<div id="approved" class="admin-hidden pull-right">
				<select name="status" id="status">
					<option value="DRAFT"
						@if($post->status == 'DRAFT')
							selected
						@endif
						>Draft</option>
					<option value="APPROVED"
						@if($post->status == 'APPROVED')
							selected
						@endif
						>Approved</option>
				</select>

				</div>
				<div style="clear: both; margin-bottom: 5px;"></div>

					<h1 class="entry-title">
						<span id="editablecontenttitle" style='width: 100%'>
							{{ $post->title }}
							</span>
					</h1>
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<input type="hidden" name="title" id="title">

		@endif
		@endif

		@if(Auth::check())
		@if(Auth::user()->access_level == 1)
			<h1 class="entry-title">{{ $post->title }}</h1>
		@endif
		@endif

		@if(!Auth::check())
			<h1 class="entry-title">{{ $post->title }}</h1>
		@endif

		@if(Auth::check())
		@if(Auth::user()->access_level == 3)
			<div class="byline" id="postdate"><i class="icon-time"></i>
				{{ date('Y-m-d', strtotime($post->published_date)) }}
			</div>
			<div class='admin-hidden'>
				<!-- <input  id='datetimepicker'
					type='text'
					id="published_date"
					name='published_date'
					value="{{ date('Y-m-d', strtotime($post->published_date)) }}"> -->
			<div class="input-prepend"> <span class="add-on"><i class=" icon-calendar"></i></span>
				{{ Form::text('published_date', date('Y-m-d', strtotime($post->published_date)), array(
																	'class' => 'dateISO',
																	'id' => 'published_date')); }}
				</div>
			</div>
		@else
			<div class="byline"><i class="icon-time"></i>
				{{ date('Y-m-d', strtotime($post->published_date)) }}
			</div>
		@endif
		@endif

		@if(!Auth::check())
			<div class="byline"><i class="icon-time"></i>
			{{ date('Y-m-d', strtotime($post->published_date)) }}
			</div>
		@endif

		@if(Auth::check())
		@if(Auth::user()->access_level == 3)
			<input type="hidden" name="content" id="content">
			{{ Form::close() }}
		@endif
		@endif

	</header>

	<div class="entry-content">

		@if(Auth::check())
		@if(Auth::user()->access_level ==3)
			<article class="editablecontent" style='width: 100%'>
				{{ $post->content }}
			</article>
			<hr>
			<article class="admin-hidden">
				<a class="btn btn-primary" href="#!" onclick="savePostChanges()">Save</a>
				<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
				&nbsp;&nbsp;&nbsp;
				<a class="btn btn-danger" href="#!" onclick="deletePost()">Delete</a>
			</article>
		@endif
		@endif

		@if(Auth::check())
		@if(Auth::user()->access_level == 1)
			{{ $post->content }}
		@endif
		@endif

		@if(!Auth::check())
			{{ $post->content }}
		@endif


		@include('blog.partials.share')
		<br><br>

		<div class="blog-divider"></div>

		@if ($newer || $older)
			<ul class="pager">
				
				@if ($older)
					<li><a href="{{ $older->getUrl() }}">&larr; Older</a></li>
				@endif
				
				@if ($newer)
					<li><a href="{{ $newer->getUrl() }}">Newer &rarr;</a></li>
				@endif
			</ul>
		@endif

	</div>


	<!--end entry-footer-->

</article>

@if(Auth::check())
@if(Auth::user()->access_level == 3)

{{ Form::open(array('url' => '/post/delete',  'name' => 'deleteform', 'id' => 'deleteform')) }}
	<input type="hidden" name="post_id" value="{{ $post->id }}">
{{ Form::close() }}
@endif
@endif

@section('bottom-js')
<script>
$(document).ready(function () {
	$("#published_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
});
function savePostChanges(){
    // save the changed data
    var data = $('#editablecontent').html();
    $("#content").val(data);
    $("#old").val('');

    // get the changed data;
    var titledata = $('#editablecontenttitle').html();
    $("#title").val(titledata);
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savetitledata").unbind('submit').ajaxSubmit(options);
    $("#oldtitle").val('');
    return false;
}
function deletePost(){
	var r=confirm("Are you sure you want to delete this post?");
	if (r) {
		$("#deleteform").submit();
	} else {

		return false;
	}
}
</script>
@stop