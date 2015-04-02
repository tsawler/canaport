<?php

class NewsletterController extends BaseController {

	public function __construct() {

	}
	
	/**
	 * Show newsletter page
	 *
	 * @return mixed
	 */
	public function getNewsletters()
	{
		$newsletters = Newsletter::where('active', '=', '1')->orderby('post_date','desc')->get();
		$fragment = Fragment::find(8);
		$fragment2 = Fragment::find(11);
		return View::make('pages.newsletters')->with('newsletters',$newsletters)->with('fragment',$fragment)->with('fragment2',$fragment2);
	}

}