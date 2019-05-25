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

	function cusproopt_save_option_field($post_id){ 

		$product_addons = $this->get_posted_product_addons();

		update_post_meta( $post_id, '_custom_product_option', $product_addons );

		/*echo "<pre>";
		print_r($product_addons);
		die();*/
	
	}

	/**/
	private function get_posted_product_addons() {
		$product_addons = array();

		if ( isset( $_POST[ 'product_addon_name' ] ) ) {
			 $addon_name         = $_POST['product_addon_name'];
			 $addon_description  = $_POST['product_addon_description'];
			 $addon_type         = $_POST['product_addon_type'];
			 $addon_position     = $_POST['product_addon_position'];
			 $addon_required     = isset( $_POST['product_addon_required'] ) ? $_POST['product_addon_required'] : array();

			 $addon_option_label = $_POST['product_addon_option_label'];
			 $addon_option_price = $_POST['product_addon_option_price'];

			 $addon_option_min   = $_POST['product_addon_option_min'];
			 $addon_option_max   = $_POST['product_addon_option_max'];
			 /* annsys start 22-10-2015 */
			 /*$addon_onesetup     = isset( $_POST['product_addon_onesetup'] ) ? $_POST['product_addon_onesetup'] : array();*/
			 $addon_option_onesetup   = isset( $_POST['product_addon_option_onesetup'] ) ? $_POST['product_addon_option_onesetup'] : array();
			 /* end */
			 for ( $i = 0; $i < sizeof( $addon_name ); $i++ ) {

				if ( ! isset( $addon_name[ $i ] ) || ( '' == $addon_name[ $i ] ) ) {
					continue;
				}

				$addon_options 	= array();
				$option_label  	= $addon_option_label[ $i ];
				$option_price  	= $addon_option_price[ $i ];
				$option_min		= $addon_option_min[ $i ];
				$option_max		= $addon_option_max[ $i ];
				/* annsys start 22-10-2015 */
				$option_onesetup	= $addon_option_onesetup[ $i ];
				/* end */

				for ( $ii = 0; $ii < sizeof( $option_label ); $ii++ ) {
					$label 	= sanitize_text_field( stripslashes( $option_label[ $ii ] ) );
					$price 	= wc_format_decimal( sanitize_text_field( stripslashes( $option_price[ $ii ] ) ) );
					$min	= sanitize_text_field( stripslashes( $option_min[ $ii ] ) );
					$max	= sanitize_text_field( stripslashes( $option_max[ $ii ] ) );
					$onesetup = isset( $option_onesetup[ $ii ] ) ? 1 : 0;
					$addon_options[] = array(
						'label' => $label,
						'price' => $price,
						'min'	=> $min,
						'max'	=> $max,
						'onesetup'=>$onesetup
					);
				}

				if ( sizeof( $addon_options ) == 0 ) {
					continue; // Needs options
				}

				$data                = array();
				$data['name']        = sanitize_text_field( stripslashes( $addon_name[ $i ] ) );
				$data['description'] = wp_kses_post( stripslashes( $addon_description[ $i ] ) );
				$data['type']        = sanitize_text_field( stripslashes( $addon_type[ $i ] ) );
				$data['position']    = absint( $addon_position[ $i ] );
				$data['options']     = $addon_options;
				$data['required']    = isset( $addon_required[ $i ] ) ? 1 : 0;
				/* annsys start 22-10-2015 */
				/*$data['onesetup']    = isset( $addon_onesetup[ $i ] ) ? 1 : 0;*/
				/* end */

				// Add to array
				$product_addons[] = $data;
			}
		}

		uasort( $product_addons, array( $this, 'addons_cmp' ) );

		return $product_addons;
	}

	
	private function addons_cmp( $a, $b ) {
		if ( $a['position'] == $b['position'] ) {
			return 0;
		}

		return ( $a['position'] < $b['position'] ) ? -1 : 1;
	}
	/**/

	
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

		$_cusproopt_position = get_post_meta( $post_id, '_custom_product_option', true);

		include 'admin/html-cusproopt-panel.php';
	}


}
new CustomProductOption();
}




