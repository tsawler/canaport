<?php

class MenuItem extends Eloquent {
	
	public static $rules = array(
	   'menu_text'=>'required|min:2'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_items';

	/**
	 * Get the unique identifier for the menu item.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	public function dropdownItems()
    {
        return $this->hasMany('MenuDropdownItem')->orderBy('sort_order');;
    }
    
    /**
	 * Get info from pages table for the record.
	 *
	 * @return mixed
	 */
    public function targetPage()
    {
	    return $this->hasOne('Page', 'id', 'page_id');
    }
}