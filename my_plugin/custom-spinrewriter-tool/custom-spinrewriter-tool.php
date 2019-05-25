<?php
/*
* Plugin Name: Custom Spinrewriter Tool
* Author: Clag Dev Gaurav Sharma
* Text Domain: cus-spin-tool
* Description: This is the Custom Spinrewriter Tool plugin.
* Version: 1.0.0
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CUSSPINTOOL_VERSION', '1.0.0' );
define( 'CUSSPINTOOL_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'CUSSPINTOOL_DIR_PATH', plugin_dir_path( __FILE__ ) );



// Include the main CustomSpinToolFront class.
if ( ! class_exists( 'CustomSpinToolFront' ) ) {
	include_once dirname( __FILE__ ) . '/classes/class-spinrewriter-tool-front.php';
}


// Include the main CustomSpinTool class.
if ( ! class_exists( 'CustomSpinTool' ) ) {
	include_once dirname( __FILE__ ) . '/classes/class-spinrewriter-tool.php';
}

/*include_once 'ins/custom-spinrewriter-tool-activate.php';
include_once 'inc/custom-spinrewriter-tool-deactivate.php';
include_once 'inc/custom-spin-backend-backend-option.php';*/

register_activation_hook( __FILE__ , 'custom_spinrewriter_tool_plugin_install');
function custom_spinrewriter_tool_plugin_install(){

	if (empty(get_option("spinrewriter_email"))) { echo "string";
		update_option("spinrewriter_email", "ppppexample@gmail.com");
	}
	if (empty(get_option("spinrewriter_api_key"))) {
		update_option("spinrewriter_api_key", "");
	}

	if (empty(get_option("auto_protected_terms"))) {
		update_option("auto_protected_terms", 1);
	}

	if (empty(get_option("confidence_level"))) {
		update_option("confidence_level", 1);
	}

	if (empty(get_option("auto_sentences"))) {
		update_option("auto_sentences", 1);
	}

	if (empty(get_option("auto_paragraphs"))) {
		update_option("auto_paragraphs", 1);
	}

	if (empty(get_option("auto_new_paragraphs"))) {
		update_option("auto_new_paragraphs", 1);
	}

	if (empty(get_option("auto_protected_terms"))) {
		update_option("auto_protected_terms", 1);
	}

	if (empty(get_option("auto_sentence_trees"))) {
		update_option("auto_sentence_trees", 1);
	}

	if (empty(get_option("use_only_synonyms"))) {
		update_option("use_only_synonyms", 1);
	}

	if (empty(get_option("reorder_paragraphs"))) {
		update_option("reorder_paragraphs", 1);
	}

	if (empty(get_option("nested_spintax"))) {
		update_option("nested_spintax", 1);
	}
}
