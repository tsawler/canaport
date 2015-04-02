<?php

class InvolvementController extends BaseController {

	public function __construct() {

	}
	
	/**
	 * Show faq page
	 *
	 * @return mixed
	 */
	public function showPage()
	{
		$cis = Involvement::where('active', '=', '1')->orderby('date_posted','desc')->get();
		$fragment = Fragment::find(6);
		return View::make('pages.involvement')->with('cis',$cis)->with('fragment',$fragment);
	}
	
	public function editInvolvement(){
			if (Auth::user()->access_level == 3){
				$id = Input::get('id');
				$ci = Involvement::find($id);
				
				$ci->label = trim(Input::get('thelabeldata_'.$id));
				$ci->content = trim(Input::get('thecontentdata_'.$id));
				$ci->save();
				Cache::flush();
				return "Item updated successfully";
		}
	}
}