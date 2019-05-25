<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

register_deactivation_hook( __FILE__, 'custom_spinrewriter_tool_plugin_remove') ;
function custom_spinrewriter_tool_plugin_remove(){
	//
}