<?php

class BasicBackEnd {

	public $plugin_path;
	public $plugin_url;
	public $plugin_file;
	
	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url  = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin_file = plugin_basename( dirname( __FILE__, 3 ) );
	}

}

