<?php

class Events_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct() {
		parent::__construct();
	}

	public function get_index() {
		return View::make('events.index');
	}

	public function get_show($event_id) {

	}

	public function get_new(){

	}

	public function post_create(){

	}

	public function get_edit($index){

	}

	public function put_update($index){

	}

	public function delete_destroy($index){

	}

}
