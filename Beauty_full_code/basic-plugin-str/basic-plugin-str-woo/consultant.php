<?php
/*
* Start::Consultant upload file
*/
add_action('admin_init', 'allow_new_role_uploads');
function allow_new_role_uploads() {
    add_role(
        'consultant_editor',
        __( 'Consultant' ),
        array(
            'read'         => true,  // true allows this capability
            'edit_posts'   => true,
        )
    );
    $new_role = get_role('consultant_editor');
    $new_role->add_cap('upload_files');
}



add_action( 'admin_enqueue_scripts', 'consultant_include_myuploadscript' );
function consultant_include_myuploadscript() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/customscript.js', array('jquery'), null, false );
}

function consultant_image_uploader_field( $name, $value = '') {

$image = ' button">Upload Banner';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
    $image = '"><img src="' . $image_attributes[0] . '" style="max-width:50%;display:block;" />';
    $display = 'inline-block';
}

return '<div>
    <a href="#" class="consultant_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';

}

function consultant_logo_uploader_field( $name, $value = '') {
$image = ' button">Upload Logo';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
    $image = '"><img src="' . $image_attributes[0] . '" style="max-width:50%;display:block;" />';
    $display = 'inline-block';
}

return '
<div>
    <a href="#" class="consultant_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';

}


add_action('admin_menu', 'consultant_add_options_page');
function consultant_add_options_page() {
    
    $userid = get_current_user_id();
    $page_slug = 'uplsettings';
    $option_name = 'header_img';
    $option_name_logo = 'header_logo';

    if ( isset( $_GET['page'] ) && $_GET['page'] == $page_slug ) {
        if(isset($_POST['action'])){

            update_user_meta( $userid, 'header_img', $_POST['header_img']);
            update_user_meta( $userid, 'header_logo', $_POST['header_logo']);

            header('Location: '. site_url() .'/wp-admin/options-general.php?page=' . $page_slug . '&saved=true');
            die;
        }
    }

    /*$uid = get_current_user_id();
    $user_meta=get_userdata($uid);
    $user_roles=$user_meta->roles;
    if (is_user_logged_in()) 
    {
        if($user_roles[1] == 'consultant_editor' || $user_roles[0] == 'administrator')
        {
            add_submenu_page('options-general.php','Consultant Setting','Consultant Setting', 'edit_posts', $page_slug, 'consultant_print_options_page');
        }
    }*/


    add_submenu_page('options-general.php','Consultant Setting','Consultant Setting', 'edit_posts', $page_slug, 'consultant_print_options_page');

    //add_menu_page( 'Consultant Setting', 'Consultant Setting', 'manage_options', 'consultant-page', 'consultant_print_options_page' );
    
}

function consultant_print_options_page() {
    $userid = get_current_user_id();
    $option_name = 'header_img';

    $option_name_logo = 'header_logo';

    if ( isset( $_REQUEST['saved'] ) ){
        echo '<div class="updated"><p>Saved.</p></div>';
    }
    ?>
    <div class="wrap">
        <form method="post">
            <?php echo consultant_image_uploader_field( $option_name, get_user_meta( $userid, 'header_img', true) );?>
            <?php echo consultant_logo_uploader_field( $option_name_logo, get_user_meta( $userid, 'header_logo', true) );?>
            <p class="submit">
                <input name="save" type="submit" class="button-primary" value="Save changes" />
                <input type="hidden" name="action" value="save" />
            </p>
        </form>
    </div>
    <style>a.consultant_upload_image_button.button {margin: 10px auto;}</style>
    <script type="text/javascript">
    jQuery(function($){
        /*
         * Select/Upload image(s) event
         */
        $('body').on('click', '.consultant_upload_image_button', function(e){
            e.preventDefault();
     
                var button = $(this),
                    custom_uploader = wp.media({
                title: 'Insert image',
                library : {
                    // uncomment the next line if you want to attach image to the current post
                    // uploadedTo : wp.media.view.settings.post.id, 
                    type : 'image'
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false // for multiple image selection set to true
            }).on('select', function() { // it also has "open" and "close" events 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:50%;display:block;" />').next().val(attachment.id).next().show();
                /* if you sen multiple to true, here is some code for getting the image IDs
                var attachments = frame.state().get('selection'),
                    attachment_ids = new Array(),
                    i = 0;
                attachments.each(function(attachment) {
                    attachment_ids[i] = attachment['id'];
                    console.log( attachment );
                    i++;
                });
                */
            })
            .open();
        });
     
        /*
         * Remove image event
         */
        $('body').on('click', '.misha_remove_image_button', function(){
            $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
            return false;
        });
     
    });
    </script>
    <?php
}

/*
* End::Consultant upload file
*/



/*
* Add  consultant code md5
*/
add_action( 'user_register', 'subscribe_to_mailchimp_after_registration', 10, 1 );
function subscribe_to_mailchimp_after_registration( $user_id ) {
       
    
    $user_meta=get_userdata($user_id);

    $user_roles=$user_meta->roles;

    $data = $user_meta->data;

    $userRoles = $user_roles[0];  

    if($userRoles == 'consultant_editor'){

        $username = $data->user_login; 

        $username_md5 = md5($username); 

        $username_md5_substr = substr($username_md5,0, 10); 

        update_user_meta(1, 'meta_key_consultant_code', $username_md5_substr);

        //echo get_user_meta(1, 'meta_key_consultant_code', true); 

        //die();

    }

       
}


/*
* Show consultant code on user profile
*/
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { 

        $user_id = $_GET['user_id'];

        $user_meta=get_userdata($user_id);

        $user_roles=$user_meta->roles;

        $data = $user_meta->data;

        $userRoles = $user_roles[0];  

    if($userRoles == 'consultant_editor' || $userRoles == 'administrator'){
           
    ?>
    <table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Consultant Code"); ?></label></th>
        <td>
            <input disabled type="text" name="address" id="address" value="<?php echo get_user_meta(1, 'meta_key_consultant_code', true);?>" class="regular-text" /><br />
        </td>
    </tr>
    </table>
<?php  } 

}


/*
* Start::apply_consultant_code_function
*/
add_action( 'init', 'apply_consultant_code_function');

function apply_consultant_code_function(){

    if (isset($_POST['apply_consultant_code'])) {  
    
        if (isset($_POST['consultant_code']) && $_POST['consultant_code']!="") {
            $cons_code = $_POST['consultant_code'];

            /**/
            global $wpdb;
            $query =  'SELECT * FROM '.$wpdb->prefix.'usermeta where meta_key = "meta_key_consultant_code" and meta_value = "'.$cons_code.'"';

            $results = $wpdb->get_results( $query );

            echo sizeof($results);

            if (count($results) == 0) {
                WC()->session->__unset( 'session_consultant_code' );
                $msg = "Invailid Consultant Code";
                WC()->session->set( 'session_consultant_code_applyed_msg', $msg );
            }
            else
            {
                WC()->session->set( 'session_consultant_code', $cons_code );

                $msg = "Consultant Code Applyed";
                WC()->session->set( 'session_consultant_code_applyed_msg', $msg );
            }
            /**/
           
        }
        
    }
    
}
/*
* End::apply_consultant_code_function
*/




/*
* Set woocommerce cart calculate fees
*/
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


/*
* Update order meta for calculate
*/
add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');
function custom_checkout_field_update_order_meta($order_id){

    $get_session_update_order_meta = WC()->session->get( 'session_consultant_code');
    if ($get_session_consultant_code=!"") {
    update_post_meta($order_id, '_consultant_code', $get_session_update_order_meta);
    WC()->session->__unset( 'session_consultant_code' );
    WC()->session->__unset( 'session_consultant_code_applyed_msg' );
    }
    
}




/*
* Unset consultant session after order place session 
*/
add_action( 'woocommerce_thankyou', 'my_change_status_function' );
function my_change_status_function( $order_id ) {
    WC()->session->__unset( 'session_consultant_code' );
    WC()->session->__unset( 'session_consultant_code_applyed_msg' );
}





/*
* Show order meta as consultant name
*/
add_action( 'woocommerce_admin_order_data_after_order_details', 'misha_editable_order_meta_general' );
 
function misha_editable_order_meta_general( $order ){ 
$order_id = $order->id;

$_consultant_code = get_post_meta($order_id, '_consultant_code', true);

if ($_consultant_code!="") {
   
global $wpdb;
$query =  'SELECT * FROM '.$wpdb->prefix.'usermeta where meta_key = "meta_key_consultant_code" and meta_value = "'.$_consultant_code.'"';

$results = $wpdb->get_results( $query );
?>

<br class="clear" />
<div>
    <h3>Consultant Code: </h3><?php echo $_consultant_code; ?>
</div>
<div>
    

    <?php 
    foreach ($results as $key) 
    {
        $user_id = $key->user_id;
    }

    $user_meta=get_userdata($user_id);

    $user_roles=$user_meta->roles;

    $data = $user_meta->data;

    $userRoles = $user_roles[0];  

    if($userRoles == 'consultant_editor' || $userRoles == 'administrator'){

        $username = $data->user_login; 

    }
    ?>

    <h3>Consultant Name: </h3> <?php echo $username;?> 

</div>

<?php

}

}


/*
*
*/

/*
*
*/