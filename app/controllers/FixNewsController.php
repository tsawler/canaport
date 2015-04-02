<?php

class FixNewsController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public function fix()
	{
		$news = Post::all();
		foreach ($news as $n){
			$item = Post::find($n->id);
			$item->slug = Str::slug($item->title);
			$item->save();
		}
		return ("done");
	}
}