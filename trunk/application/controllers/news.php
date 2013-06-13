<?php

class News_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct() {
		parent::__construct();
	}

	public function get_index() {

		$articles = Article::get_all_published();

		return View::make('news.index')
			-> with('articles', $articles);
	}

	public function get_show($id) {

		$article = Article::where('id', '=', $id) -> where('published', '=', 1) -> first();

		return View::make('news.show')
			-> with('article', $article);
	}

	public function get_new(){
		return View::make('news.new');
	}

	public function post_create(){

		$validation = Article::validate(Input::all());

		if($validation -> fails()) {

			return Redirect::to_route('news_create')
				-> with_input()
				-> with_errors($validation);

		} else {

			$article = Article::create(array(
				'user_id' => Auth::user() -> id,
				'title' => Input::get('title'),
				'body' => Input::get('message'),
				'published' => Input::get('publish'),
			));

			if(Input::get('publish'))
				return Redirect::to_route('news_show', $article -> id);
			else
				return Redirect::to_route('news_manage');
		}
	}

	public function get_edit($id){

		$article = Article::find($id);

		return View::make('news.edit')
			-> with('article', $article);

	}

	public function put_update(){

		$validation = Article::validate(Input::all());

		$article = Article::find(Input::get('article_id'));

		if($validation -> fails()) {

			return Redirect::to_route('news_edit', $article -> id)
				-> with_input()
				-> with_errors($validation);

		} else {

			$article = Article::update($article -> id, array(
				'user_id' => Auth::user() -> id,
				'title' => Input::get('title'),
				'body' => Input::get('message'),
				'published' => Input::get('publish'),
			));

			if(Input::get('publish') == 1)
				return Redirect::to_route('news_show', $article -> id);
			else
				return Redirect::to_route('news_manage');
		}

	}

	public function delete_destroy($id){

	}

	public function get_manage() {

		$articles = Article::paginate(10);

		return View::make('news.manage')
			-> with('articles', $articles);
	}

}
