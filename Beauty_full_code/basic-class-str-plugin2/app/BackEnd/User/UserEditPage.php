<?php

/**
 * 
 */
class UserEditPage 
{
	function __construct(){
		
		$this->$obj = new UserEditPageFun();
		
		add_action( 'show_user_profile', array($this->$obj, 'crf_show_extra_profile_fields2'), 10);

		add_action( 'edit_user_profile', array($this->$obj, 'crf_show_extra_profile_fields2'), 10);

		add_action('admin_menu', array($this->$obj, 'basicpluginstr_admin_menu_function'), 10);

	}
}