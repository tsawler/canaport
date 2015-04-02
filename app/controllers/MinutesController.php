<?php

class MinutesController extends BaseController {

	public function __construct() {

	}
	
	/**
	 * Show minutes page
	 *
	 * @return mixed
	 */
	public function showMinutes()
	{
		$minutes = Minute::where('active', '=', '1')->orderby('post_date','desc')->get();
		$fragment = Fragment::find(7);
		$fragment2 = Fragment::find(9);
		return View::make('pages.minutes')->with('minutes',$minutes)->with('fragment',$fragment)->with('fragment2',$fragment2);
	}

}