<?php

class PageController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
	}

	protected $layout = "layout";

	
	/**
	 * Save edits to page (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function editPage(){
		if (Auth::user()->access_level == 3){
			$page = Page::find(Input::get('page_id'));
			$page->page_content = trim(Input::get('thedata'));
			$page->page_title = trim(Input::get('thetitledata'));
			$page->save();
			Cache::flush();
			return "Page updated successfully";
		}
	}


	/**
	 * Display home page
	 *
	 * @return mixed
	 */
	public function showHome(){
	
		$page_title = "";
		$page_content = "";
		$page_id = 0;
		$meta = "";

		$results = DB::table('pages')->where('slug','=','home')->remember(525949)->get();

		foreach ($results as $result)
		{
		    $page_title = $result->page_title;
		    $page_content = $result->page_content;
		    $meta = $result->meta;
		    $page_id = $result->id;
		}
		
		$frag = DB::table('fragments')->where('id','=','4')->get();

		foreach ($frag as $f)
		{
		    $fragment_title = $f->fragment_title;
		    $fragment_content = $f->fragment_content;
		}
		
		$frag2 = DB::table('fragments')->where('id','=','14')->get();

		foreach ($frag2 as $f)
		{
		    $fragment_title2 = $f->fragment_title;
		    $fragment_content2 = $f->fragment_content;
		}
		
		// look up splash image/text
		$splash = Splash::find(1);
		$splash_image = $splash->image;
		$splash_text = $splash->text;
		

		$involvements = DB::table("involvements")->take(3)->get();
		$involvements2 = DB::table("involvements")->skip(3)->take(3)->get();
		
		$photos = DB::table('gallery_images')->take(6)->get();
		
		return View::make('pages.home')
			->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('page_id', $page_id)
			->with('fragment_title',$fragment_title)
			->with('fragment_content',$fragment_content)
			->with('fragment_title2',$fragment_title2)
			->with('fragment_content2',$fragment_content2)
			->with('involvements', $involvements)
			->with('involvements2', $involvements2)
			->with('photos', $photos)
			->with('splash_image', $splash_image)
			->with('splash_text', $splash_text);
	}
	
	
	/**
	 * Show apply for sponsorship page
	 *
	 * @return null
	 */
	public function getApplyforsponorship(){

		$slug = Request::segment(1);
		$page_title = "Not active";
		$page_content = "Either the page you have requested is not active, or it does not exist.";
		$meta = "";
		$meta_tags = "";
		$active = 0;
		$page_id = 0;
		
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
		
		if ($active == 0){
			Session::flash('status', 'This page is not active!');
		}
		return View::make('pages.sponsorship')
			->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('meta_tags',$meta_tags)
			->with('active',$active)
			->with('page_id', $page_id);
	}
	
	/**
	 * Show apply for sponsorship page
	 *
	 * @return null
	 */
	public function postApplyforsponorship(){
		
		$organization = Input::get('organization');
		$project_description = Input::get('content');
		$benefit = Input::get('how_benefit');
		$budget = Input::get('budget');
		$timeline = Input::get('timeline');
		$other_info = Input::get('other_information');
		$contact_name = Input::get('contact_name');
		$contact_email = Input::get('contact_email');
		$contact_phone = Input::get('contact_phone');
		
		// build email
        $user_data = array(
			'email' => Config::get('app.contact_email'),
			'first_name' => Config::get('app.contact_name')
		);

		// the data that will be passed into the mail view blade template
		$data = array(
			'organization' => $organization,
			'project_description' => $project_description,
			'benefit' => $benefit,
			'budget' => $budget,
			'timeline' => $timeline,
			'other_info' => $other_info,
			'contact_name' => $contact_name,
			'contact_email' => $contact_email,
			'contact_phone' => $contact_phone
		);

		// use Mail::send function to send email passing the data and using the $user variable in the closure
		Mail::queue('emails.sponsorship', $data, function($message) use ($user_data) {
			$message->from('donotreply@canaportlng.com', 'Do not reply');
			$message->to($user_data['email'], $user_data['first_name'])->subject('Sponsorship request from website');
		});

		return Redirect::to('/Sponsorship+Request+Confirmation');
	}
	
	/**
	 * Show generic page
	 *
	 * @return null
	 */
	public function showPage(){

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
		
		if ($active == 0){
			Session::flash('status', 'This page is not active!');
		}
		return View::make('pages.defaultpage')
			->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('meta_tags',$meta_tags)
			->with('active',$active)
			->with('page_id', $page_id);
	}
}
