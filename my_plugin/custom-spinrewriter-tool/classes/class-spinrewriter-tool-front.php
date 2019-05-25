<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CustomSpinToolFront
{
	
	function __construct()
	{

		add_action( 'wp_enqueue_scripts', array( $this,'cusspintool_front_enqueue_scripts_function'));

		add_shortcode( 'spin_rewritertool_shortcode',  array( $this,'cusspintool_front_shortcode' ));

		add_action( 'wp_ajax_cusspintool_front_action', array( $this,'cusspintool_front_action_function'));
		add_action( 'wp_ajax_nopriv_cusspintool_front_action', array( $this,'cusspintool_front_action_function'));
	}


	/* 
	* Added front Style
	*/
	function cusspintool_front_enqueue_scripts_function(){

		wp_enqueue_style( 'cusspintool-front-style', CUSSPINTOOL_DIR_URL.'assets/css/cusspintool-frontend.css' );

		wp_register_script( 'cusspintool-front-script', CUSSPINTOOL_DIR_URL.'assets/js/cusspintool-frontend.js'); 

		$data = array(
			'post_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'cusspintool-front-script', 'spinfrontdata', $data );

		wp_enqueue_script( 'cusspintool-front-script', CUSSPINTOOL_DIR_URL.'assets/js/cusspintool-backend.js', array('jquery'), CUSSPINTOOL_VERSION, 'all');

		wp_enqueue_style( 'Jquery-ui-front-style', CUSSPINTOOL_DIR_URL.'assets/jquery-ui/jquery-ui.css' );

		wp_enqueue_script( 'jQuery_ui-front-style', CUSSPINTOOL_DIR_URL.'assets/jquery-ui/jquery-ui.js', array('jquery'), CUSSPINTOOL_VERSION, 'all');
	}


	function cusspintool_front_action_function(){

		$front_spin_content = $_POST['front_spin_content'];


		/*------------------Start Api code-----------------------*/

		//Api name: sample-api-unique-variation
		
		set_time_limit(150);

		$data = array();
		
		// Spin Rewriter API settings - authentication:
		$data['email_address'] = get_option("spinrewriter_email");	// your Spin Rewriter email address goes here

		$data['api_key'] = get_option("spinrewriter_api_key");		// your unique Spin Rewriter API key goes here
		
		// Spin Rewriter API settings - request details:

		$data['action'] = "unique_variation";	// possible values: 'api_quota', 'text_with_spintax', 'unique_variation', 'unique_variation_from_spintax'

		$data['text'] = $front_spin_content;

		$data['protected_terms'] = "John\nDouglas Adams\nthen";		// protected terms: John, Douglas Adams, then
		$data['auto_protected_terms'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['confidence_level'] = get_option("spinrewriter_api_key");	// possible values: 'low', 'medium' (default value), 'high'

		$data['auto_sentences'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['auto_paragraphs'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['auto_new_paragraphs'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['auto_sentence_trees'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['use_only_synonyms'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['reorder_paragraphs'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'

		$data['nested_spintax'] = get_option("spinrewriter_api_key");	// possible values: 'false' (default value), 'true'


		$api_response = $this->spinrewriter_api_post($data);
	
		// Output raw JSON response (as a string).
		print_r($api_response);
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
	* Spin Rewriter tool shortcode
	*/
	function cusspintool_front_shortcode(){

		include_once CUSSPINTOOL_DIR_PATH . 'templates/html-spinrewriter-tool-editor.php';
	}
}
new CustomSpinToolFront();