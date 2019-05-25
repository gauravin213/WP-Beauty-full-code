<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

register_activation_hook( __FILE__ , 'custom_spinrewriter_tool_plugin_install');
function custom_spinrewriter_tool_plugin_install(){
	

	if (empty(get_option("spinrewriter_email"))) {
		add_option("spinrewriter_email", "");
	}
	if (empty(get_option("spinrewriter_api_key"))) {
		add_option("spinrewriter_api_key", "");
	}

	if (empty(get_option("auto_protected_terms"))) {
		add_option("auto_protected_terms", 1);
	}

	if (empty(get_option("confidence_level"))) {
		add_option("confidence_level", 1);
	}

	if (empty(get_option("auto_sentences"))) {
		add_option("auto_sentences", 1);
	}

	if (empty(get_option("auto_paragraphs"))) {
		add_option("auto_paragraphs", 1);
	}

	if (empty(get_option("auto_new_paragraphs"))) {
		add_option("auto_new_paragraphs", 1);
	}

	if (empty(get_option("auto_protected_terms"))) {
		add_option("auto_protected_terms", 1);
	}

	if (empty(get_option("auto_sentence_trees"))) {
		add_option("auto_sentence_trees", 1);
	}

	if (empty(get_option("use_only_synonyms"))) {
		add_option("use_only_synonyms", 1);
	}

	if (empty(get_option("reorder_paragraphs"))) {
		add_option("reorder_paragraphs", 1);
	}

	if (empty(get_option("nested_spintax"))) {
		add_option("nested_spintax", 1);
	}
}