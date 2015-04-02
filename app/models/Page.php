<?php

class Page extends Eloquent {

	protected $guarded = array('*');
	
	public static $rules = array(
	   'page_title'=>'min:2|unique:pages',
	   'page_name'=>'unique:pages'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

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