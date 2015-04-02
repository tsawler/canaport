<?php

class EmailConsentController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getShowform()
	{
		return View::make('pages.confirm-email');
	}
	
	
	public function postShowform(){
		    
	    // build email
		$user = array(
			'email'=>Input::get('email'),
			'first_name'=>Input::get('first-name'),
			'last_name'=>Input::get('last-name'),
		);

		// the data that will be passed into the mail view blade template
		$data = array(
			'first_name'  => $user['first_name'],
			'last_name' => $user['last_name'],
			'email'=>Input::get('email')
		);
		
		$list = new MailingList;
		$list->first_name = $user['first_name'];
		$list->last_name = $user['last_name'];
		$list->email = $user['email'];
		$list->save();
		
		// use Mail::send function to send email passing the data and using the $user variable in the closure
		Mail::send('emails.consent_email', $data, function($message) use ($user) {
				$message->from('donotreply@canaportlng.com', 'Do not reply');
				$message->to(Config::get('app.contact_email'))->subject('Email consent received');
		});
		
		$list = new MailingList;
		$list->first_name = $user['first_name'];
		$list->last_name = $user['last_name'];
		$list->email = $user['email'];
		$list->save();
		
	
		return Redirect::to('/Thanks-consent');
	}
}