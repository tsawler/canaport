<?php
class UsersPendingController extends BaseController {

	/**
	 * validate user using token sent through email
	 *
	 * @return null
	 */
	function validateUser(){
		$user_id = 0;
		$email = "";
		$key_id = 0;
	
		$user_key = DB::table('users_pending')
	                     ->select(DB::raw('*'))
	                     ->where('join_token', 'like', Input::get('key').'%')
	                     ->get();
	    
		foreach ($user_key as $key)
		{
	    	$email = $key->email;
	    	$key_id = $key->id;
		}
		
		if (strlen($email) > 0){
			$users = DB::table('users')
	                     ->select(DB::raw('*'))
	                     ->where('email', 'like', $email.'%')
	                     ->get();
			foreach ($users as $user)
			{
				$user_id= $user->id;
			}
		}
		
		if ($user_id > 0){
			// mark account as active
			$user = User::find($user_id);
			$user->user_active = 1;
			$user->save();
			// delete pending user
			$key = UsersPending::find($key_id);
			$key->delete();
			return Redirect::to('success');
		} else {
			return Redirect::to('not+found');
		}
	}
}