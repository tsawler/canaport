<?php

class Newsletter extends Eloquent {

	public static $rules = array(
	   'title'=>'required|min:2',
	   'pdf'=>'required',
	   'post_date'=>'required'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'newsletters';

	/**
	 * Get the unique identifier for the menu item.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}