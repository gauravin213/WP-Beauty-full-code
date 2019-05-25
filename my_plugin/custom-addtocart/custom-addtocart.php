<?php
/*
* Plugin Name: Custom Add to cart
* Description: aaaaaaaaaaaa
* Version:1.0.0 
* Author: Clag dev
*/


if ( ! class_exists( 'Wooaddtocart' ) ) {

define( 'WOOCUS_VERSION', '1.0.0' );
define( 'WOOCUS_URI', plugin_dir_url( __FILE__ ) );

class Wooaddtocart
{
	
	function __construct(){

		add_action( 'wp_enqueue_scripts', array( $this, 'wooaddtocart_enqueue_styles'));

		//add_action('woocommerce_after_order_notes', array( $this,'my_custom_fields'));

		add_action( 'woocommerce_checkout_before_order_review', array( $this,'my_custom_fields' ));

		//Ajax
		add_action( 'wp_ajax_woocus_my_action', array( $this,'woocus_my_action'));
		add_action( 'wp_ajax_nopriv_woocus_my_action', array( $this,'woocus_my_action'));
	}

	function woocus_my_action(){

		$cus_cart_status = $_POST['cus_cart_status'];

		$product_id   = $_POST['pid'];
		/*$quantity     = $_POST['quantity'];
		$variation_id = $_POST['variation_id'];
		$variation    = array(
		    'Color' => 'Blue',
		    'Size'  => 'Small',
		);*/

		if ($cus_cart_status) {
			
			WC()->cart->add_to_cart( $product_id);

		} else {

			$cartId = WC()->cart->generate_cart_id( $product_id );
			$cartItemKey = WC()->cart->find_product_in_cart( $cartId );
			WC()->cart->remove_cart_item( $cartItemKey );

		}

		die("@@");
	}

	function wooaddtocart_enqueue_styles(){


		wp_register_script( 'some_front_handle', WOOCUS_URI.'js/custom2.js'); 

		$dataobj = array(
			'post_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'some_front_handle', 'dataobj', $dataobj );


		wp_enqueue_script( 'some_front_handle', WOOCUS_URI.'js/custom2.js', array('jquery'), WOOCUS_VERSION, 'all');

	}

	/*
	* Add custom checkbox on checkout page
	*/

	function my_custom_fields(){

		/**/
		$args = array(
		    'posts_per_page'   => 1,
		    'orderby'          => 'rand',
		    'post_type'        => 'product' 
		); 


		$post_query_1 = new WP_Query( $args );
		//$post_query_1 = get_posts($args);

		if($post_query_1->have_posts()){

		    while( $post_query_1->have_posts() ) { 
		        $post_query_1->the_post();

		        $pid = get_the_ID(); 
		      

		    }

		}
		/**/

		//$pid = 472;

		$product = wc_get_product($pid);

		$product_title = substr($product->name,0,60);

  		echo '<div class="cw_custom_class"><input id="pid" type="hidden" name="pid" value="'.$pid.'">';

  		echo '<h3>'.__('Product Name : '.$product_title).'</h3>';

	    woocommerce_form_field( 'custom_checkbox', array(
	        'type'          => 'checkbox',
	        'label'         => __('Custom Checkbox.'),
	        'required'  => true,
	    ));

	    echo '</div>';
	}


}

new Wooaddtocart();
}
