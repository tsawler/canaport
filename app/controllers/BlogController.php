<?php

class BlogController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'blog_posts'));
		$this->beforeFilter('auth', array('only'=>array('postSave')));
		$this->beforeFilter('auth', array('only'=>array('postDelete')));
		$this->beforeFilter('auth', array('only'=>array('postEdit')));
	}
	
	/**
	 * Show form to create blog post
	 *
	 * @return null
	 */
	public function getCreate()
	{
		return View::make('blog.posts.create');
	}
	
	/**
	 * Save blog post
	 *
	 * @return null
	 */
	public function postSave()
	{
		if (Auth::user()->access_level == 3)
		{
			$validator = Validator::make(Input::all(), Post::$rules);
			if ($validator->passes())
			{
				$post = new Post;
				$post->title = trim(Input::get('title'));
				$post->status = Input::get('status');
				$post->published_date = Input::get('post_date'). " 00:00:01";
				$post->content = Input::get('content');
				$post->summary = Input::get('summary');
				$post->meta_description = Input::get('meta_description');
				$post->meta_keywords = Input::get('meta_keywords');
				$post->in_rss = 1;
				$post->slug = urlencode(trim(Input::get('title')));
				$post->save();
				return Redirect::to('news')
					->with('message', 'Post saved successfully');
			}
			else
			{
				return Redirect::to('post/create')
					->with('error', 'The following errors occurred:')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	/**
	 * Delete blog post
	 *
	 * @return null
	 */
	public function postDelete()
	{
		if (Auth::user()->access_level == 3)
		{
			$post = Post::find(Input::get('post_id'));
			$post->delete();
			return Redirect::to('/news')
				->with('message', 'Post deleted successfully');
		}
	}
	
	/**
	 * Save edit post (called via ajax)
	 *
	 * @return String
	 */
	public function postEdit()
	{
		{
			$validator = Validator::make(
				Input::all(),
				array(
					'title' => 'required|min:2|unique:blog_posts',
					'published_date' => 'required',
					'content' => 'required|min:2')
			);

			if ($validator->passes())
			{
				$post = Post::find(Input::get('post_id'));
				$post->title = trim(Input::get('title'));
				$post->slug = trim(urlencode(Input::get('title')));
				$post->status = Input::get('status');
				$post->published_date = Input::get('published_date'). " 00:00:01";
				$post->content = Input::get('content');
				$post->status = Input::get('status');
				$post->save();
				return "Post updated successfully";
			}
			else
			{
				$m =  "The following errors occurred:";
				$messages = $validator->messages();
				var_dump($messages);
				return $m;
			}
		}
	}
}