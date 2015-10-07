<?php

class SearchController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	protected $layout = "layout";

	
	/**
	 * Show the search page
	 *
	 * @return mixed
	 */
	public function showSearchPage(){
		$searchterm = "";
		return View::make('pages.search')
			->with('searchterm',$searchterm);
	}

	/**
	 * Perform search
	 *
	 * @return mixed
	 */
	public function performSearch(){

		$searchterm = Input::get('searchterm');
								
		$results = DB::select("(select id as the_id, page_title as the_title, "
								. "concat(substring(strip_tags(page_content),1,500),'...') as the_content,  "
								. "concat('/',slug) as target "
								. "from pages WHERE MATCH (page_title,page_content) AGAINST (? IN BOOLEAN MODE))"
								. " union "
								. "(select id as the_id, `title` as the_title, "
								. "concat(substring(content,1,500),'...') as the_content, "
								. "concat('/news/',slug) as target " 
								. "from blog_posts WHERE MATCH (title,content) AGAINST (? IN BOOLEAN MODE))"
								. " union "
								. "(select id as the_id, `question` as the_title, "
								. "concat(substring(answer,1,500),'...') as the_content, "
								. "'/faq' as target " 
								. "from faqs WHERE MATCH (question,answer) AGAINST (? IN BOOLEAN MODE))"
								. " union "
								. "(select id as the_id, `label` as the_title, "
								. "concat(substring(content,1,500),'...') as the_content, "
								. "'/Community+Involvement' as target " 
								. "from involvements WHERE MATCH (label,content) AGAINST (? IN BOOLEAN MODE))"
								, array($searchterm, $searchterm, $searchterm, $searchterm));
		
		return View::make('pages.search')
			->with('searchterm',$searchterm)
			->with('results',$results);
	}
	
	/**
	 * Perform search only for blog
	 *
	 * @return mixed
	 */
	public function performBlogSearch(){
		
		$searchterm = Input::get('searchterm');
		
		$results = DB::select("select id as the_id, `title` as the_title, "
								. "concat(substring(strip_tags(content),1,500),'...') as the_content, "
								. "concat('/news/',slug) as target " 
								. "from blog_posts WHERE MATCH (title,content) AGAINST (? IN BOOLEAN MODE)"
								, array($searchterm));

		return View::make('pages.search')
			->with('searchterm',$searchterm)
			->with('results',$results);
	}
}