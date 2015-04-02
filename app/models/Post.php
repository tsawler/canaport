<?php

class Post extends Eloquent  {
	
	public static $rules = array(
	   'title'=>'required|min:2|unique:blog_posts',
	   'summary'=>'required|min:2',
	   'content'=>'required|min:2',
	   'meta_keywords'=>'required',
	   'meta_description'=>'required',
	);
	
	const DRAFT = 'DRAFT';
	const APPROVED = 'APPROVED';
	
	protected $guarded = array('*');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog_posts';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	public function scopeLive($query)
	{
		if ((Auth::check()) && (Auth::user()->access_level == 3)) 
		{
			return $query;
		} else {
			return $query->where('status', '=', Post::APPROVED)
				->where('published_date', '<=', \Carbon\Carbon::now());
		}
		
	}
	
	public static function archives()
	{
		$archives = self::live()
			->select(DB::raw('
				YEAR(`published_date`) AS `year`,
				DATE_FORMAT(`published_date`, "%m") AS `month`,
				MONTHNAME(`published_date`) AS `monthname`,
				COUNT(*) AS `count`
			'))
			->groupBy(DB::raw('DATE_FORMAT(`published_date`, "%Y%m")'))
			->orderBy('published_date', 'desc')
			->get();
		$results = array();
		foreach ($archives as $archive)
		{
			$results[$archive->year][$archive->month] = array(
				'monthname' => $archive->monthname,
				'count' => $archive->count,
			);
		}
		return $results;
	}
	
	/**
	 * Returns the URL of the post
	 * @return string
	 */
	public function getUrl()
	{
		return \URL::action('PostsController@view', array('slug' => $this->slug));
	}
}