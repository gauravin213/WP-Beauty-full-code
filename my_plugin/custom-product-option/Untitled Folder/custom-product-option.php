<?php
/*
* Plugin Name: Custom Product Option
* Author: Clag Dev
* Text Domain: cus-pro-opt
* Description: This is the custom-product-option plugin
* Version: 1.0.0
*/



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/*
* Check if WooCommerce is active
*/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
define( 'CUSPROOPT_VERSION', '1.0.0' );
define( 'CUSPROOPT_URI', plugin_dir_url( __FILE__ ) );

class CustomProductOption
{
	
	function __construct()
	{

		
		// Product data tabs
		add_filter( 'woocommerce_product_data_tabs', array( $this,'cusproopt_product_data_tabs') );

		// Product data panels
		add_action( 'woocommerce_product_data_panels', array( $this,'cusproopt_product_data_panels') );

		// Product data
		add_action( 'save_post', array( $this, 'cusproopt_save_option_field' ) );


	}

	function cusproopt_save_option_field($post_id){ echo "<pre>";

		$main_custom_option = array();

		$main_custom_option['name'] = $_POST['product_addon_name'];

		$main_custom_option['description'] = $_POST['product_addon_description'];

		$main_custom_option['type'] = $_POST['product_addon_type'];

		$main_custom_option['position'] = $_POST['product_addon_position'];

		$main_custom_option['required'] = $_POST['product_addon_required'];

		$main_custom_option['label'] = $_POST['product_addon_option_label'];

		$main_custom_option['price'] = $_POST['product_addon_option_price'];

		$main_custom_option['onesetup'] = $_POST['product_addon_option_onesetup'];


		/**/
		/*echo "<pre>";
		print_r($_POST['product_addon_name']);
		die();*/
		/**/


		
	$product_addons = array();

	for ( $i = 0; $i < sizeof( $_POST['product_addon_name'] ); $i++ ) {

		$tmp_opt=array();
		for ( $ii = 0; $ii < sizeof( $main_custom_option['label'][$i] ); $ii++ ) {
			$label 	=   $main_custom_option['label'][$i][$ii];
			$price 	=  $main_custom_option['price'][$i][$ii];
			$onesetup =  $main_custom_option['onesetup'][$i][$ii];
			$tmp_opt[] = array(
				'label' => $label,
				'price' => $price,
				'onesetup'=>$onesetup
			);
		}


		$data                = array();
		$data['name']        = $main_custom_option['name'][$i];
		$data['description'] = $main_custom_option['description'][$i];
		$data['type']        = $main_custom_option['type'][$i];
		$data['position']    = $main_custom_option['position'][$i];
		$data['options']     = $tmp_opt;
		$data['required']    = $main_custom_option['required'][$i];
		$product_addons[]    = $data;

	}


		/*if (isset($_POST['product_addon_position'])) {
			update_post_meta( $post_id, '_cusproopt_position', $product_addons);
		}*/
	
	}

	
	/*
	* Defined Product Data Tab 
	*/
	function cusproopt_product_data_tabs( $tabs ) {
		$tabs['cusproopt'] = array(
			'label'  => esc_html__( 'CusProOpt', 'cus-pro-opt' ),
			'target' => 'cusproopt_settings',
			'class'  => array( 'show_if_cusproopt' ),
		);
		return $tabs;
	}

	/*
	* Define Product Data Panel
	*/
 	function cusproopt_product_data_panels() {
		global $post;
		$post_id = $post->ID;

		include 'admin/html-cusproopt-panel.php';
	
	}


}
new CustomProductOption();
}




