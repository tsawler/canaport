<?php

class AjaxController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array('only'=>array('getLn')));
	}

	protected $layout = "layout";
	
	public function getLn(){
		if (Auth::user()->access_level == 3){
			
			$return = array();
			$users = User::where('last_name','like', '%'.Input::get('query').'%')->get();
			
			foreach ($users as $user){
				$return[] = $user->last_name;
			}
			
			return Response::json($return);
		}
	}

}