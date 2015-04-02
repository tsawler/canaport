<?php

class MenuController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array('only'=>array('getMenujson')));
		$this->beforeFilter('auth', array('only'=>array('getDdmenujson')));
		$this->beforeFilter('auth', array('only'=>array('postSavemenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postSaveddmenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postDeleteddmenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postDeletemenuitem')));
		$this->beforeFilter('auth', array('only'=>array('getDdsortitems')));
	}

	protected $layout = "layout";

	
	/**
	 * Get menu for edit (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function getMenujson(){
		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('id');
			$menu_item = MenuItem::find($menu_item_id);
			if ($menu_item->page_id == 0) 
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' => $menu_item->url,
					'has_children' => $menu_item->has_children
				);
			}
			else
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' =>'',
					'has_children' => $menu_item->has_children
				);
			}
			
			return Response::json($theResponse);
		}
	}
	
	/**
	 * Get dd menu for edit (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function getDdmenujson(){
		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('id');
			$menu_item = MenuDropdownItem::find($menu_item_id);
			if ($menu_item->page_id == 0) 
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' => $menu_item->url
				);
			}
			else
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' =>''
				);
			}
				
			return Response::json($theResponse);
		}
	}
	
	/**
	 * Save or create menu item
	 *
	 * @return void
	 */
	 public function postSavemenuitem(){
	 
	 	$validator = Validator::make(Input::all(), MenuItem::$rules);
			if ($validator->passes())
			{
				if (Auth::user()->access_level == 3){
					$menu_item_id = Input::get('menu_item_id');
					$menu_text = Input::get('menu_text');
					$menu_page_id = Input::get('menu_page_id');
					$menu_active = Input::get('menu_active');
					$menu_url = Input::get('menu_url');
					$has_children = Input::get('has_children');
					
					$menuItem = MenuItem::find($menu_item_id);
					
					if ($menuItem === null)
					{
						$so = MenuItem::where('menu_id', '=', '1')->max('sort_order');
						$menuItem = new MenuItem;
						$menuItem->sort_order = ($so + 1);
						$menuItem->menu_text = $menu_text;
						$menuItem->page_id = $menu_page_id;
						$menuItem->active = $menu_active;
						$menuItem->url = $menu_url;
						$menuItem->has_children = $has_children;
						$menuItem->menu_id = 1;
						$menuItem->save();
					}
					else
					{
						$menuItem->menu_text = $menu_text;
						$menuItem->page_id = $menu_page_id;
						$menuItem->active = $menu_active;
						$menuItem->has_children = $has_children;
						$menuItem->url = $menu_url;
						$menuItem->save();
						
						// handle sorting
						$sort = json_decode(Input::get('sortorder'));;
						
						foreach($sort as $name => $value){
							$menu = MenuItem::find($name);
							$menu->sort_order = $value;
							$menu->save();
						}
					}
					Cache::flush();
					return Redirect::to(URL::previous())
						->with('message', 'Changes saved.');
				}
			}
			else
			{
				return Redirect::to(URL::previous())
						->with('message', 'The following errors occurred')
						->withErrors($validator);
			}
	}
	
	/**
	 * Save or create dd menu item
	 *
	 * @return void
	 */
	 public function postSaveddmenuitem(){
	 	
	 	$validator = Validator::make(Input::all(), MenuDropdownItem::$rules);
			if ($validator->passes())
			{

				if (Auth::user()->access_level == 3){
					$menu_item_id = Input::get('menu_item_id');
					$menu_text = Input::get('menu_text');
					$menu_page_id = Input::get('menu_page_id');
					$menu_active = Input::get('menu_active');
					$menu_url = Input::get('menu_url');
					$menu_id = Input::get('parent_menu_item_id');
					
					$menuItem = MenuDropdownItem::where('id', '=', $menu_item_id)->first();
					
					if ($menuItem === null)
					{	
						$so = MenuDropdownItem::where('menu_item_id', '=', $menu_id)->max('sort_order');
						$menuItem = new MenuDropdownItem;
						$menuItem->menu_text = $menu_text;
						$menuItem->page_id = $menu_page_id;
						$menuItem->active = $menu_active;
						$menuItem->menu_item_id = $menu_id;
						$menuItem->url = $menu_url;
						$menuItem->sort_order = $so + 1;
						$menuItem->save();
					}
					else
					{
						$menuItem->menu_text = $menu_text;
						$menuItem->page_id = $menu_page_id;
						$menuItem->active = $menu_active;
						$menuItem->url = $menu_url;
						$menuItem->save();
						
						// handle sorting
						$sort = json_decode(Input::get('sortorder'));;
		
						foreach($sort as $name => $value){
							$menu = MenuDropdownItem::find($name);
							$menu->sort_order = $value;
							$menu->save();
						}
					}
					Cache::flush();
					return Redirect::to(URL::previous())
						->with('message', 'Changes saved.');
				}
			}
			else
			{
				return Redirect::to(URL::previous())
					->with('message', 'The following errors occurred')
					->withErrors($validator);
			}
	}
	
	/**
	 * Delete menu item
	 *
	 * @return mixed
	 */
	public function postDeletemenuitem(){
		if (Auth::user()->access_level == 3){
		// check to see if it has any children
		$children = MenuDropdownItem::where('menu_item_id', '=', Input::get('deleteid'))->count();
		
		if ($children == 0)
		{
			$menuItem = MenuItem::find(Input::get('deleteid'));
			$menuItem->delete();
			Cache::flush();
			return Redirect::to(URL::previous())
					->with('message', 'Changes saved.');
		}
		else
		{
			return Redirect::to(URL::previous())
					->with('error', 'You cannot delete a menu that still has items under it! Delete the items first.');
		}
		}
	}
	
	/**
	 * Delete submenu item
	 *
	 * @return mixed
	 */
	public function postDeleteddmenuitem(){
		if (Auth::user()->access_level == 3){
		$menuItem = MenuDropdownItem::find(Input::get('dddeleteid'));
		$menuItem->delete();
		Cache::flush();
		return Redirect::to(URL::previous())
				->with('message', 'Changes saved.');
		}
	}
	
	/**
	 * Return html for sortable dd menu list
	 *
	 * @return string
	 */
	public function getDdsortitems() {
		// create list of sortable top level menu items
		$menu_items = MenuDropdownItem::where('menu_item_id','=', Input::get('id'))->orderBy('sort_order', 'ASC')->get();
		
		$theHtml = '<ul class="sortable list" id="ddsortable">';
		
		foreach($menu_items as $item){
			$theHtml .= '<li data-id="'
				. $item->id
				. '">'
				. $item->menu_text
				. '</li>';
		}
		$theHtml .= '</ul>';
		//Log::info($theHtml);
		return $theHtml;
	}
	
	/**
	 * Return html for sortable menu list
	 *
	 * @return string
	 */
	public function getSortitems() {
		// create list of sortable top level menu items
		$menu_items = MenuItem::where('menu_id','=', '1')->orderBy('sort_order', 'ASC')->get();
		
		$theHtml = '<ul class="sortable list" id="sortable">';
		
		foreach($menu_items as $item){
			$theHtml .= '<li data-id="'
				. $item->id
				. '">'
				. $item->menu_text
				. '</li>';
		}
		$theHtml .= '</ul>';
		return $theHtml;
	}
}