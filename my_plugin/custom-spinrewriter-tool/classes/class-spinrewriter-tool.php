<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CustomSpinTool
{
	
	function __construct()
	{
		//add_action( 'edit_form_after_title', array( $this, 'cusspintool_after_title') );

		add_action( 'admin_enqueue_scripts', array( $this,'cusspintool_admin_enqueue_scripts_function'));

		add_action( 'admin_menu',  array( $this, 'cusspintool_admin_function' ));

		//add_action( 'wp_ajax_cusspintool_spin_action', array( $this,'cusspintool_spin_action_function'));
		//add_action( 'wp_ajax_nopriv_cusspintool_spin_action', array( $this,'cusspintool_spin_action_function'));
	}


	function cusspintool_spin_action_function(){

		$spin_content = $_POST['spin_content'];


		/*------------------Start Api code-----------------------*/
		set_time_limit(150);

		$data = array();
		
		// Spin Rewriter API settings - authentication:
		$data['email_address'] = get_option("spinrewriter_email");				// your Spin Rewriter email address goes here
		$data['api_key'] = get_option("spinrewriter_api_key");		// your unique Spin Rewriter API key goes here
		
		// Spin Rewriter API settings - request details:
		$data['action'] = "unique_variation";						// possible values: 'api_quota', 'text_with_spintax', 'unique_variation', 'unique_variation_from_spintax'
		$data['text'] = $spin_content;
		$data['protected_terms'] = "John\nDouglas Adams\nthen";		// protected terms: John, Douglas Adams, then
		$data['auto_protected_terms'] = "false";					// possible values: 'false' (default value), 'true'
		$data['confidence_level'] = "high";							// possible values: 'low', 'medium' (default value), 'high'
		$data['auto_sentences'] = "false";							// possible values: 'false' (default value), 'true'
		$data['auto_paragraphs'] = "false";							// possible values: 'false' (default value), 'true'
		$data['auto_new_paragraphs'] = "false";						// possible values: 'false' (default value), 'true'
		$data['auto_sentence_trees'] = "false";						// possible values: 'false' (default value), 'true'
		$data['use_only_synonyms'] = "false";						// possible values: 'false' (default value), 'true'
		$data['reorder_paragraphs'] = "false";						// possible values: 'false' (default value), 'true'
		$data['nested_spintax'] = "true";							// possible values: 'false' (default value), 'true'


		$api_response = $this->spinrewriter_api_post($data);
	
		// Output raw JSON response (as a string).
		print_r($api_response);

		
		// Output interpreted JSON response (as a native PHP array).
		//$api_response_interpreted = json_decode($api_response, true);
		//print_r($api_response_interpreted);
		/*------------------End Api code-----------------------*/
	
		die();


	}


	/**
	 * Sends a request to the Spin Rewriter API and returns the unformatted response.
	 * @param $data
	 */
	function spinrewriter_api_post($data){
		$data_raw = "";
		foreach ($data as $key => $value){
			$data_raw = $data_raw . $key . "=" . urlencode($value) . "&";
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.spinrewriter.com/action/api");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_raw);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = trim(curl_exec($ch));
		curl_close($ch);
		return $response;
	}


	/*
	* Setting tab menu
	*/
	function  cusspintool_admin_function(){

		add_options_page( 'Spinrewriter page', 
			'Spinrewriter menu', 
			'manage_options', 
			'spinrewriter', 
			function(){
				include_once CUSSPINTOOL_DIR_PATH. 'admin/html-spin-rewriter-settings.php';
			}
		);
	}

	/* 
	* Added Style
	*/
	function cusspintool_admin_enqueue_scripts_function(){

		wp_enqueue_style( 'cusspintool-style-handle', CUSSPINTOOL_DIR_URL.'assets/css/cusspintool-backend.css' );

		wp_register_script( 'cusspintool-scripts-handle', CUSSPINTOOL_DIR_URL.'assets/js/cusspintool-backend.js'); 

		$data = array(
			'post_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'cusspintool-scripts-handle', 'spindata', $data );

		wp_enqueue_script( 'cusspintool-scripts-handle', CUSSPINTOOL_DIR_URL.'assets/js/cusspintool-backend.js', array('jquery'), CUSSPINTOOL_VERSION, 'all');

		wp_enqueue_style( 'Jquery-ui-style-handle', CUSSPINTOOL_DIR_URL.'assets/jquery-ui/jquery-ui.css' );

		wp_enqueue_script( 'jQuery_ui-scripts-handle', CUSSPINTOOL_DIR_URL.'assets/jquery-ui/jquery-ui.js', array('jquery'), CUSSPINTOOL_VERSION, 'all');
	
	}

	function cusspintool_after_title($post_id){ 
	
		include_once CUSSPINTOOL_DIR_PATH . 'admin/html-after-title.php';
	}

}
new CustomSpinTool();