<?php

class GalleryController extends BaseController {

	public function __construct() {

	}
	
	
	/**
	 * Show gallery page
	 *
	 * @return mixed
	 */
	public function showFeed()
	{
		$images = GalleryImage::where('active','=','1')->paginate(16);
		return View::make('pages.gallery')
			->with('images', $images);
	}
}