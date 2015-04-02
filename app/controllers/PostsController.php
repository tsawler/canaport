<?php

class PostsController extends BaseController {

	public function index($year = null, $month = null)
	{
		// Initiate query, don't paginate on it yet in case we want the year/month condition added
		$query = Post::live();

		// If year and month passed in the URL, add this condition
		if ($year && $month) {
			$query = $query->where(DB::raw('DATE_FORMAT(published_date, "%Y%m")'), '=', $year.$month);
		}

		// Get the current page's posts
		$viewData['posts'] = $query
			->orderBy('published_date', 'desc')
			->paginate('5');

		$viewData['archives'] = Post::archives();

		return View::make('blog.posts.index', $viewData);
	}

	public function view($slug) {

		// Get the selected post
		$viewData['post'] = $post = Post::live()
			->where('slug', '=', $slug)
			->firstOrFail();

		// Get the next newest and next oldest post
		$viewData['newer'] = Post::live()
			->where('published_date', '>=', $post->published_date)
			->where('id', '<>', $post->id)
			->orderBy('published_date', 'asc')
			->orderBy('id', 'asc')
			->first();

		$viewData['older'] = Post::live()
			->where('published_date', '<=', $post->published_date)
			->where('id', '<>', $post->id)
			->orderBy('published_date', 'desc')
			->orderBy('id', 'desc')
			->first();


		$viewData['archives'] = Post::archives();

		return View::make('blog.posts.view', $viewData);

	}

	public function rss()
	{

		$feed = Rss::feed('2.0', 'UTF-8');
		$feed->channel(array(
			'title' => Config::get('app.rss_title'),
			'description' => Config::get('app.rss_description'),
			'link' => URL::current()
		));
		$posts = Post::where('status', '=', Post::APPROVED)
			->where('in_rss', '=', true)
			->orderBy('published_date', 'desc')
			->take(10)
			->get();
		foreach ($posts as $post){
			$feed->item(array(
				'title' => $post->title,
				'description' => $post->summary,
				'link' => Config::get('app.url').$post->slug
			));
		}

		return Response::make($feed, 200, array('Content-Type', 'application/rss+xml'));

	}

}
