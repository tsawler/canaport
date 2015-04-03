<?php

class ContactController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getContact(){
		$slug = Request::segment(1);
		$page_title = "Not active";
		$page_content = "Either the page you have requested is not active, or it does not exist.";
		$meta = "";
		$meta_tags = "";
		$active = 0;
		$page_id = 0;
		
		//$results = DB::select('select * from pages where slug = ?', array($slug));
		$results = DB::table('pages')->where('slug','=',$slug)->remember(525949)->get();
		$page_title = urldecode($page_title);

		foreach ($results as $result)
		{
			$active = $result->active;
			if (($active > 0) || 
					((Auth::check()) && (Auth::user()->access_level == 3))) {
				$page_title = $result->page_title;
				$page_content = $result->page_content;
				$meta = $result->meta;
				$page_id = $result->id;
				$meta_keywords = $result->meta_tags;
			}
		}
		return View::make('pages.contact')
		->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('meta_tags',$meta_tags)
			->with('active',$active)
			->with('page_id', $page_id);
	}
	
	
	public function postContact(){
		    
	    // build email
		$user_data = array(
			'email'=>Input::get('email'),
			'name'=>Input::get('name')
		);

		// the data that will be passed into the mail view blade template
		$data = array(
			'users_name'  => $user_data['name'],
			'the_message'=>Input::get('message'),
			'email'=>Input::get('email')
		);
		
		// use Mail::send function to send email passing the data and using the $user variable in the closure
		Mail::queue('emails.contact_email', $data, function($message) use ($user_data) {
				$message->from('donotreply@canaportlng.com', 'Do not reply');
				$message->to(Config::get('app.contact_email'))->subject('Contact form from website');
		});
		
	
		return Redirect::to('/Thanks');
	}
}