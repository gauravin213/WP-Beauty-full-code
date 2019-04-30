<?php
/*
* Plugin Name: Basic Plugin Str woo
* Author: Clag Dev
* Text Domain: basic-plugin-str
* Description: This is the custom price calculator plugin
* Version: 1.0.0
*/



if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
define( 'basicpluginstr_VERSION', '1.0.0' );
define( 'basicpluginstr_URI', plugin_dir_url( __FILE__ ) );
class basicpluginstr
{
    
    function __construct()
    {

        // Product data tabs
        add_filter( 'woocommerce_product_data_tabs', array( $this,'basicpluginstr_product_data_tabs') );

        // Product data panels
        add_action( 'woocommerce_product_data_panels', array( $this,'basicpluginstr_product_data_panels') );
        
        // Add to cart
        add_filter('woocommerce_add_cart_item', array($this, 'add_cart_item'), 10, 1); 

        // Add item data to the cart or define custom variable
        add_filter( 'woocommerce_add_cart_item_data', array($this,'add_cart_item_data'),10, 2 );
        // Display item data to the cart or show custom variable
        add_filter( 'woocommerce_get_item_data', array($this,'get_cart_item_data'), 10, 2 );

        // Load cart data per page load
        add_filter( 'woocommerce_get_cart_item_from_session', array( $this, 'get_cart_item_from_session' ), 20, 2 );

        //Add meta to order - WC 2.x or save the data when the order is made
        add_action( 'woocommerce_add_order_item_meta',  array($this,'add_order_item_meta') , 10, 2 );
        

    }


    /*
    * Defined Product Data Tab 
    */
    function basicpluginstr_product_data_tabs( $tabs ) {
        $tabs['basicpluginstr'] = array(
            'label'  => esc_html__( 'basicpluginstr', 'cus-price-cal' ),
            'target' => 'basicpluginstr_settings',
            'class'  => array( 'show_if_basicpluginstr' ),
        );
        return $tabs;
    }

    /*
    * Define Product Data Panel
    */
    function basicpluginstr_product_data_panels() {
        global $post;
        $post_id = $post->ID;
        $_basicpluginstrPdata = get_post_meta( $post_id, '_basicpluginstrPdata', true );

        $_pluginStatus = get_post_meta( $post_id, '_pluginStatus', true );

        $_standard_free = $_basicpluginstrPdata['standard_free'];

        ?>
        <div id='basicpluginstr_settings' class='panel woocommerce_options_panel basicpluginstr_options_panel'>
            <h1>PPPPPPPPPP</h1>
        </div>
        <?php
    }


    function add_cart_item($cart_item) { 

        if ( isset( $cart_item['basicpluginstr'] ) ) {

            foreach ( $cart_item['basicpluginstr'] as $basicpluginstr ) {
  
                $price = $basicpluginstr['price']; 
            }

            $cart_item['data']->set_price($price);
            //$cart_item['data']->adjust_price( $extra_cost );
        }



       
        return $cart_item;
    }

      function add_cart_item_data( $cart_item_data, $productId, $variationId ) {

        if ( empty( $cart_item_data['basicpluginstr'] ) ) {
                $cart_item_data['basicpluginstr'] = array();
        }

        $data[] = array(
                'name'  => 'Name',
                'value' => 'valus',
                'price' => 50
                );
                
        $cart_item_data['basicpluginstr'] = array_merge( $cart_item_data['basicpluginstr'], $data);


       
        return $cart_item_data;
    }


      function get_cart_item_data( $data, $cartItem ) {

        if ( isset( $cartItem['basicpluginstr'] ) ) {

            foreach ( $cartItem['basicpluginstr'] as $basicpluginstr ) {

                $name = $basicpluginstr['name'];  

                $value = $basicpluginstr['value'];  

                $price = $basicpluginstr['price']; 

            }

            $data[] = array(
                'name' => $name,
                'value' => $value,
                'display' => 0
            );
        }

        return $data;
    }


    function get_cart_item_from_session($cart_item, $values) {

        if ( ! empty( $values['basicpluginstr'] ) ) {
            $cart_item['basicpluginstr'] = $values['basicpluginstr'];
            $cart_item = $this->add_cart_item( $cart_item );
        }
        return $cart_item;


    }

    function add_order_item_meta( $item_id, $values ) {
     
        if ( ! empty( $values['basicpluginstr'] ) ) {
            foreach ( $values['basicpluginstr'] as $basicpluginstr ) {

                $name = $basicpluginstr['name'];
                $value = $basicpluginstr['value'];
                woocommerce_add_order_item_meta( $item_id, $name, $value );

                //woocommerce_add_order_item_meta( $item_id, 'basicpluginstr', 'basicpluginstr value' );
            }
        }

    }

}
new basicpluginstr();

}






/*add_filter( 'woocommerce_add_cart_item' , 'set_woo_prices');
add_filter( 'woocommerce_get_cart_item_from_session',  'set_session_prices', 20 , 3 );

function set_woo_prices( $woo_data ) {
  //if ( ! isset( $_GET['price'] ) || empty ( $_GET['price'] ) ) { return $woo_data; }
  $woo_data['data']->set_price( 50 );
  $woo_data['my_price'] = $_GET['price'];
  return $woo_data;
}

function  set_session_prices ( $woo_data , $values , $key ) {
    if ( ! isset( $woo_data['my_price'] ) || empty ( $woo_data['my_price'] ) ) { return $woo_data; }
    $woo_data['data']->set_price( $woo_data['my_price'] );
    return $woo_data;
}*/


/*add_action( 'woocommerce_before_calculate_totals', 'adding_custom_price', 10, 1);
function adding_custom_price( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach ( $cart->get_cart() as $cart_item ) {
        $product_price = $cart_item['data']->get_price(); // get the price
        $rounded_price = round( $product_price, 2, PHP_ROUND_HALF_UP );
        $cart_item['data']->set_price(floatval($rounded_price));
    }
}


add_action('woocommerce_cart_calculate_fees' , 'add_custom_fees');
function add_custom_fees( WC_Cart $cart ){

    $get_session_consultant_code = WC()->session->get( 'session_consultant_code');

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) 
    {

        $product_id = $cart_item['product_id'];

        if ($get_session_consultant_code!="") 
        {
        if ($product_id == 18) { //Delux product discount 50%
            $discount = $cart->subtotal * 0.5;
            $cart->add_fee( 'You have more than 3 items in your cart, a 50% discount has been added.', -$discount);
        }
        else{ //Basic product discount 100%
            $discount = $cart->subtotal * 0.1;
            $cart->add_fee( 'You have more than 3 items in your cart, a 50% discount has been added.', -$discount);
        }
            
        }

    }


}
*/