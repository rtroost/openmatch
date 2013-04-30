<?php

class News_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct() {
		parent::__construct();
	}

	public function get_index() {
		return View::make('news.index');
	}

	public function get_show($id) {

	}

	public function get_new(){

	}

	public function post_create(){

	}

	public function get_edit($id){

	}

	public function put_update(){

	}

	public function delete_destroy($id){

	}

}
