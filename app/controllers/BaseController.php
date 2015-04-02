<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			// get menu list
			//$menu_items = MenuItem::where('menu_id','=','1')->get();
			//$this->layout = View::make($this->layout)->with('menu_items',$menu_items);
			$this->layout = View::make($this->layout);
		}
	}

}