<?php

class CalendarEventController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only'=>array('showUser')));
		$this->beforeFilter('auth', array('only'=>array('showAddEvent')));
		$this->beforeFilter('auth', array('only'=>array('editEvent')));
		$this->beforeFilter('auth', array('only'=>array('handleAddEvent')));
		$this->beforeFilter('auth', array('only'=>array('handleEditEvent')));
		$this->beforeFilter('auth', array('only'=>array('allEvents')));
		$this->beforeFilter('auth', array('only'=>array('postAllEvents')));
		$this->beforeFilter('auth', array('only'=>array('handleDelete')));
	}
	
	/**
	 * Show faq page
	 *
	 * @return mixed
	 */
	public function showEvents()
	{
		$events = CalendarEvent::where('active', '=', '1')->orderby('post_date','desc')->get();
		return View::make('pages.events')->with('events',$events);
	}
	
	
	/**
	 * Show upload image page
	 *
	 * @return mixed
	 */
	public function showAddEvent()
	{
		return View::make('users.dashboard.event_add');
	}
	
	/**
	 * Save uploaded image file
	 *
	 * @return mixed
	 */
	public function handleAddEvent()
	{
		// get the file
		$file = Input::file('pic');
		$destinationPath = base_path() . '/public/img/events/';
		$filename = str_random(10) . "_" . $file->getClientOriginalName();
		
		$upload_success = Input::file('pic')->move($destinationPath, $filename);
		
		if ($upload_success) {
			// get file contents
			$content = file_get_contents($destinationPath.$filename);
			
			// create a new gallery record and save the data
			$submission = new CalendarEvent;
			$submission->pic = $filename;
			$submission->title = Input::get('title');
			$submission->post_date = Input::get('post_date');
			$submission->description = Input::get('description');
			$submission->year = date("Y",strtotime(Input::get('post_date')));
			$submission->month = date("m",strtotime(Input::get('post_date')));
			$submission->active = 1;
			$submission->save();
			return Redirect::to('calendar/allevents')->with('message','Event saved successfully');
			
		} else {
			return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
		}
	}
	
	
	/**
	 * show Event for edit
	 *
	 * @return mixed
	 */
	public function editEvent(){
		$event_id = Request::segment(3);
		$event = new CalendarEvent;
		$event = CalendarEvent::find(Request::segment(3));
		return View::make('users.dashboard.event_edit')->with('event',$event);
	}
	
	/**
	 * Edit event
	 *
	 * @return mixed
	 */
	public function handleEditEvent()
	{
		$event_id = Request::segment(3);
		$submission = CalendarEvent::find($event_id);
		
		// check to see if there was a file in the upload
		if (Input::hasFile('pic'))
		{
		    // get the file
			$file = Input::file('pic');
			$destinationPath = base_path() . '/public/img/events/';
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('pic')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// csave the data
				$submission->pic = $filename;
				$submission->title = Input::get('title');
				$submission->description = Input::get('description');
				$submission->active = 1;
				$submission->post_date = Input::get('post_date');
				$submission->year = date("Y",strtotime(Input::get('post_date')));
				$submission->month = date("m",strtotime(Input::get('post_date')));
				$submission->save();
				return Redirect::to('calendar/allevents')->with('message','Event updated successfully');
				
			} else {
				return Redirect::to('users/dashboard')->with('message', 'There was an error with your submission!');
			}
		} else {
			// no file -- just changing text/date/whatever
			$submission->title = Input::get('title');
			$submission->description = Input::get('description');
			$submission->active = 1;
			$submission->post_date = Input::get('post_date');
			$submission->year = date("Y",strtotime(Input::get('post_date')));
			$submission->month = date("m",strtotime(Input::get('post_date')));
			$submission->save();
			return Redirect::to('calendar/allevents')->with('message','Event updated successfully');
		}
		
	}
	
	
	/**
	 * Show all events for edit (list)
	 *
	 * @return mixed
	 */
	public function allEvents() {
		if (Auth::user()->access_level == 3)
		{
			$events = new CalendarEvent;
			$events = CalendarEvent::where('active', '=', '1')->orderby('post_date','desc')->paginate(25);
			return View::make('users.dashboard.allevents')
				->with('events',$events)
				->with('title','');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Show filtered list of all users
	 *
	 * @return mixed
	 */
	public function postAllEvents() {
	
		if (Auth::user()->access_level == 3)
		{
			$allevents = DB::table('calendar_events');

			if(strlen(Input::get('title')) > 0)
				$allevents->where('title','like', Input::get('title') . "%");
			
			$allevents = $allevents->paginate(25);
			
			return View::make('users.dashboard.allevents')
				->with('events',$allevents)
				->with('title',Input::get('title'));
		} else {
	
			return View::make('users.dashboard.dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Delete an event
	 *
	 * @return mixed
	 */
	public function handleDelete(){
		$event_id = Request::segment(3);
		$myevent = CalendarEvent::find($event_id);
		$myevent->delete();
		return Redirect::to('calendar/allevents')->with('message','Event deleted successfully.');
	}
}