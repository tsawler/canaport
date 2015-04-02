<?php

class MisconceptionsController extends BaseController {

	public function __construct() {

	}
	
	/**
	 * Show faq page
	 *
	 * @return mixed
	 */
	public function showMisconceptionsPage()
	{
		$misconceptions = Misconception::where('active', '=', '1')->orderby('id')->get();
		$fragment = Fragment::find(13);
		return View::make('pages.misconceptions')->with('misconceptions',$misconceptions)->with('fragment', $fragment);
	}
	
	public function editFaq(){
			if (Auth::user()->access_level == 3){
				$id = Input::get('misconception_id');
				$misconception = Misconception::find($id);
				
				$misconception->label = trim(Input::get('thelabeldata_'.$id));
				$misconception->question = trim(Input::get('thequestiondata_'.$id));
				$misconception->answer = trim(Input::get('theanswerdata_'.$id));
				$misconception->save();
				Cache::flush();
				return "Item updated successfully";
		}
	}
}