<?php

class UsersPending extends Eloquent {

	protected $guarded = array('*');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_pending';

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