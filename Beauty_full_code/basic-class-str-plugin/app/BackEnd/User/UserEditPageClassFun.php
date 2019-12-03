<?php
namespace App\BackEnd\User;

class UserEditPageClassFun {

	function __construct(){  
		
		$this->plugin_dir_path = plugin_dir_path( dirname( __FILE__, 2 ) );
	}

	public function crf_show_extra_profile_fields2(){

		include_once $this->plugin_dir_path.'template/UserFields.php';
	}

	public function basicpluginstr_admin_menu_function(){

		add_menu_page( 'Basic Plugin', 'Basic Plugin', 'manage_options', 'basic-plugin', array($this, 'basic_plugin_function1'));

	}

	public function basic_plugin_function1(){
		echo "<h1> Basic Plugin Str1</h1>";
	}

}



