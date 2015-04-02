<?php

class MenuDropdownItem extends Eloquent {

	public static $rules = array(
	   'menu_text'=>'required|min:2'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_dropdown_items';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	/**
	 * Get info from pages table for a record.
	 *
	 * @return mixed
	 */
	public function targetPage()
    {
	    return $this->hasOne('Page', 'id', 'page_id');
    }
}