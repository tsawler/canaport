<?php

class Faq extends Eloquent {

	public static $rules = array(
	   'label'=>'required|min:2',
	   'question'=>'required',
	   'answer'=>'required'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'faqs';

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