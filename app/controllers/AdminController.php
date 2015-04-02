<?php

class AdminController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('on'=>'get'));
		$this->beforeFilter('auth', array('only'=>'post'));
	}

	protected $layout = "layout";
	
	
	/*********** User/admin Methods ****************/
	
	
	/**
	 * Show user in form
	 *
	 * @return mixed
	 */
	public function getEdituser(){
		if (Auth::user()->access_level == 3)
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			return View::make('users.dashboard.user')
				->with('user',$user);
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Save user
	 *
	 * @return mixed
	 */
	public function postEdituser(){
		if (Auth::user()->access_level == 3)
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->access_level = Input::get('access_level');
			$user->user_active = Input::get('user_active');
			$user->save();
			
			return Redirect::to('admin/edituser/'.$user_id)
				->with('message', 'Changes saved.');
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Save a user's roles
	 *
	 * @return mixed
	 */
	public function postEdituserroles(){
		if (Auth::user()->access_level == 3)
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);			
			$roles = array();
			
			foreach(Input::all() as $name => $value){
				if ($this->startsWith($name, "r_")) {
					$roles[] = $value;
				}
			}

			$user->roles()->sync($roles);
			
			return Redirect::to('admin/edituser/'.$user_id)
				->with('message', 'Changes saved.');
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Show list of admin users
	 *
	 * @return mixed
	 */
	public function getAdminusers() {
		if (Auth::user()->access_level == 3)
		{
			$adminusers = User::where('access_level', '=', '3')->orderby('last_name')->paginate(15);
			return View::make('users.dashboard.adminusers')
				->with('adminusers',$adminusers);
		} else {

			return View::make('users.dashboard.dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Show list of all users
	 *
	 * @return mixed
	 */
	public function getAllusers() {
		if (Auth::user()->access_level == 3)
		{
			$allusers = User::where('access_level', '>=', '1')->orderby('last_name')->paginate(15);
			return View::make('users.dashboard.allusers')
				->with('allusers',$allusers)
				->with('email', '')
				->with('last_name', '');
		} else {
	
			return View::make('users.dashboard.dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all users
	 *
	 * @return mixed
	 */
	public function postAllusers() {
	
		if (Auth::user()->access_level == 3)
		{
			$allusers = DB::table('users');

			if(strlen(Input::get('last_name')) > 0)
				$allusers->where('last_name','like', "%".Input::get('last_name')."%");

			if(Input::get('email'))
				$allusers->where('email','like', Input::get('email'));
			
			$allusers = $allusers->paginate(15);
			
			return View::make('users.dashboard.allusers')
				->with('allusers',$allusers)
				->with('last_name',Input::get('last_name'))
				->with('email', Input::get('email'));
		} else {
	
			return View::make('users.dashboard.dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Function to test for start of string
	 *
	 * @return mixed
	 */
	private function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
	
	
	/*********** Page Methods ****************/
	
	
	/**
	 * Show page form 
	 *
	 * @return mixed
	 */
	public function getCreatepage(){
		return View::make('users.dashboard.createpage');
	}
	
	
	/**
	 * Save page 
	 *
	 * @return mixed
	 */
	 public function postSavepage(){
		if (Auth::user()->access_level == 3){
			$validator = Validator::make(Input::all(), Page::$rules);
			if ($validator->passes()) {
				$page = new Page;
				$page->page_name = trim(Input::get('page_name'));
				$page->page_title = trim(Input::get('page_name'));
				$page->active = Input::get('active');
				$page->page_content = trim(Input::get('page_content'));
				$page->meta = Input::get('meta_description');
				$page->meta_tags = Input::get('meta_keywords');
				$page->slug = urlencode(trim(Input::get('page_name')));
				Cache::flush();
				$page->save();
				return Redirect::to('/admin/allpages')->with('message','Page saved successfully');
			} else {
				return Redirect::to('admin/createpage')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	/**
	 * Show add CI form 
	 *
	 * @return mixed
	 */
	public function getAddinvolvement(){
		return View::make('users.dashboard.createci');
	}
	
	/**
	 * Create CI
	 *
	 * @return mixed
	 */
	public function postAddinvolvement()
	{	
		if (Input::hasFile('pic'))
		{
			// get the file
			$file = Input::file('pic');
			$destinationPath = base_path() . '/public/img/ci/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			$upload_success = Input::file('pic')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// create a new record and save the data
				$ci = new Involvement;
				$ci->pic = $filename;
				$ci->label = trim(Input::get('label'));
				$ci->date_posted = Input::get('date_posted');
				$ci->content = trim(Input::get('content'));
				$ci->active = Input::get('active');
				$ci->save();
				Cache::flush();
				return Redirect::to('/admin/addinvolvement')->with('message','Item saved successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// does not have a picture
			// create a new record and save the data
			$ci = new Involvement;
			$ci->pic = "no-image.jpg";
			$ci->label = trim(Input::get('label'));
			$ci->content = trim(Input::get('content'));
			$ci->date_posted = Input::get('date_posted');
			$ci->active = Input::get('active');
			$ci->save();
			Cache::flush();
			return Redirect::to('/admin/addinvolvement')->with('message','Item saved successfully');
		}
	}
	
	
	/**
	 * Show all ci items
	 *
	 * @return mixed
	 */
	public function getAllinvolvement(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5)))
		{
			
			$cis = Involvement::where('active', '=', '1')->orderby('label')->paginate(16);
			return View::make('users.dashboard.allcis')
				->with('cis',$cis)
				->with('label', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all ci items
	 *
	 * @return mixed
	 */
	public function postAllinvolvement() {
		if (Auth::user()->access_level == 3)
		{
			$cis = DB::table('involvements');
			
			if(strlen(Input::get('label')) > 0)
				$cis->where('label','like', "%".Input::get('label')."%");
				
			$cis = $cis->paginate(16);
			
			return View::make('users.dashboard.allcis')
				->with('cis',$cis)
				->with('label', Input::get('label'));
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show involvment for edit
	 *
	 * @return mixed
	 */
	public function getEditinvolvement(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
		{
			$id = Request::segment(3);
			$cis = Involvement::find($id);
			return View::make('users.dashboard.editcis')
				->with('cis',$cis);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Save edited CI item
	 *
	 * @return mixed
	 */
	public function postEditinvolvement()
	{
		$ci = Involvement::find(Request::segment(3));
		
		// check to see if there was a file in the upload
		if (Input::hasFile('pic'))
		{
		    // get the file
			$file = Input::file('pic');
			$destinationPath = base_path() . '/public/img/ci/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pic')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// csave the data
				$ci->pic = $filename;
				$ci->label = trim(Input::get('label'));
				$ci->date_posted = Input::get('date_posted');
				$ci->content = trim(Input::get('content'));
				$ci->active = Input::get('active');
				$ci->save();
				return Redirect::to('/admin/allinvolvement')->with('message','Item saved successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// no file -- just changing text/date/whatever
			$ci->label = trim(Input::get('label'));
			$ci->content = trim(Input::get('content'));
			$ci->date_posted = Input::get('date_posted');
			$ci->active = Input::get('active');
			$ci->save();
			return Redirect::to('/admin/allinvolvement')->with('message','Item saved successfully');
		}
		
	}
	
	
	/**
	 * delete CI item
	 *
	 * @return mixed
	 */
	public function getDeleteinvolvement(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
		{
			$id = Involvement::find(Request::segment(3));
			$id->delete();
			return Redirect::to('admin/allinvolvement')->with('message','Item deleted successfully.');
		}
	}
		
	
	/**
	 * Save edited page 
	 *
	 * @return mixed
	 */
	 public function postEditpage(){
		if (Auth::user()->access_level == 3){
			$page = new Page;
			$page = Page::find(Request::segment(3));
			$page->page_name = trim(Input::get('page_name'));
			$page->page_title = trim(Input::get('page_name'));
			$page->active = Input::get('active');
			$page->page_content = trim(Input::get('page_content'));
			$page->meta = Input::get('meta');
			$page->meta_tags = Input::get('meta_tags');
			$page->slug = urlencode(trim(Input::get('page_name')));
			Cache::flush();
			$page->save();
			return Redirect::to('/admin/allpages')->with('message','Page saved successfully');
		}
	}
	
	/**
	 * Delete a page
	 *
	 * @return mixed
	 */
	public function getDeletepage(){
		$page_id = Request::segment(3);
		$page = Page::find($page_id);
		$page->delete();
		return Redirect::to('admin/allpages')->with('message','Page deleted successfully.');
	}
	
	/**
	 * Show all pages
	 *
	 * @return mixed
	 */
	public function getAllpages() {
		if (Auth::user()->access_level == 3)
		{
			$pages = Page::where('active', '=', '1')->where('id','<>',8)->orderby('page_name')->paginate(16);
			return View::make('users.dashboard.allpages')
				->with('allpages',$pages)
				->with('page_name', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all pages
	 *
	 * @return mixed
	 */
	public function postAllpages() {
		if (Auth::user()->access_level == 3)
		{
			$pages = DB::table('pages');
			
			$pages->where('id','<>',8);
			if(strlen(Input::get('page_name')) > 0)
				$pages->where('page_name','like', "%".Input::get('page_name') ."%");
				
			$pages = $pages->paginate(16);
			
			return View::make('users.dashboard.allpages')
				->with('allpages',$pages)
				->with('page_name', Input::get('page_name'));
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show page for edit
	 *
	 * @return mixed
	 */
	public function getEditpage(){
		if (Auth::user()->access_level == 3)
		{
			$page_id = Request::segment(3);
			$page = Page::find($page_id);
			return View::make('users.dashboard.editpage')
				->with('page',$page);
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	
	
	/*********** FAQ Methods ****************/
	
	
	/**
	 * Show add faq
	 *
	 * @return mixed
	 */
	public function getAddfaq(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5))) {
			return View::make('users.dashboard.createfaq');
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Create faq
	 *
	 * @return mixed
	 */
	public function postAddfaq() {
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5))) {
			$validator = Validator::make(Input::all(), Faq::$rules);
			if ($validator->passes()) {
				$faq = new Faq;
				$faq->label = trim(Input::get('label'));
				$temp = Input::get('question');
				$faq->question = trim(strip_tags($temp));
				$faq->active = Input::get('active');
				$faq->answer = trim(Input::get('answer'));
				$faq->save();
				return Redirect::to('/admin/allfaqs')->with('message','FAQ saved successfully');
			} else {
				return Redirect::to('admin/addfaq')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show all faqs
	 *
	 * @return mixed
	 */
	public function getAllfaqs(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5)))
		{
			
			$faqs = Faq::where('active', '=', '1')->orderby('label')->paginate(16);
			return View::make('users.dashboard.allfaqs')
				->with('faqs',$faqs)
				->with('label', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show add filtered list of faqs
	 *
	 * @return mixed
	 */
	public function postAllfaqs(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5)))
		{
			$faqs = DB::table('faqs');

			if(strlen(Input::get('label')) > 0)
				$faqs->where('label','like', "%".Input::get('label')."%");
				
			$faqs = $faqs->paginate(16);
			
			return View::make('users.dashboard.allfaqs')
				->with('faqs',$faqs)
				->with('label', Input::get('label'));
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * deletefaq
	 *
	 * @return mixed
	 */
	public function getDeletefaq(){
		$faq_id = Request::segment(3);
		$faq = Faq::find($faq_id);
		$faq->delete();
		Cache::flush();
		return Redirect::to('admin/allfaqs')->with('message','FAQ deleted successfully.');
	}
	
	/**
	 * Show faq for edit
	 *
	 * @return mixed
	 */
	public function getEditfaq(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5)))
		{
			$faq_id = Request::segment(3);
			$faq = Faq::find($faq_id);
			return View::make('users.dashboard.editfaq')
				->with('faq',$faq);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Save edited faq
	 *
	 * @return mixed
	 */
	public function postEditfaq(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5)))
		{
			$validator = Validator::make(Input::all(), Faq::$rules);
			if ($validator->passes()) {
				$faq = new Faq;
				$faq = Faq::find(Request::segment(3));
				$faq->label = trim(Input::get('label'));
				$temp = Input::get('question');
				$faq->question = trim(strip_tags($temp));
				$faq->active = Input::get('active');
				$faq->answer = trim(Input::get('answer'));
				$faq->save();
				return Redirect::to('/admin/allfaqs')->with('message','FAQ saved successfully');
			} else {
				return Redirect::to('admin/editfaq')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	/*********** Misconception Methods ****************/
	
	
	/**
	 * Show add misconception
	 *
	 * @return mixed
	 */
	public function getAddmisconception(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10))) {
			return View::make('users.dashboard.createmisconception');
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Create misconception
	 *
	 * @return mixed
	 */
	public function postAddmisconception() {
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10))) {
			$validator = Validator::make(Input::all(), Misconception::$rules);
			if ($validator->passes()) {
				$misconception = new Misconception;
				$misconception->label = trim(Input::get('label'));
				$temp = Input::get('question');
				$misconception->question = trim(strip_tags($temp));
				$misconception->active = Input::get('active');
				$misconception->answer = trim(Input::get('answer'));
				$misconception->save();
				return Redirect::to('/admin/allmisconceptions')->with('message','Item saved successfully');
			} else {
				return Redirect::to('admin/addmisconception')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show all misconceptions
	 *
	 * @return mixed
	 */
	public function getAllmisconceptions(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10)))
		{
			
			$misconceptions = Misconception::where('active', '=', '1')->orderby('label')->paginate(16);
			return View::make('users.dashboard.allmisconceptions')
				->with('misconceptions',$misconceptions)
				->with('label', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show add filtered list of misconception
	 *
	 * @return mixed
	 */
	public function postAllmisconceptions(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10)))
		{
			$misconceptions = DB::table('misconceptions');

			if(strlen(Input::get('label')) > 0)
				$misconceptions->where('label','like', "%".Input::get('label')."%");
				
			$misconceptions = $misconceptions->paginate(16);
			
			return View::make('users.dashboard.allmisconceptions')
				->with('misconceptions',$misconceptions)
				->with('label', Input::get('label'));
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * deletemisconception
	 *
	 * @return mixed
	 */
	public function getDeletemisconception(){
		$misconception_id = Request::segment(3);
		$misconception = Misconception::find($misconception_id);
		$misconception->delete();
		Cache::flush();
		return Redirect::to('admin/allmisconceptions')->with('message','Item deleted successfully.');
	}
	
	/**
	 * Show misconception for edit
	 *
	 * @return mixed
	 */
	public function getEditmisconception(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10)))
		{
			$misconception_id = Request::segment(3);
			$misconception = Misconception::find($misconception_id);
			return View::make('users.dashboard.editmisconception')
				->with('misconception',$misconception);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Save edited misconcpetion
	 *
	 * @return mixed
	 */
	public function postEditmisconception(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(10)))
		{
			$validator = Validator::make(Input::all(), Misconception::$rules);
			if ($validator->passes()) {
				$misconception = new Misconception;
				$misconception = Misconception::find(Request::segment(3));
				$misconception->label = trim(Input::get('label'));
				$temp = Input::get('question');
				$misconception->question = trim(strip_tags($temp));
				$misconception->active = Input::get('active');
				$misconception->answer = trim(Input::get('answer'));
				$misconception->save();
				return Redirect::to('/admin/allmisconceptions')->with('message','Item saved successfully');
			} else {
				return Redirect::to('admin/editmisconception')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	
	/*********** News item Methods ****************/
	
	
	/**
	 * Show add news
	 *
	 * @return mixed
	 */
	public function getAddnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2))) {
			return View::make('users.dashboard.createnews');
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Handle add news
	 *
	 * @return mixed
	 */
	public function postAddnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2))) {
			$validator = Validator::make(Input::all(), Post::$rules);
			if ($validator->passes()) {
				$post = new Post;
				$post->title = trim(Input::get('title'));
				$post->status = Input::get('status');
				$post->published_date = Input::get('post_date'). " 00:00:01";
				$post->content = Input::get('content');
				$post->summary = Input::get('summary');
				$post->meta_description = Input::get('meta_description');
				$post->meta_keywords = Input::get('meta_keywords');
				$post->in_rss = 1;
				$post->slug = trim(urlencode(Input::get('title')));
				$post->save();
				Cache::flush();
				return Redirect::to('/admin/allnews')->with('message','News item saved successfully');
			} else {
				return Redirect::to('admin/addnews')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show news for edit
	 *
	 * @return mixed
	 */
	public function getEditnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2)))
		{
			$news_id = Request::segment(3);
			$news = Post::find($news_id);
			return View::make('users.dashboard.editnews')
				->with('news',$news);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Save edited news
	 *
	 * @return mixed
	 */
	public function postEditnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2)))
		{

			$post = new Post;
			$post = Post::find(Request::segment(3));
			$post->title = trim(Input::get('title'));
			//$post->slug = trim(urlencode(Input::get('title')));
			$post->slug = Str::slug(Input::get('title'));
			$post->status = Input::get('status');
			$post->published_date = Input::get('post_date'). " 00:00:01";
			$post->content = Input::get('content');
			$post->status = Input::get('status');
			$post->save();
			Cache::flush();
			return Redirect::to('/admin/allnews')->with('message','News item saved successfully');

		}
	}
	
	
	/**
	 * Show news items
	 *
	 * @return mixed
	 */
	public function getAllnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2)))
		{
			
			$news = Post::orderby('published_date','title','desc')->paginate(16);
			return View::make('users.dashboard.allnews')
				->with('newsitems',$news)
				->with('title', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show add filtered list of news items
	 *
	 * @return mixed
	 */
	public function postAllnews(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(2)))
		{
			$news = DB::table('blog_posts');

			if(strlen(Input::get('title')) > 0)
				$news->where('title','like', "%".Input::get('title') ."%");
				
			$news = $news->paginate(16);
			
			return View::make('users.dashboard.allnews')
				->with('newsitems',$news)
				->with('title', Input::get('title'));
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/*********** Minutes Methods ****************/
	
	/**
	 * Show add CCELC minutes
	 *
	 * @return mixed
	 */
	public function getAddminutes() {
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
			return View::make('users.dashboard.addminutes');
	}
	
	
	/**
	 * Handle adding minutes
	 *
	 * @return mixed
	 */
	public function postAddminutes()
	{
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
		{
			// get the file
			$file = Input::file('pdf');
			$destinationPath = base_path() . '/public/pdf/minutes/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pdf')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// create a new minutes record and save the data
				$submission = new Minute;
				$submission->pdf = $filename;
				$submission->title = Input::get('title');
				$submission->post_date = Input::get('post_date');
				$submission->year = date('Y',strtotime(Input::get('post_date')));
				$submission->active = 1;
				$submission->save();
				return Redirect::to('admin/addminutes')->with('message','PDF uploaded successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your upload!');
			}
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Delete minute
	 *
	 * @return mixed
	 */
	public function getDeleteminutes(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
		{
			$minute = Minute::find(Request::segment(3));
			$minute->delete();
			return Redirect::to('/admin/allminutes')->with('message','Item deleted successfully.');
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Show minutes items
	 *
	 * @return mixed
	 */
	public function getAllminutes(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
		{
			
			$minutes = Minute::orderby('post_date','title','desc')->paginate(16);
			return View::make('users.dashboard.allminutes')
				->with('minutes',$minutes)
				->with('title', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show add filtered list of minutes items
	 *
	 * @return mixed
	 */
	public function postAllminutes(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
		{
			$minutes = DB::table('minutes');

			if(strlen(Input::get('title')) > 0)
				$minutes->where('title','like', "%".Input::get('title') ."%");
				
			$minutes = $minutes->paginate(16);
			
			return View::make('users.dashboard.allminutes')
				->with('minutes',$minutes)
				->with('title', Input::get('title'));
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show minutes for edit
	 *
	 * @return mixed
	 */
	public function getEditminute(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(8)))
		{
			$minute_id = Request::segment(3);
			$minute = Minute::find($minute_id);
			return View::make('users.dashboard.editminute')
				->with('minute',$minute);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Process edit minutes file
	 *
	 * @return mixed
	 */
	public function postEditminute()
	{
		$minute_id = Request::segment(3);
		$submission = Minute::find($minute_id);
		
		// check to see if there was a file in the upload
		if (Input::hasFile('pdf'))
		{
		    // get the file
			$file = Input::file('pdf');
			$filesize = Input::file('pdf')->getSize();
			$filesize = $filesize / 1000000;
			$destinationPath = base_path() . '/public/pdf/minutes/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pdf')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// csave the data
				$submission->pdf = $filename;
				$submission->title = Input::get('title');
				$submission->post_date = Input::get('post_date');
				$submission->filesize = $filesize;
				$submission->active = 1;
				$submission->save();
				return Redirect::to('admin/allminutes')->with('message','Item updated successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// no file -- just changing name or something
			$submission->title = Input::get('title');
			$submission->post_date = Input::get('post_date');
			$submission->active = 1;
			$submission->save();
			return Redirect::to('admin/allminutes')->with('message','Item updated successfully');
		}
		
	}
	
	
	/*********** Splash Methods ****************/
	
	/**
	 * Show splash image/text page
	 *
	 * @return mixed
	 */
	public function getSplash()
	{
		$splash = Splash::find(1);
		return View::make('users.dashboard.splash')
			->with('splash', $splash);
	}
	
	
	/**
	 * Save uploaded image/text file
	 *
	 * @return mixed
	 */
	public function postSplash()
	{
		// get the file
		$file = Input::file('img');
		$destinationPath = base_path() . '/public/img/';
		$filename = str_random(10) . "_" . $file->getClientOriginalName();
		
		$upload_success = Input::file('img')->move($destinationPath, $filename);
		
		if ($upload_success) {
			// get file contents
			$content = file_get_contents($destinationPath.$filename);
			
			// save the data
			$submission = Splash::find(1);
			$submission->image = "/img/".$filename;
			$submission->text = Input::get('text');
			$submission->save();
			return Redirect::to('admin/splash')->with('message','Image/text uploaded successfully');
			
		} else {
			return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
		}
	}
	
	
	/*********** Gallery Methods ****************/
	
	/**
	 * Show upload image page
	 *
	 * @return mixed
	 */
	public function getGalleryupload()
	{
		return View::make('users.dashboard.gallery_upload');
	}
	
	
	/**
	 * Save uploaded image file
	 *
	 * @return mixed
	 */
	public function postGalleryupload()
	{
		// get the file
		$file = Input::file('img');
		$destinationPath = base_path() . '/public/img/gallery/';
		$filename = str_random(10) . "_" . $file->getClientOriginalName();
		
		$upload_success = Input::file('img')->move($destinationPath, $filename);
		
		if ($upload_success) {
			// get file contents
			$content = file_get_contents($destinationPath.$filename);
			
			// create a new gallery record and save the data
			$submission = new GalleryImage;
			$submission->img = $filename;
			$submission->label = Input::get('label');
			$submission->category = Input::get('category');
			$submission->active = 1;
			$submission->save();
			return Redirect::to('admin/allgalleryimages')->with('message','Image uploaded successfully');
			
		} else {
			return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
		}
	}
	
	
	/**
	 * Show all images
	 *
	 * @return mixed
	 */
	public function getAllgalleryimages() {
		if (Auth::user()->access_level == 3)
		{
			$images = GalleryImage::where('active', '=', '1')->orderby('label')->paginate(16);
			return View::make('users.dashboard.allimages')
				->with('images',$images)
				->with('label', '');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all images
	 *
	 * @return mixed
	 */
	public function postAllgalleryimages() {
		if (Auth::user()->access_level == 3)
		{
			$images = DB::table('gallery_images');
			
			if(strlen(Input::get('label')) > 0)
				$images->where('label','like', "%".Input::get('label')."%");
				
			$images = $images->paginate(16);
			
			return View::make('users.dashboard.allimages')
				->with('images',$images)
				->with('label', Input::get('label'));
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Delete an image
	 *
	 * @return mixed
	 */
	public function getDeletegalleryimage(){
		$image_id = Request::segment(3);
		$myimage = GalleryImage::find($image_id);
		$myimage->delete();
		return Redirect::to('admin/allgalleryimages')->with('message','Image deleted successfully.');
	}
	
	
	/**
	 * show image for edit
	 *
	 * @return mixed
	 */
	public function getEditimage(){
		$image_id = Request::segment(3);
		$image = new GalleryImage;
		$image = GalleryImage::find(Request::segment(3));
		return View::make('users.dashboard.gallery_edit')->with('image',$image);
	}
	
	
	/**
	 * Process edit image file
	 *
	 * @return mixed
	 */
	public function postEditimage()
	{
		$image_id = Request::segment(3);
		$submission = GalleryImage::find($image_id);
		
		// check to see if there was a file in the upload
		if (Input::hasFile('img'))
		{
		    // get the file
			$file = Input::file('img');
			$destinationPath = base_path() . '/public/img/gallery/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('img')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// csave the data
				$submission->img = $filename;
				$submission->label = Input::get('label');
				$submission->category = Input::get('category');
				$submission->active = 1;
				$submission->save();
				return Redirect::to('admin/allgalleryimages')->with('message','Image updated successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// no file -- just changing name or category
			$submission->label = Input::get('label');
			$submission->category = Input::get('category');
			$submission->active = 1;
			$submission->save();
			return Redirect::to('admin/allgalleryimages')->with('message','Image updated successfully');
		}
		
	}
	
	/*********** Newsletter methods *************/
	
	/**
	 * Show add newsletter form 
	 *
	 * @return mixed
	 */
	public function getAddnewsletter(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(9)))
		{
			return View::make('users.dashboard.createnewsletter');
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Handle adding newsletters
	 *
	 * @return mixed
	 */
	public function postAddnewsletter()
	{
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(9)))
		{
			// get the file
			$file = Input::file('pdf');
			$filesize = Input::file('pdf')->getSize();
			//Log::info('size is ' . $filesize);
			$filesize = $filesize / 1000000;
			$destinationPath = base_path() . '/public/pdf/newsletters/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pdf')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// create a new minutes record and save the data
				$submission = new Newsletter;
				$submission->pdf = $filename;
				$submission->title = Input::get('title');
				$submission->post_date = Input::get('post_date');
				$submission->year = date('Y',strtotime(Input::get('post_date')));
				$submission->active = 1;
				$submission->filesize = $filesize;
				$submission->save();
				return Redirect::to('admin/addnewsletter')->with('message','PDF uploaded successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your upload!');
			}
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show all newsletters
	 *
	 * @return mixed
	 */
	public function getAllnewsletters() {
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(9)))
		{
			$newsletters = Newsletter::orderby('post_date')->paginate(15);
			return View::make('users.dashboard.allnewsletters')
				->with('newsletters',$newsletters)
				->with('title', '');
		} else {
	
			return View::make('users.dashboard.dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all newsletters
	 *
	 * @return mixed
	 */
	public function postAllnewsletters() {
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(9)))
		{
			$newsletters = DB::table('newsletters');
			
			if(strlen(Input::get('title')) > 0)
				$newsletters->where('title','like', "%".Input::get('title')."%");
				
			$newsletters = $newsletters->paginate(25);
			
			return View::make('users.dashboard.allnewsletters')
				->with('newsletters',$newsletters)
				->with('title', Input::get('title'));
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show newsletter for edit
	 *
	 * @return mixed
	 */
	public function getEditnewsletter(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(9)))
		{
			$newsletter_id = Request::segment(3);
			$newsletter = Newsletter::find($newsletter_id);
			return View::make('users.dashboard.editnewsletter')
				->with('newsletter',$newsletter);
		} else {
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Process edit newsletter file
	 *
	 * @return mixed
	 */
	public function postEditnewsletter()
	{
		$newsletter_id = Request::segment(3);
		$submission = Newsletter::find($newsletter_id);
		
		// check to see if there was a file in the upload
		if (Input::hasFile('pdf'))
		{
		    // get the file
			$file = Input::file('pdf');
			$filesize = Input::file('pdf')->getSize();
			$filesize = $filesize / 1000000;
			$destinationPath = base_path() . '/public/pdf/newsletters/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pdf')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// csave the data
				$submission->pdf = $filename;
				$submission->title = Input::get('title');
				$submission->post_date = Input::get('post_date');
				$submission->year = date('Y',strtotime(Input::get('post_date')));
				$submission->filesize = $filesize;
				$submission->active = 1;
				$submission->save();
				return Redirect::to('admin/allnewsletters')->with('message','Newsletter updated successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// no file -- just changing name or something
			$submission->title = Input::get('title');
			$submission->post_date = Input::get('post_date');
			$submission->year = date('Y',strtotime(Input::get('post_date')));
			$submission->active = 1;
			$submission->save();
			return Redirect::to('admin/allnewsletters')->with('message','Newsletter updated successfully');
		}
		
	}
	
	
	/**
	 * Delete a newsletter
	 *
	 * @return mixed
	 */
	public function getDeletenewsletter(){
		$newsletter_id = Request::segment(3);
		$newsletter = Newsletter::find($newsletter_id);
		$newsletter->delete();
		return Redirect::to('admin/allnewsletters')->with('message','Item deleted successfully.');
	}
	
	
	/**
	 * Save edits to fragment (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function postSavefragment(){
		if (Auth::user()->access_level == 3){
			$fragment = Fragment::find(Input::get('fid'));
			$fragment->fragment_content = trim(Input::get('thedata'));
			$fragment->fragment_title = trim(Input::get('thetitle'));
			$fragment->save();
			Cache::flush();
			return "Page updated successfully";
		}
	}
}