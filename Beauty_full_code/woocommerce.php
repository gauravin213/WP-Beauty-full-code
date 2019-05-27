<?php

/*
* add custom fields checkout page
*/
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields)
{

    $fields['custom_checkbox'] = array(
        'label' => __('Fill Street address.', 'woocommerce'), // Add custom field label
        //'placeholder' => _x('Your NIF here....', 'placeholder', 'woocommerce'), // Add custom field placeholder
        'required' => false, // if field is required or not
        'clear' => false, // add clear or not
        'type' => 'checkbox', // add field type
        'priority' => 51,
        'class' => array('my-css')    // add class name
    );

    return $fields;
}


function filter_woocommerce_shipping_fields( $fields ) { 
     $fields['custom_checkbox_shipping'] = array(
        'label' => __('Fill Street address 2.', 'woocommerce'), // Add custom field label
        //'placeholder' => _x('Your NIF here....', 'placeholder', 'woocommerce'), // Add custom field placeholder
        'required' => false, // if field is required or not
        'clear' => false, // add clear or not
        'type' => 'checkbox', // add field type
        'priority' => 51,
        'class' => array('my-css')    // add class name
    );

    return $fields;
}; 
         
// add the filter 
add_filter( 'woocommerce_shipping_fields', 'filter_woocommerce_shipping_fields', 10, 2 ); 
/*
* add custom fields checkout page
*/




/*
* changed woocommerce order status
*/ 
add_action('woocommerce_order_status_changed','status_changed_processsing');
   function status_changed_processsing( $order_id, $checkout = null ) {
       global $woocommerce;
        $order = new WC_Order($order_id);
        
        if (!empty($order)) {
         $order->update_status( 'processing' );
        }
}
/*
* changed woocommerce order status
*/ 


/*
* Show woocommerce empty category
*/
//font
add_filter( 'woocommerce_product_subcategories_hide_empty', array( $this,'hide_empty_categories'), 10, 1 );
function hide_empty_categories ( $hide_empty ) {
        $hide_empty  =  FALSE;
        return $hide_empty;
    }

//back
add_filter( 'get_terms_args', array( $this,'wpd_show_empty_terms_in_quick_search'), 10, 2 );

function wpd_show_empty_terms_in_quick_search( $args, $taxonomies ){
        $args['hide_empty'] = false;
        return $args;
    }   
/*
* Show woocommerce empty category
*/



/*
* get woocommerce variable product price
*/
$varproduct  = wc_get_product( $woorel_item_id );

$var_price_first = $varproduct->get_price(); 

$available_variations = $varproduct->get_children();

$available_variations = end($available_variations);

$productnnn = new WC_Product_Variation($available_variations);

$var_price_last = $productnnn->get_price();

$var_septare_price = $currency_symbol.$var_price_first.' - '.$currency_symbol.$var_price_last;
/*
* get woocommerce variable product price
*/



/*
* woocommerce_before_calculate_totals
*/
add_action( 'woocommerce_before_calculate_totals', 'adding_custom_price', 10, 1);
function adding_custom_price( $cart_obj ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // Set below your targeted individual products IDs or arrays of product IDs
    $target_product_id = 8;
    //$target_product_ids_arr = array(22, 56, 81);

    foreach ( $cart_obj->get_cart() as  $cart_item ) {
        // The corresponding product ID
        $product_id = $cart_item['product_id'];

        // For a single product ID
        if($product_id == $target_product_id){
            // Custom calculation
            $price = $cart_item['data']->get_price() + 50;
            $cart_item['data']->set_price( floatval($price) );

            echo "-a";
        } 

        // For an array of product IDs 
        elseif( in_array( $product_id, $target_product_ids_arr ) ){
            // Custom calculation
            $price = $cart_item['data']->get_price() + 30;
            $cart_item['data']->set_price( floatval($price) );
        }
    }
}
/*
* woocommerce_before_calculate_totals
*/


/*
* add to cart programatically woocommerce
*/
$product_id   = $_POST['product_id'];
  $quantity     = $_POST['quantity'];
  $variation_id = $_POST['variation_id'];
  $variation    = array(
    'Color' => 'Blue',
    'Size'  => 'Small',
  );

WC()->cart->add_to_cart( $product_id, $quantity);

$string|bool = WC_Cart::add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );


$cartId = WC()->cart->generate_cart_id( $product_id );
      $cartItemKey = WC()->cart->find_product_in_cart( $cartId );
      WC()->cart->remove_cart_item( $cartItemKey );
/*
* add to cart programatically woocommerce
*/


/*
* unset woocomerce country
*/
function woo_remove_specific_country( $country ) {

   unset($country["IN"]);
   unset($country["BY"]);
   unset($country["BI"]);
   unset($country["CF"]);
   unset($country["CG"]);
   unset($country["CD"]);
   unset($country["CU"]);
   unset($country["IR"]);
   unset($country["IQ"]);
   unset($country["LB"]);
   unset($country["KP"]);
   unset($country["SO"]);
   unset($country["SD"]);
   unset($country["SS"]);
   unset($country["SY"]);
   unset($country["UA"]);
   unset($country["VE"]);
   unset($country["YE"]);
   unset($country["ZW"]);
   return $country; 
}
add_filter( 'woocommerce_countries', 'woo_remove_specific_country', 10, 1 );
/*
* unset woocomerce country
*/

/*
* get id by sku woocomerce
*/
echo wc_get_product_id_by_sku( $sku );
/*
* get id by sku woocomerce
*/

/*
* woocomerce page url
*/
echo get_permalink( wc_get_page_id( 'myaccount' ) );
echo get_permalink( wc_get_page_id( 'shop' ) );
echo get_permalink( wc_get_page_id( 'cart' ) );
echo get_permalink( wc_get_page_id( 'checkout' ) );
    global $wp;
    $get_current_page_url = home_url( $wp->request ).'/'; 
    $get_cart_page_url = get_permalink( wc_get_page_id( 'cart' ) );
    if($get_current_page_url === $get_cart_page_url){
        $footer = 'footer-1';
    }
/*
* woocomerce page url
*/




/*
*  Remove the product description Title
*/
// Remove the product description Title
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
 return '';
}

// Change the product description title
add_filter('woocommerce_product_description_heading', 'change_product_description_heading');
function change_product_description_heading() {
 return __('description', 'woocommerce');
}
/*
*  Remove the product description Title
*/


/*
* @modify price html
*/
add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
    
    $product_id = $product->get_id();
    
    if($product_id == 6385){
         $custom_html = '<ins><span style="margin-right: 7px;" class="woocommerce-Price-amount amount">From</span></ins>'.$price;
    }
    else{
        $custom_html = $price;
    }
    return $custom_html;
}
/*
* @modify price html
*/
?>




<!--checkout page-->
<?php if (is_checkout()) { ?>
<script type="text/javascript">
    jQuery(document).ready(function(){ //alert('check');

        //Open model on state selection
        jQuery(document).on('change', '#billing_state', function(){

            var target = jQuery(this);

            var cus_state = target.find(":selected").val();

            if (cus_state == "CA") { //fire popup box

                //alert(cus_state+' Open popup');

                //jQuery('#myModal').modal('toggle');
                //jQuery('#myModal').modal('show');
                //jQuery('#myModal').modal('hide');

                jQuery('#myModal').modal({backdrop: 'static', keyboard: false}) 

            }
        });

        jQuery(document).on('change', '#shipping_state', function(){

            var target = jQuery(this);

            var cus_state = target.find(":selected").val();

            if (cus_state == "CA") { //fire popup box

                //alert(cus_state+' Open popup');

                //jQuery('#myModal').modal('toggle');
                //jQuery('#myModal').modal('show');
                //jQuery('#myModal').modal('hide');

                jQuery('#myModal').modal({backdrop: 'static', keyboard: false}) 

            }
        });

        jQuery(document).on('click', '#custom_term_go', function(){

            if(jQuery('#custom_term_checkbox').is(":checked")){
                //alert("Checkbox is checked.");
                jQuery('#myModal').modal('hide');
            }else{
                alert("Please check this to accept California 65 rules");
            }
        });

        var checkout_form = jQuery( 'form.checkout' );

        checkout_form.on( 'checkout_place_order', function() { //alert("ppp"); 

            var cus_state = jQuery('#billing_state').find(":selected").val();

            if (cus_state == "CA") { //alert(cus_state);  //fire popup box

                if(jQuery('#custom_term_checkbox').is(":checked")){
                    return true;
                }else{
                    jQuery('#myModal').modal({backdrop: 'static', keyboard: false});
                }

            }else{
                return true;
            }

            return false;

        });

    });
</script>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <!-- <button data-target="#myModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    Launch demo modal
 </button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog cus-modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content cus-modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div> -->

        <div class="modal-body">
            <h1>CALIFORNIA</h1>
            <h3>PROPOSION 65 WARNING</h3>
            <p>Diesel Engine exhaust and some of its constituents are known to the state of California to cause cancer, birth defects and other reproductive harm.</p>

            <div>
                <input type="checkbox" name="custom_term_checkbox" id="custom_term_checkbox">
                <label>Please check this to accept California 65 rules</label>
            </div>
            <button type="button" class="btn btn-default" id="custom_term_go">Go</button>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
      
    </div>
  </div>
  
</div>

<style type="text/css">
    .cus-modal-content{
        text-align: center;
    }
    .cus-modal-dialog{
        margin-top: 60px;
    }
</style>
<?php } ?>
<!--checkout page-->



<!--After checkout page update-->
<?php if (is_checkout()) { ?>
<script type="text/javascript">
    jQuery(document).ready(function(){ //alert('check');

        //Open model on state selection
        jQuery(document).on('change', '#billing_state', function(){

            var target = jQuery(this);

            var cus_state = target.find(":selected").val();

            if (cus_state == "CA") { //fire popup box

                //alert(cus_state+' Open popup');

                jQuery('#myModal').show();

            }
        });

        jQuery(document).on('change', '#shipping_state', function(){

            var target = jQuery(this);

            var cus_state = target.find(":selected").val();

            if (cus_state == "CA") { //fire popup box

                //alert(cus_state+' Open popup');

                jQuery('#myModal').show();

            }
        });
        
        
        
        jQuery( document ).on( 'updated_checkout', function() {
            
            
            var cus_state = jQuery('#billing_state').find(":selected").val();

            if (cus_state == "CA") {
                
            
                jQuery('#myModal').show();

            }
            
            var cus_state = jQuery('#shipping_state').find(":selected").val();

            if (cus_state == "CA") { //fire popup box

                //alert(cus_state+' Open popup');

                jQuery('#myModal').show();

            }
        
        } );

    });
</script>
<?php } ?>
<!--After checkout page update-->



<!--custom tab-->
<?php
add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs( $tabs ) {

    //unset( $tabs['description'] );  // Remove the description tab
  
    $prod_id = get_the_ID();
    $cus_woo_tab_technical_doc = get_post_meta($prod_id,'cus_woo_tab_technical_doc',true);

    if ($cus_woo_tab_technical_doc) {
       // Adds the other products tab
        $tabs['technical_products_tab'] = array(
            'title'     => __( 'Technical Doc', 'woocommerce' ),
            'priority'  => 120,
            'callback'  => 'woo_technical_products_tab_content'
        );
    }

    return $tabs;

}

// New Tab contents
function woo_technical_products_tab_content() {
   
    echo '<h2>Other Products</h2>';
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'cus_woo_tab_technical_doc',true).'</p>';
}


add_action( 'add_meta_boxes', 'custom_admin_metabox');
function custom_admin_metabox(){

   add_meta_box( 'cus_woo_tab_technical_doc', 'Product Tab Technical Doc', 'cus_woo_tab_technical_doc', 'product', 'normal', 'low' );
    
}


function cus_woo_tab_technical_doc(){
    global $post;
    $cus_woo_tab_technical_doc = get_post_meta( $post->ID, 'cus_woo_tab_technical_doc', true );
    $content = $cus_woo_tab_technical_doc;
    $editor_id = 'mycustomeditor_technical_doc';
    $settings = array(
        'tinymce' => array(
            'height' => 200
        )
    );
    wp_editor( $content, $editor_id, $settings);
}


function destination_save_metabox( $post_id, $post ) {
    
    //cus_woo_tab_technical_doc
    if (isset( $_POST['mycustomeditor_technical_doc'] ) ) {
        $sanitized = wp_filter_post_kses( $_POST['mycustomeditor_technical_doc'] );
        update_post_meta( $post->ID, 'cus_woo_tab_technical_doc', $sanitized );
    }

}
add_action( 'save_post', 'destination_save_metabox', 1, 2 );
?>
<!--custom tab-->




<?php
/*
 * Custom Register as Wholesale checkbox [May 14, 2019]
*/
function wooc_extra_register_fields() {?>
    <p class="form-row form-row-wide" id="woocommerce_my_account_page_checkbox_field" data-priority="">
        <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="woocommerce_my_account_page_checkbox" id="woocommerce_my_account_page_checkbox" value="1">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline"><span><?php esc_html_e('Register as wholesaler', 'woocommerce'); ?></span></label>
    </p>
    <?php
}
//add_action( 'woocommerce_register_form', 'wooc_extra_register_fields', 5 );

function wooc_save_extra_register_fields($customer_id) {
   if ( isset( $_POST['woocommerce_my_account_page_checkbox'] ) ) {
       update_user_meta( $customer_id, 'woocommerce_my_account_page_checkbox', sanitize_text_field( $_POST['woocommerce_my_account_page_checkbox'] ) );
       wp_update_user( array ('ID' => $customer_id, 'role' => 'wholesale_customer') );
   }
}
//add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' ); 
/*
 * Custom Register as Wholesale checkbox [May 14, 2019]
*/



/*
* Add custom element after terms & condition
*/
add_action('woocommerce_checkout_after_terms_and_conditions', 'checkout_additional_checkboxes');
function checkout_additional_checkboxes( ){
    ?>
    <p class="form-row custom-checkboxes" id="myModal" style="display: none;">
        <?php 
        if (isset($_POST['billing_state'])) {
           echo "string";
        }
        ?>
       <img src="<?php echo home_url().'/wp-content/themes/ydg-theme-child/images/alert-a2.png'?>">
       California Proposition 65 requires businesses to provide warnings to Californians about significant exposure to chemicals that cause cancer, birth defects, or other reproductive harm. Add details about the warning you want to show California buyers. We'll add a warning symbol and the word 'WARNING:' before the description you enter here, and we’ll add 'For more information go to www.p65warnings.ca.gov' following your description.
    </p>
    
    <style>
        #myModal{
            border: 1px solid #efe9e9;
        }
    </style>
    <?php
}
/*
* Add custom element after terms & condition
*/


/*
* Set Order View
*/
add_filter( "views_edit-shop_order" , 'custom_view_count', 10, 1);
function custom_view_count($views){

    global $current_screen;

    $user_id = get_current_user_id(); 
    $user_meta = get_userdata($user_id);
    $user_roles = $user_meta->roles;
    /*echo "<pre>";
    print_r($views);
    echo "</pre>";
    die();*/
        
    if ( count($user_roles) == 1) {
           
        if ( in_array( 'wholesale_customer', $user_roles, true ) ) {

            switch( $current_screen->id ) 
            {
                case 'edit-shop_order':
                    $views = wpse_30331_manipulate_views( 'shop_order', $views );
                    break;
            }

        }
    }
    
    return $views;
}

function wpse_30331_manipulate_views( $what, $views )
{

    global $user_ID, $wpdb;
    
    /*
     * This needs refining, and maybe a better method
     * e.g. Attachments have completely different counts 
     */
    $total = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-pending' OR post_status = 'wc-processing' OR post_status = 'wc-on-hold' OR post_status = 'wc-completed' OR post_status = 'wc-cancelled' OR post_status = 'wc-refunded' OR post_status = 'wc-failed' ) AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $trash = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'trash') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $pending = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-pending') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");


    $processing = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-processing') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $on_hold = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-on-hold') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $completed = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-completed') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $cancelled = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-cancelled') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $refunded = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-refunded') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $failed = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'wc-failed') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");

    $views['all'] = preg_replace( '/\(.+\)/U', '('.$total.')', $views['all'] ); 

    $views['trash'] = preg_replace( '/\(.+\)/U', '('.$trash.')', $views['trash'] ); 

    $views['wc-pending'] = preg_replace( '/\(.+\)/U', '('.$pending.')', $views['wc-pending'] ); 

    $views['wc-processing'] = preg_replace( '/\(.+\)/U', '('.$processing.')', $views['wc-processing'] ); 

    $views['wc-on-hold'] = preg_replace( '/\(.+\)/U', '('.$on_hold.')', $views['wc-on-hold'] ); 

    $views['wc-completed'] = preg_replace( '/\(.+\)/U', '('.$completed.')', $views['wc-completed'] ); 

    $views['wc-cancelled'] = preg_replace( '/\(.+\)/U', '('.$cancelled.')', $views['wc-cancelled'] ); 

    $views['wc-refunded'] = preg_replace( '/\(.+\)/U', '('.$refunded.')', $views['wc-refunded'] ); 

    $views['wc-failed'] = preg_replace( '/\(.+\)/U', '('.$failed.')', $views['wc-failed'] ); 

    return $views;
}
/*
* Set Order View
*/


/*
* Add custom tab my account page
*/
function bbloomer_add_premium_support_endpoint() {
    add_rewrite_endpoint( 'premium-support', EP_ROOT | EP_PAGES );
}
  
add_action( 'init', 'bbloomer_add_premium_support_endpoint' );
  
  
// ------------------
// 2. Add new query var
  
function bbloomer_premium_support_query_vars( $vars ) {
    $vars[] = 'premium-support';
    return $vars;
}
  
add_filter( 'query_vars', 'bbloomer_premium_support_query_vars', 0 );
  
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function bbloomer_add_premium_support_link_my_account( $items ) {
    $items['premium-support'] = 'Premium Support';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'bbloomer_add_premium_support_link_my_account' );
  
  
// ------------------
// 4. Add content to the new endpoint
  
function bbloomer_premium_support_content() {
echo '<h3>Premium WooCommerce Support</h3><p>Welcome to the WooCommerce support area. As a premium customer, you can submit a ticket should you have any WooCommerce issues with your website, snippets or customization. <i>Please contact your theme/plugin developer for theme/plugin-related support.</i></p>';
echo do_shortcode( ' /* your shortcode here */ ' );
}
  
add_action( 'woocommerce_account_premium-support_endpoint', 'bbloomer_premium_support_content' );
/*
* Add custom tab my account page
*/


?>


