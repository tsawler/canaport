<?php

class MailRecipient extends Eloquent {

	public static $rules = array(
	   'email'=>'required|email|unique:mail_recipients'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mail_recipients';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}