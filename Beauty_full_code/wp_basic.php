<?php
//https://mail.google.com/mail/u/0/#inbox/FMfcgxwBTsgTHFhfZFFNgHKBbBzWgLrL

//https://wordpress.org/plugins/woocommerce-product-payments/

//Paypal lib https://github.com/angelleye/paypal-php-library?

//https://www.cloudways.com/blog/custom-field-woocommerce-checkout-page/


http://www.darwinbiler.com/creating-composer-package-library/






/**/
-SSH
ssh user_name@domain_name  -p 7822
password

pwd
cd public_html
cd sandbox


ssh dieseltruck11@dieseltruckpartsdirect.com   -p 7822
4BBP2ce5%Y
/**/





/*
* Admin search
*/
/*add_action('admin_head', 'maybe_modify_admin_css');

function maybe_modify_admin_css() {

    $args = array(
                    'posts_per_page'   => -1,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'tmmledger_customer',
                    'post_status'      => 'publish',
                );

                $query = new WP_Query( $args );

                if($query->have_posts()){

                    while( $query->have_posts() ) {  $query->the_post();

                       echo "pppppppppppppppppppppppppppppppp: ".get_the_ID();
                    }

                    wp_reset_postdata();
                }
}*/




/*add_filter( 'posts_join', 'segnalazioni_search_join' );
function segnalazioni_search_join ( $join ) {
    global $pagenow, $wpdb;

    // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
    if ( is_admin() && 'edit.php' === $pagenow && 'segnalazioni' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {    
        $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}

add_filter( 'posts_where', 'segnalazioni_search_where' );
function segnalazioni_search_where( $where ) {
    global $pagenow, $wpdb;

    // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
    if ( is_admin() && 'edit.php' === $pagenow && 'segnalazioni' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {
        $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
    }
    return $where;
}*/
/*
* Admin search
*/


/*
* Add login in menu
*/
add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );
function wti_loginout_menu_link( $items, $args ) {
   if ($args->menu == 'top-links') {
      if (is_user_logged_in()) {
         $items .= '<li class="right"><a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ) .'">'. __("My Account") .'</a></li>';
      } else {
         $items .= '<li class="right"><a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ) .'">'. __("Sign in or Create an account") .'</a></li>';
      }
   }
   return $items;
}

add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );
function wti_loginout_menu_link( $items, $args ) {
   if ($args->menu == 'top-links') {
      if (is_user_logged_in()) {
         $items .= '<li class="right"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li class="right"><a href="'. wp_login_url(get_permalink()) .'">'. __("Sign in or Create an account") .'</a></li>';
      }
   }
   return $items;
}
/*
* Add login in menu
*/



/*
* Get menu by location
*/
$menu_type = 'top_nav';

$locations = get_nav_menu_locations();
if ( isset( $locations[ $menu_type ] ) ) {

    echo "==>". $locations[ $menu_type ];

   $menu = get_term( $locations[ $menu_type ], 'nav_menu' );

   $items = wp_get_nav_menu_items( $menu->name );


   echo "<pre>"; print_r($menu); echo "</pre>";


    /*if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                      
      foreach ( $items as $item ) { 

          echo '<li>';

            echo '<a href="'.$item->url.'">';
              echo $item->title;
            echo '</a>';
           
          echo '</li>';
      }
    }*/
}


function wpmm_setup() {

    register_nav_menus( array(
        'top_nav' => 'Top nav'
    ) );
}
add_action( 'after_setup_theme', 'wpmm_setup' );


/*
* Get menu by location
*/



/*
* Wp bakery strip all visual composer shortcode/tags 
*/
function custom_wp_bakery_save_post_fun($post_id) {

    $get_post_type = get_post_type($post_id);

    $post_content = $_POST['post_content']; 

    WPBMap::addAllMappedShortcodes();

    $post_content_output = apply_filters( 'the_content', $post_content );

    if($get_post_type == 'post' || $get_post_type == 'page' || $get_post_type == 'product' ){

        update_post_meta($post_id, '_custom_wp_bakery_post_content', $post_content_output);

    }

}
add_action( 'save_post', 'custom_wp_bakery_save_post_fun', 12, 1);
/*
* Wp bakery strip all visual composer shortcode/tags 
*/



/*
* Template redirect
*/
add_action('template_redirect', 'single_view_disable');
function single_view_disable() {
    global $post;
    
    if(is_user_logged_in()){
        $custom_get_user_role = custom_get_user_role();
        if($custom_get_user_role == 0){
            if($post->ID == 146 || $post->ID == 144 || $post->ID == 111):
            // Redirect back home
            wp_redirect(home_url(), 301);
            exit;
            endif;
        }
    }
}
/*
* Template redirect
*/


/*
* Replace URL
*/
function replace_text_wps($text){
    $home_url = home_url();
    $replace = array(
        'http://www.prosportstickers.com' => $home_url //'http://66.117.14.108/~prosport',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter('the_content', 'replace_text_wps');
add_filter('the_excerpt', 'replace_text_wps');
/*
* Replace URL
*/



/*
* Nav menu
*/
$aventura_location_menu = 'top_nav';

    if ( has_nav_menu($aventura_location_menu) ) :
        wp_nav_menu( array(
            'theme_location' => $aventura_location_menu,
            'menu_class'     => 'nav navbar-nav collapse navbar-collapse tz-nav',
            'menu_id'        => 'tz-navbar-collapse-scroll',
            'container'      => '',
            'items_wrap' => '%3$s'
        ) ) ;
    endif;
/*
* Nav menu
*/



/*
*  Stop auto plugin update
*/
function my_filter_plugin_updates( $value ) {
   if( isset( $value->response['woocommerce-product-addons/woocommerce-product-addons.php'] ) ) {        
      unset( $value->response['woocommerce-product-addons/woocommerce-product-addons.php'] );
    }
    return $value;
 }
add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );
/*
*  Stop auto plugin update
*/




/*
* Upload image to wp
*/
function my_handle_attachment($file_handler,$post_id,$set_thu=false) {
  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );
  if ( is_numeric( $attach_id ) ) {
    update_post_meta( $post_id, '_my_file_upload', $attach_id );
  }
  return $attach_id;
}



//Upload image
if($_FILES){  
    foreach ($_FILES as $file => $array){
        
        if ($file == 'featured_image') {  

            if (!empty($array['name'])) {  
                
                $_thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                
                if(empty($_thumbnail_id)){
                    $attach_id = my_handle_attachment($file,$post_id);

                    update_post_meta($post_id, '_thumbnail_id', $attach_id);
                    //echo 'attach_id: '.$attach_id; echo '<br>';
                }
            }
        }
    }
}
//Upload image

/*
* Upload image to wp
*/


/*
* Upload image by url
*/
function crb_insert_attachment_from_url($url, $parent_post_id = null) {
    if( !class_exists( 'WP_Http' ) )
        include_once( ABSPATH . WPINC . '/class-http.php' );
    $http = new WP_Http();
    $response = $http->request( $url );

    /*if( $response['response']['code'] != 200 ) {
        return false;
    }*/
    
    $upload = wp_upload_bits( basename($url), null, $response['body'] );
    if( !empty( $upload['error'] ) ) {
        return false;
    }
    $file_path = $upload['file'];
    $file_name = basename( $file_path );
    $file_type = wp_check_filetype( $file_name, null );
    $attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
    $wp_upload_dir = wp_upload_dir();
    $post_info = array(
        'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
        'post_mime_type' => $file_type['type'],
        'post_title'     => $attachment_title,
        'post_content'   => '',
        'post_status'    => 'inherit',
    );
    // Create the attachment
    $attach_id = wp_insert_attachment( $post_info, $file_path, $parent_post_id );
    // Include image.php
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id,  $attach_data );
    return $attach_id;
}
/*
* Upload image by url
*/


/**/
echo htmlspecialchars_decode($variations);
/**/



/**/
function title_filter( $where, &$wp_query )
{
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
}

$args = array(
    'post_type' => 'product',
    'posts_per_page' => $page_size,
    'paged' => $page,
    'search_prod_title' => $search_term,
    'post_status' => 'publish',
    'orderby'     => 'title', 
    'order'       => 'ASC'
);

add_filter( 'posts_where', 'title_filter', 10, 2 );
$wp_query = new WP_Query($args);
remove_filter( 'posts_where', 'title_filter', 10, 2 );
return $wp_query;
/**/


/*
* Open PDF
*/
$full_path = '00001-2019.pdf';
$type  =  'inline'; //inline, attachment

header( 'Content-type: application/pdf' );
header( 'Content-Disposition: ' . $type . '; filename="' . basename( $full_path ) . '"' );
header( 'Content-Transfer-Encoding: binary' );
header( 'Content-Length: ' . filesize( $full_path ) );
header( 'Accept-Ranges: bytes' );

readfile( $full_path );
die();
/*
* Open PDF
*/


/*
* wp search add post type
*/
add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
function tgm_io_cpt_search( $query ) {
    
    if ( $query->is_search ) {
         $query->set( 'post_type', array( 'post', 'product', 'page' ) );
    }
    
    return $query;
    
}
/*
* wp search add post type
*/



  
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}



https://iconicwp.com/blog/update-custom-cart-count-html-ajax-add-cart-woocommerce/
// woocommerce addon
// js composer addon
// contact form7 addon
// Widget 

/*
* get theme mode
*/
$ppp = get_option('theme_mods_{theme-name}');

echo "<pre>";

echo '<h1>Testing</h1>';

//echo get_custom_logo( 37072 );

print_r($ppp);
echo "</pre>";
/*
* get theme mode
*/


/*
*  Start:wp_enqueue_scripts action
*/
function salient_child_enqueue_styles() {

    /*------------------parent-style-----------------------*/
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
    /*------------------parent-style-----------------------*/


    /*------------------child-style------------------------*/
    wp_register_style( 'Font_Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style('Font_Awesome');

    wp_register_style( 'Google_Apis', 'https://fonts.googleapis.com/css?family=Poppins:100,300,400,500,600,700,900' );
    wp_enqueue_style('Google_Apis');

    wp_enqueue_script( 'cus-js1',get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style('cus-css1', get_stylesheet_directory_uri() . '/assets/css/wc-quantity-increment.css', array(), '1.0', 'all' );
     /*------------------child-style------------------------*/


    //For plugin define( 'WOOREL_URI', plugin_dir_url( __FILE__ ) );
    wp_enqueue_script( 'cus-js1',WOOREL_URI . '/js/custom.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style('cus-css1', WOOREL_URI . '/assets/css/wc-quantity-increment.css', array(), '1.0', 'all' );


    $data = array(
        'product_id' => get_the_ID(),
        'ajaxurl'=> admin_url( 'admin-ajax.php'),
        'posturl'=> admin_url( 'admin-post.php')
    );
    wp_localize_script( 'cuspricecal_back_handle', 'datab', $data );


    wp_deregister_script( $handle );

    wp_deregister_style( $handle );

    wp_dequeue_script( $handle );

    wp_dequeue_style( $handle );
       

}
add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');

//OR

add_action( 'admin_enqueue_scripts', 'salient_child_enqueue_styles');



//Dequeue Styles
function project_dequeue_unnecessary_styles() {
    wp_dequeue_style( 'bootstrap-map' );
        wp_deregister_style( 'bootstrap-map' );
}
add_action( 'wp_print_styles', 'project_dequeue_unnecessary_styles' );

//Dequeue JavaScripts
function project_dequeue_unnecessary_scripts() {
    wp_dequeue_script( 'modernizr-js' );
        wp_deregister_script( 'modernizr-js' );
    wp_dequeue_script( 'project-js' );
        wp_deregister_script( 'project-js' );
}
add_action( 'wp_print_scripts', 'project_dequeue_unnecessary_scripts' );

/*
*  End:wp_enqueue_scripts action
*/



/*
* Start:Register custom post type
*/
 $labels = array(
        'name'               => _x( 'Hotels', 'post type general name' ),
        'singular_name'      => _x( 'Hotels', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New Hotels' ),
        'edit_item'          => __( 'Edit Hotels' ),
        'new_item'           => __( 'New Hotels Items' ),
        'all_items'          => __( 'All Hotels\'s' ),
        'view_item'          => __( 'View Hotels' ),
        'search_items'       => __( 'Search Hotels' ),
        'not_found'          => __( 'No Hotels Items found' ),
        'not_found_in_trash' => __( 'No Hotels Items found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Hotels'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds Hotels specific data',
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'rewrite'       => array('slug' => 'hotels'),
        'capability_type'=> 'post',
        'has_archive'   => true,
        'hierarchical'  => false,
        'menu_position' => 5,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        'menu_icon' => 'dashicons-welcome-write-blog'
    );

    register_post_type( 'hotels', $args );

  
    // Add new taxonomy travel_guide_cat
    $labels = array(
        'name'              => _x( 'Hotels Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Hotels Category', 'taxonomy singular name' ),
        'search_items'      =>  __( 'Search Hotels Categories' ),
        'all_items'         => __( 'All Hotels Category' ),
        'parent_item'       => __( 'Parent Hotels Category' ),
        'parent_item_colon' => __( 'Parent Hotels Category:' ),
        'edit_item'         => __( 'Edit Hotels Category' ),
        'update_item'       => __( 'Update Hotels Category' ),
        'add_new_item'      => __( 'Add New Hotels Category' ),
        'new_item_name'     => __( 'New Hotels Category Name' ),
        'menu_name'         => __( 'Hotels Categories' ),
    );

    register_taxonomy('hotels_cat',array('hotels'), array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => true,
        'rewrite'      => array( 'slug' => 'hotels-cat' ),
    ));
/*
* End:Register custom post type
*/



/*
* Start:Version 2 Add custom role to access spacifice post type
*/
function allow_new_role_uploads() {

    //remove_role("custom_user");
    add_role('custom_user','Custom User');

    // gets the administrator role
    $role = get_role( 'custom_user' );

    //Contributor
    $role->add_cap( 'delete_posts' );
    $role->add_cap( 'read');
    $role->add_cap( 'edit_posts' );

    $role->add_cap( 'read_psp_project');
    $role->add_cap( 'read_private_psp_projects' );
    $role->add_cap( 'edit_psp_project' );
    $role->add_cap( 'edit_psp_projects' );
    $role->add_cap( 'edit_others_psp_projects' );
    $role->add_cap( 'edit_published_psp_projects' );
    $role->add_cap( 'publish_psp_projects' );
    $role->add_cap( 'delete_others_psp_projects' );
    $role->add_cap( 'delete_private_psp_projects' );
    $role->add_cap( 'delete_published_psp_projects' );

}
add_action('admin_init', 'allow_new_role_uploads');



/*function custom_woocommerce_register_post_type_shop_order($args){

    $get_user_role = get_user_role('custom_user');
    if ($get_user_role) {
        $args['capability_type'] = "";
        $args['capability_type'] = array('shop_order','psp_projects');
        return $args;
    }
    return $args;

}
add_filter('woocommerce_register_post_type_shop_order', 'custom_woocommerce_register_post_type_shop_order');*/



function wp1482371_custom_post_type_args( $args, $post_type ) {

    $get_user_role = get_user_role('custom_user');
    if ($get_user_role) {
       if ( $post_type == "shop_order" ) {
            $args['capability_type'] = "";
            $args['capability_type'] = array('shop_order','psp_projects');
            return $args;
        }
    }
    return $args;
}
add_filter( 'register_post_type_args', 'wp1482371_custom_post_type_args', 20, 2 );


function pxln_remove_menu_items() {

    global $menu;

    $get_user_role = get_user_role('custom_user');
    if ($get_user_role) {
        unset($menu[25]);
        unset($menu[5]);
        unset($menu[11]);
        unset($menu[12]);
        unset($menu[75]);
        unset($menu[9]);
        //remove_menu_page( 'tools.php' );
    }
    
}
add_action('admin_menu', 'pxln_remove_menu_items');



function get_user_role($user_role){

    $user_id = get_current_user_id(); 
    $user_meta = get_userdata($user_id);
    $user_roles = $user_meta->roles;

    if ( in_array($user_role, $user_roles, true ) ) {
        return true;
    }else{
        return false;
    }

}
/*
* End:Version 2 Add custom role to access spacifice post type
*/




/*
* Start:Add custom role to access spacifice post type
*/
function codex_municipality_init() {
    $labels = array(
        'name'               => _x( 'Municipalities', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Municipality', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Municipalities', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Municipality', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'municipality', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Municipality', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Municipality', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Municipality', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Municipality', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Municipalities', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Municipalities', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Municipalities:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No municipalities found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No municipalities found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'municipality' ),
        //'capability_type'    => 'post',
        'capability_type'     => array('psp_project','psp_projects'),
        'map_meta_cap'        => true,
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'municipality', $args );         remove_menu_page( 'edit.php?post_type=cron_job' ); 
}


remove_role("psp_project_manager");

add_action('admin_init', 'allow_new_role_uploads');
function allow_new_role_uploads() {

    add_role('muncipality_user',
        'Muncipality User',
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
            'upload_files' => true,
        )
    );
}

add_action('admin_init','psp_add_role_caps',999);


function psp_add_role_caps() {

    // Add the roles you'd like to administer the custom post types
    $roles = array('muncipality_user');

    // Loop through each role and assign capabilities
    foreach($roles as $the_role) { 

         $role = get_role($the_role);
        
             $role->add_cap( 'read' );
             $role->add_cap( 'read_psp_project');
             $role->add_cap( 'read_private_psp_projects' );
             $role->add_cap( 'edit_psp_project' );
             $role->add_cap( 'edit_psp_projects' );
             $role->add_cap( 'edit_others_psp_projects' );
             $role->add_cap( 'edit_published_psp_projects' );
             $role->add_cap( 'publish_psp_projects' );
             $role->add_cap( 'delete_others_psp_projects' );
             $role->add_cap( 'delete_private_psp_projects' );
             $role->add_cap( 'delete_published_psp_projects' );

    }


}

function add_role_filter_to_posts_query( $query ) {

  if (isset($_GET['post_type'])) {

  }

    $user_id = get_current_user_id(); 
    $user_meta = get_userdata($user_id);
    $user_roles = $user_meta->roles;

    if ( in_array( 'muncipality_user', $user_roles, true ) ) {
       /* echo "<pre>";
        print_r($user_roles);
        echo "</pre>";*/
        $query->set( 'author__in', $user_id );
    }
}
add_action( 'pre_get_posts', 'add_role_filter_to_posts_query' );
/*
* End:Add custom role to access spacifice post type
*/


/*
* Start:register_post_type_args filter
*/ 
function wp1482371_custom_post_type_args( $args, $post_type ) {
    if ( $post_type == "testimonial" ) {
     
        $args['supports'] = array( 'title', 'editor', 'comments');

        $args['capability_type'] = array('psp_project','psp_projects'),

    }

    return $args;
}
add_filter( 'register_post_type_args', 'wp1482371_custom_post_type_args', 20, 2 );
/*
* End:register_post_type_args filter
*/ 



/*
* Start:add metabox
*/
add_action( 'add_meta_boxes', 'custom_admin_metabox');
function custom_admin_metabox(){

    add_meta_box( string $id, string $title, callable $callback, string|array|WP_Screen $screen = null, string $context = 'advanced', string $priority = 'default', array $callback_args = null )

    //context = 'normal', 'side', and 'advanced'. 
    //priority = 'high', 'low', default
    add_meta_box( 'call_back_function', 'Title', 'call_back_function', '{post_type}', 'normal', 'high' );

}

function call_back_function(){

  global $post;

  echo $$post->ID;

  $subtitle = get_post_meta( $post->ID, 'subtitle', true ); 

  ?>

   <input type="text" name="subtitle" value="<?php echo $subtitle;?>">

  <?php

}

add_action( 'save_post', 'destination_save_metabox', 1, 2 );
function destination_save_metabox( $post_id, $post ) {

    echo $post->ID;

    if (isset( $_POST['subtitle'] ) ) {
        $sanitized = wp_filter_post_kses( $_POST['subtitle'] );
        update_post_meta( $post->ID, 'subtitle', $sanitized );
    }
}
/*
* End:add metabox
*/




/*
*  Start:Add the custom fields to the "category" taxonomy, using our callback function  
*/

//https://www.webhat.in/article/woocommerce-tutorial/adding-custom-fields-to-woocommerce-product-category/


add_action( 'category_edit_form_fields', 'category_taxonomy_custom_fields', 10, 2 );  
add_action( 'category_add_form_fields', 'category_taxonomy_custom_fields', 10, 2 );  
// A callback function to add a custom field to our "category" taxonomy  
function category_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing   
?>  
  
<tr class="form-field">  
  <?php 
  //echo"___".get_term_meta($t_id, 'exlude_faq_cat', true);
  ?>

    <th scope="row" valign="top">  
        <label for="exlude_faq_cat"><?php _e('Exlude category from faq page'); ?></label>  
    </th>  
    <td>  
        <input type="checkbox" name="exlude_faq_cat" id="exlude_faq_cat"  value="Yes" <?php if (get_term_meta($t_id, 'exlude_faq_cat', true)!="") { echo 'checked="checked"';}?>> 
    </td>  
</tr>  
  
<?php  
}  


// Save the changes made on the "category" taxonomy, using our callback function  
add_action( 'edited_category', 'save_taxonomy_custom_fields', 10, 2 ); // A callback function to save our extra taxonomy field(s)  
add_action( 'create_category', 'save_taxonomy_custom_fields', 10, 2 );
function save_taxonomy_custom_fields( $term_id ) {  

  if (isset($_POST['exlude_faq_cat'])) {
    update_term_meta($term_id, 'exlude_faq_cat', $_POST['exlude_faq_cat']);
  }
  else{
    update_term_meta($term_id, 'exlude_faq_cat', '');
  }
    
}  



add_action( 'product_cat_edit_form_fields', 'fix_class_editor_fun', 10, 1 ); 
function fix_class_editor_fun($tag){

   wp_enqueue_editor();

  ?>
  <script>
  jQuery(function(){

    jQuery('#description').css('width', '100%');
    var editorSettings = {
      mediaButtons: true,
      tinymce: { 
        wpautop:true, 
        plugins : 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview', 
        toolbar1: 'formatselect bold italic | bullist numlist | blockquote | alignleft aligncenter alignright | link unlink | wp_more | spellchecker' 
      },
      quicktags: true
    };

    jQuery(function($){
      jQuery(document).ready(function() {
        wp.editor.initialize( 'description', editorSettings );
      });
    });

  });
  </script>
  <?php

}
/*
*  End:Add the fields to the "category" taxonomy, using our callback function  
*/



/*
* Start:custom user meta fields
*/
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
    <th><label for="company-vatid"><?php _e("Company Vatid"); ?></label></th>
        <td>
            <input type="text" name="company-vatid" id="company-vatid" value="<?php echo esc_attr( get_the_author_meta( 'company-vatid', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your company-vatid."); ?></span>
        </td>
    </tr>
    </table>
<?php }


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'company-vatid', $_POST['company-vatid'] );
}
/*
* End:custom user meta fields
*/



/*
* Start:Add custom column on post grid
*/
//filter grid column 
add_action( 'manage_edit-my_custom_activity_columns', 'my_custom_fun'); 
function my_custom_edit_movie_columns($columns) { 
    $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Title' ),
            'filetype' => __( 'File Type' ),
            'status' => __( 'Status' ),
            'updated_date' => __( 'Updated Date' ),
            'date' => __( 'Date' )
        );

    return $columns;
}


// add custom column valuse
add_action( 'manage_my_custom_activity_posts_custom_column', 'my_custom_fun', 10, 2); 
function my_custom_activity_columns( $column, $post_id ) { 

   switch( $column ) 
   {

        case 'filetype' :

            if ( empty( $filetype ) ) echo __( 'Unknown' ); else printf( __( '%s' ), $filetype );

            break;

        case 'status' :

             if ( empty( $filetype ) ) echo __( 'Unknown' ); else printf( __( '%s' ), $filetype );

            break;

        case 'updated_date' :

            if ( empty( $filetype ) ) echo __( 'Unknown' ); else printf( __( '%s' ), $filetype );

            break;

        default :
                break;
    }

}
/*
* End:Add custom column on post grid
*/



/*
* Start:Register Custom widgets and sidebar
*/
function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Header Widget Area',
        'id'            => 'custom-header-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );


    register_sidebar( array(
        'name' => __('Blog Sidebar One','wetime'),
        'id' => 'blog1'
    ) );
 
}
add_action( 'widgets_init', 'wpb_widgets_init' );


if ( is_active_sidebar( 'custom-header-widget' ) ) {

    ?>
    <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
    <?php dynamic_sidebar( 'custom-header-widget' ); ?>
    </div>
    <?php

}




function wpiw_widget() {
  register_widget( 'null_custom_menu_widget' );
}
add_action( 'widgets_init', 'wpiw_widget' );

Class null_custom_menu_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'null-custom-menu',__( 'Custom menu', 'wp-Custom menu-widget' ),
      array(
        'classname' => 'null-custom-menu',
        'description' => esc_html__( 'Displays custom menus', 'wp-Custom menu-widget' ),
        'customize_selective_refresh' => true,
      )
    );
  }

  function widget( $args, $instance ) {

    $title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
  
    $target = empty( $instance['target'] ) ? '_self' : $instance['target'];
    
    echo $args['before_widget'];

    if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };

    do_action( 'wpiw_before_widget', $instance );

    /**************/
    echo "==>".$title; echo "<br>";
    echo "==>".$target;
    /**************/

    do_action( 'wpiw_after_widget', $instance );

    echo $args['after_widget'];
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array(
      'title' => __( 'Custom menu', 'wp-Custom menu-widget' ),
      'target' => '_self',
    ) );
    $title = $instance['title'];
    $target = $instance['target'];
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_html_e( 'Title', 'wp-Custom menu-widget' ); ?>: 
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      </label>
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Select menu', 'wp-Custom menu-widget' ); ?>:
      </label>

      <select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">

        <option value="regions_menu" <?php selected( 'regions_menu', $target ); ?>>
          <?php esc_html_e( 'regions_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="popular_destinations_menu" <?php selected( 'popular_destinations_menu', $target ); ?>>
          <?php esc_html_e( 'popular_destinations_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="interest_types_menu" <?php selected( 'interest_types_menu', $target ); ?>>
          <?php esc_html_e( 'interest_types_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="safari_holidays_menu" <?php selected( 'safari_holidays_menu', $target ); ?>>
          <?php esc_html_e( 'safari_holidays_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="ideas_by_month_menu" <?php selected( 'ideas_by_month_menu', $target ); ?>>
          <?php esc_html_e( 'ideas_by_month_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="other_inspiration_menu" <?php selected( 'other_inspiration_menu', $target ); ?>>
          <?php esc_html_e( 'other_inspiration_menu', 'wp-Custom menu-widget' ); ?>
        </option>

      </select>
    </p>

    <?php

  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
  
    $instance['target'] = $new_instance['target'];

    return $instance;
  }

}

/*
* End:Register Custom widgets and sidebar
*/


/*
* Add dashboard widget
*/
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}
/*
* Add dashboard widget
*/




/*
* Start:add shortcode
*/
function acf_gallery_function($atts){

  extract( shortcode_atts(
        array(
           'id' => '',
            'content'  => '',
            "cat_id" => '',
            "cat_icon_class" => '',
            "image" => '',
            ), $atts )
    );

ob_start();


return ob_get_clean();
}
add_shortcode('acf_gallery_shortcode', 'acf_gallery_function');
/*
* End:add shortcode
*/




/*
* Start:after_setup_theme
*/
function wetime_theme_setup(){
    load_theme_textdomain( 'wetime', get_template_directory() . '/languages' );
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'wetime_theme_setup' );
/*
* End:after_setup_theme
*/



/*
* Start:Ajax action
*/
add_action( 'wp_ajax_{action_name}', 'ajax_function');
add_action( 'wp_ajax_nopriv_{action_name}', 'ajax_function');
function ajax_function(){
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}
?>
<script type="text/javascript">
    jQuery.ajax({
        url: data.ajaxurl,
        type: "POST",
        data: {'action': 'cuspricecal_my_action', 'productId': data.product_id,enterd_qty: qty, ammountofcolor: color},
        cache: false,
        dataType: 'json',
        beforeSend: function(){
        },
        complete: function(){
        },
        success: function (response) { 
        }
    });


     var qty = '111';
       
    jQuery.ajax({
        url: '<?php echo admin_url( 'admin-ajax.php');?>',
        type: "POST",
        data: {'action': 'set_whole_sale_data', enterd_qty: qty},
        cache: false,
        dataType: 'json',
        beforeSend: function(){
        },
        complete: function(){
        },
        success: function (response) {  alert(response);
        }
    });
</script>
<?php
/*
* End:Ajax action
*/


/*
* Start:Post action
*/
add_action('admin_post_{action_name}', 'post_function');
add_action('admin_post_nopriv_{action_name}','post_function');
function post_function{

    echo $_POST['first_name'];

    /*Upload image to upload folder*/
    if($_POST){
        if (!function_exists('wp_generate_attachment_metadata')){
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }

        /*echo "<pre>";
        print_r($_FILES);
        echo "</pre>";*/

        if($_FILES)
        {
            foreach ($_FILES as $file => $array)
            {
                
                if ($file == 'left_image') {

                    if (!empty($array['name'])) { 
                        //if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
                        $attach_id = media_handle_upload($file,$new_post);
                        update_user_meta( $user_id, $file, $attach_id );

                        //echo "==>".$attach_id; echo "<br>";
                    }
                    
                }

                if ($file == 'front_image') {

                    if (!empty($array['name'])) { 
                        //if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
                        $attach_id = media_handle_upload($file,$new_post);
                        update_user_meta( $user_id, $file, $attach_id );

                        //echo "==>".$attach_id; echo "<br>";
                    }
                    
                }

                if ($file == 'right_image') {

                    if (!empty($array['name'])) { 
                        //if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
                        $attach_id = media_handle_upload($file,$new_post);
                        update_user_meta( $user_id, $file, $attach_id );

                        //echo "==>".$attach_id; echo "<br>";
                    }
                    
                }
            }
        } 
    }
    /*Upload image to upload folder*/

    wp_redirect( $currenturl.'?reg=succ');
    exit();

}

?>
<form name="regform" id="regform" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">

<div>
    <label for="first_name"><?php echo _e('first_name', 'gs-users'); ?></label>
    <input type="text" name="first_name" id="first_name">
</div>

<div>
    <div>
        <input type="file" name="left_image" accept="image/*" onchange="loadFile_left(event)"/>
        <img id="output_left" style="width: 20%;" />
    </div>
    
    <div>
        <input type="file" name="front_image" accept="image/*" onchange="loadFile_front(event)"/>
        <img id="output_front" style="width: 20%;" />
    </div>
    
    <div>
        <input type="file" name="right_image" accept="image/*" onchange="loadFile_right(event)"/>
        <img id="output_right" style="width: 20%;" />
    </div>

    <script>
      var loadFile_left = function(event) {
        var output_left = document.getElementById('output_left');
        output_left.src = URL.createObjectURL(event.target.files[0]);
      };
      var loadFile_front = function(event) {
        var output_front = document.getElementById('output_front');
        output_front.src = URL.createObjectURL(event.target.files[0]);
      };
      var loadFile_right = function(event) {
        var output_right= document.getElementById('output_right');
        output_right.src = URL.createObjectURL(event.target.files[0]);
      };
    </script>
    <!-- <input type="file" id="i_file" value=""> 
    <img src="" width="200" style="display:none;" />

    <script type="text/javascript">
    $('#i_file').change( function(event) {

        var file_url =  URL.createObjectURL(event.target.files[0]);

        console.log(file_url);

        $("img").fadeIn("fast").attr('src',file_url );
    });
    </script> -->
</div>


<input type="hidden" name="action" value="gs_user_reg_action">

<input type="submit" value="Submit">

</form>
<?php
/*
* End:Post action
*/




/*
* Start:Upload when user logged in
*/

function consultant_image_uploader_field( $name, $value = '') {

$image = ' button">Upload Image';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {

$image = '"><img src="' . $image_attributes[0] . '" style="max-width:15%;display:block;" />';
$display = 'inline-block';
}

$htm = '<a class="fancybox-buttons" data-fancybox-group="button" href="'.$image_attributes[0].'">Preview</a>';

return '<div>
<a href="#" class="consultant_upload_image_button' . $image . '</a>
<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
<a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
</div>'.$htm;

}

function rr_scripts() {

  if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
  }
}

add_action( 'wp_enqueue_scripts', 'rr_scripts' );
add_action( 'admin_enqueue_scripts', 'rr_scripts' );

?>
 <!---->
  <h3><?php _e("Model Images"); ?></h3>
  <table class="form-table">
  <tr>
  <th>
      <label><?php _e("Left image"); ?></label></th>
      <td>
          <?php echo consultant_image_uploader_field('left_image', get_the_author_meta( 'left_image', $user->ID ) );?>
      </td>
  </tr>
  <th>
      <label><?php _e("Front Image"); ?></label></th>
      <td>
          <?php echo consultant_image_uploader_field('front_image', get_the_author_meta( 'front_image', $user->ID ) );?>
      </td>
  </tr>
  <th>
      <label><?php _e("Right Image"); ?></label></th>
      <td>
          <?php echo consultant_image_uploader_field('right_image', get_the_author_meta( 'right_image', $user->ID ) );?>
      </td>
  </tr>
  </table>
  <script type="text/javascript">
     jQuery(document).ready(function(){

        //Upload image
        jQuery('body').on('click', '.consultant_upload_image_button', function(e){
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
          jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:15%;display:block;" />').next().val(attachment.id).next().show();
          })
          .open();
          });

         get_the_ID
        jQuery('body').on('click', '.misha_remove_image_button', function(){
            jQuery(this).hide().prev().val('').prev().addClass('button').html('Upload image');
            return false;
        });

     });
  </script>
  <!---->
<?php
/*
* End:Upload when user logged in
*/



/* 
* Start:Post argument
*/

//Posts arguments 
https://www.billerickson.net/code/wp_query-arguments/


$args = array( //77392
    'posts_per_page'   => -1,
    'offset'           => 0,
    'category'         => $kategory,
    'category_name'    => '',

    'meta_key' => 'client_feedback_score',
    'orderby' => 'meta_value_num',
    'order'            => 'DESC',


    'category__in'     => array(),
    'post__in'         => array(),
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'post_type'        => 'post',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
    'author_name'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true,
    'fields'           => '',
    'meta_query'    => array(
        'relation'      => 'AND',
        array(
            'key'       => $field_1,
            'value'     => '1',
            'compare'   => 'LIKE',
        ),
        array(
            'key'       => $field_2,
            'value'     => '1',
            'compare'   => 'LIKE',
        ),
        array(
            'key' => '_price',
            'value' => array(50, 100),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        )
    ),
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'hotels_cat',
            'field'    => 'term_id',
            'terms'    => $category,
            'operator' => 'IN'
        )
    ),
    'date_query'     => array( 'after' => $search_date ),
);


/*$args = array(
    'posts_per_page'   => 10,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'shop_order',
    'post_status'      => 'any',
    'meta_query'    => array(
        array(
            'key'       => 'wholesaler_payment_invoice_id',
            'value'     => 'INV2-P6MN-QVHU-25SW-2LMU',
            'compare'   => '=',
        )
    )
);


$query = new WP_Query( $args );

echo "<pre>";
print_r($query->posts);
echo "</pre>";*/




// The Query
//$query = new WP_Query( $args );
$post_query_1 = get_posts($args);

if($post_query_1->have_posts()){

    while( $post_query_1->have_posts() ) { 
        $post_query_1->the_post();

        get_the_ID(); 
        get_the_title(); 
        get_post_thumbnail_id();
        echo substr(strip_tags(get_the_content()),0,25)
        get_the_excerpt();

    }

}



add_action('init', 'chile_init_fun');

function chile_init_fun(){ 

    //echo "PPPPPPP";

    $args = array(
    'posts_per_page'   => 10,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish'
    );

    $ppppp = get_posts($args);

    echo "<pre>";
    print_r($ppppp);
    echo "</pre>";



    $args = array(
    'posts_per_page'   => 10,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish'
    );


    $query = new WP_Query( $args );


    if($query->have_posts()){

        while( $query->have_posts() ) { 
            $query->the_post();

            get_the_ID(); 
            get_the_title(); 
            $image = get_post_thumbnail_id();


            echo substr(strip_tags(get_the_content()),0,25)
            get_the_excerpt();


            $image_size = 'full'; // (thumbnail, medium, large, full or custom size)
            
            $image_attributes_thumbnail = wp_get_attachment_image_src( $image, $image_size );



        }

        wp_reset_postdata();

    }


}





//
    $args = array(
        'posts_per_page'   => 10,
        'post__in'         =>array($postID),
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'property',
        'post_status'      => 'publish',
    );

    $query = new WP_Query( $args );


    if($query->have_posts()){

        while( $query->have_posts() ) {  $query->the_post();

                $post_thumbnail_id = get_post_thumbnail_id();

                if (!empty($post_thumbnail_id)) {
                    $image_size = 'medium'; // (thumbnail, medium, large, full or custom size)
                    $img_url_arr = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );

                    $img_url = $img_url_arr[0];

                }else{
                    $img_url = home_url().'/wp-content/uploads/2019/11/home-bg-image.jpg';
                }

            ?>
            <div>
                <a href="<?php echo get_permalink();?>">
                    <img src="<?php echo $img_url?>" style="width: 150px;">
                </a>
                <div><?php echo get_the_title();?></div>
                <div><?php echo get_field('property_price', get_the_ID());?> AED</div>
            </div>
            <?php
        }

        wp_reset_postdata();

    }else{
        echo 'no post'; echo "<br>";
    }
    //

                

/* 
* End:Post argument
*/





/*
* Start:Get child pages link
*/
function wpb_list_child_pages() { 

    global $post; 

    if ( is_page() && $post->post_parent )
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
    else
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
    if ( $childpages ) {
        $string = '
        <nav class="page-nav">
            <h3>Navigation Title</h3>
               <ul>
                   <li><a href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a></li>'
                   .$childpages.
               '</ul>
        </nav>';
    }
    return $string;
}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');
/*
* End:Get child pages link
*/




/*
* get_next_post and  get_previous_post
*/
$next_post = get_next_post();
if ( is_a( $next_post , 'WP_Post' ) ) : 
echo '<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?>--Next</a>';
endif; 

$prev_post = get_previous_post();
if (!empty( $prev_post )):
  echo '<a href="<?php echo $prev_post->guid ?>"><?php echo $prev_post->post_title ?>--Pre</a>';
endif
/*
* get_next_post and  get_previous_post
*/


/*
* Start:Define custom image size
*/
$image_size = 'full'; // (thumbnail, medium, large, full or custom size)
add_theme_support('post-thumbnails');
add_image_size('news-big', 370, 240, true);
add_image_size('news-small',270,150,true);
add_image_size('portfolio-big',370,500,true);
add_image_size('portfolio-small',270,350,true);
add_image_size('client',200,150,false);
$image_attributes_thumbnail = wp_get_attachment_image_src( $image, 'custom size' );
$image_attributes_thumbnail = wp_get_attachment_image( $image, 'custom size' );
/*
* End:Define custom image size
*/


/* 
* Start:remove space by _
*/
preg_replace('/[[:space:]]+/', '_', $destination_subtitle)

/* 
* End:remove space by _
*/


/*
* Start:remove html get string content by strip_tags()
*/
echo substr(strip_tags(get_the_content()),0,25)
/*
* End:remove html get string content
*/



/*
* Start:get fields
*/
$fields = acf_get_fields('1435'); //afc post id
/*
* End:get fields
*/


/*
* Start:change avtar image
*/
add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
function wpb_new_gravatar ($avatar_defaults) {
 $myavatar = 'https://s3-eu-west-2.amazonaws.com/wetimefase2/demo/wp-content/uploads/2018/03/24072334/user.png';
 $avatar_defaults[$myavatar] = "Default Gravatar";
 return $avatar_defaults;
}
/*
* End:change avtar image
*/



/* 
* Start:add pagination
*/ 

echo '<style>.pagination {
    clear:both;
    position:relative;
    font-size:11px; /* Pagination text size */
    line-height:13px;
        margin: 0 auto;
    width: 40%;
}
 
.pagination span, .pagination a {
    display:block;
    float:left;
    margin: 2px 2px 2px 0;
    padding:6px 9px 5px 9px;
    text-decoration:none;
    width:auto;
    color:#fff; /* Pagination text color */
    background: #555; /* Pagination non-active background color */
    -webkit-transition: background .15s ease-in-out;
    -moz-transition: background .15s ease-in-out;
    -ms-transition: background .15s ease-in-out;
    -o-transition: background .15s ease-in-out;
    transition: background .15s ease-in-out;
}
 
.pagination a:hover{
    color:#fff;
    background: #6AAC70; /* Pagination background on hover */
}
 
.pagination .current{
    padding:6px 9px 5px 9px;
    background: #6AAC70; /* Current page background */
    color:#fff;
}</style>';


function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}



$args = array(
        'posts_per_page'   => 25,
        'paged'            => $paged,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'product',
        'post_status'      => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $cate_trem_ids,
                'operator' => 'IN'
            )
        )
    );

  $loop = new WP_Query($args);


pagination($loop->max_num_pages); 
/* 
* End add pagination
*/ 



/*
* Start:get sub category by cat id
*/
$args = array(
    'type'                     => 'product',
    'child_of'                 => 0,
    'parent'                   => '',
    'orderby'                  => 'term_group',
    'hide_empty'               => false,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'product_cat',
    'pad_counts'               => false
);

$cats = get_categories( $args );
//var_dump($cat);
foreach( $cats as $cat ){
    echo $cat->name.', ';
}

function woocommerce_subcats_from_parentcat_by_ID($parent_cat_ID) {
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $parent_cat_ID,
        'taxonomy' => 'product_cat'
        );
    $subcats = get_categories($args);
    echo '<ul class="wooc_sclist">';
            foreach ($subcats as $sc) {
                $link = get_term_link( $sc->slug, $sc->taxonomy );
                    echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
                    $thumbnail_id = get_woocommerce_term_meta( $sc->term_id, 'thumbnail_id', true );
                    echo $image = wp_get_attachment_url( $thumbnail_id );
                }
    echo '</ul>';
}
    
function upcoming_events(){ 
    $cate = get_queried_object();
    $cateID = $cate->term_id;
    woocommerce_subcats_from_parentcat_by_ID($cateID);
}
add_shortcode( 'get_upcoming_events_list', 'upcoming_events' );
/*
* End:get sub category by cat id
*/

sizeof()

/*
* get post category by post id 
* Return textonomi detaisl + categoty details like category count, description etc..
*/

//get term id by post and textonomi
//Note : working for both native and custom post_type
get_the_terms( int|object $post, string $taxonomy )

//get category by post id
//Note : This is working only for native post_type
get_the_category( $post_id ) //post id



//get all categories by textonomi
get_terms(); //taxonomy

//get single category by term id
get_term( int|WP_Term|object $term, string $taxonomy = '', string $output = OBJECT, string $filter = 'raw' )

//get single category by term id
//Note : It is working only for native post_type
get_category( int|object $category, string $output = OBJECT, string $filter = 'raw' )



//Get child category
$args = array(
       'hierarchical' => 1,
       'show_option_none' => '',
       'hide_empty' => 0,
       'parent' => $term_id,
       'taxonomy' => $taxonomy,
       //'orderby' => 'term_id',
       //'order'   => 'DESC'
    );
get_categories( $args ) 






$category_slug = 'demo-cat';
$taxonomy = 'product_cat';
$get_term = get_term_by( 'slug', $category_slug , $taxonomy );
echo $term_id =  $get_term->term_id;

$args = array(
   'hierarchical' => 1,
   'show_option_none' => '',
   'hide_empty' => 0,
   'parent' => $term_id,
   'taxonomy' => $taxonomy
);
$subcats = get_categories($args);
  
echo '<pre>';
print_r($subcats);
echo '</pre>';

echo '<ul class="wooc_sclist">';
foreach ($subcats as $sc) {
$link = get_term_link( $sc->slug, $sc->taxonomy );
  echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
}
echo '</ul>';

/*
* get post category by post id 
* Return textonomi detaisl + categoty details like category count, description etc..
*/



/*
* Start:get path
*/
echo plugin_dir_path( dirname( __FILE__ ) ); //Get current directory path   

echo plugin_dir_url( dirname( __FILE__ ) );  //Get current directory url  

echo home_url();
 
echo get_stylesheet_directory_uri();

echo get_template_directory_uri();
/*
* End:get path
*/



/*
* Start:aad admin menus
*/
add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

$parent_slug = 'edit.php?post_type=my_custom_activity';

add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )

add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);

//$capability ==>The capability required for this menu to be displayed to the user."manage_options"
/*
* End:aad admin menus
*/



/*
* Start:create file in upload folder
*/
$mode = 'css';
$uploadDir = wp_upload_dir();
if (!is_dir($uploadDir['basedir'].'/gs_my_custom_fundir'))
    mkdir($uploadDir['basedir'].'/gs_my_custom_fundir') or wp_send_json_error();
$outputFile = $uploadDir['basedir'].'/gs_my_custom_fundir/custom.'.($mode == 'css' ? 'css' : 'js');
if (file_put_contents($outputFile, 'jjjjjjjjjjjjjjjjjjjjjj') === false)
    wp_send_json_error();
/*
* End:create file in upload folder
*/



/*
* Start:Get month list from April to March
*/
$months = array();
for ($i = 0; $i < 12; $i++) {
$timestamp = mktime(0, 0, 0, date('n') + $i, 1);
$months[date('n', $timestamp)] = date("M 'y", $timestamp);
}

echo "<pre>";
print_r($months);
echo "</pre>";


for ($m=1; $m<=12; $m++) {
   $month = date('F', mktime(0,0,0,$m));
   echo $month. '<br>';
}
/*
* End:Get month list from April to March
*/




/*
* Start:Basic hooks
*/
add_action( 'admin_enqueue_scripts', 'enqueue_fun' ); 

add_action( 'wp_enqueue_scripts', 'enqueue_fun' ); 

add_action( 'admin_head', 'my_custom_fun' ); 

add_action( 'wp_head', 'my_custom_fun' ); 

add_action( 'admin_footer', 'my_custom_fun' );

add_action( 'wp_footer', 'my_custom_fun' );

add_action( 'admin_init', 'my_custom_fun' ); //both

add_action( 'init', 'my_custom_fun' ); //both

add_action( 'admin_menu', 'my_custom_fun' ); // Add menu backend


add_action( 'save_post', 'my_custom_fun' );
function my_custom_fun($post_id){

    //update postmeta

}


/*
* Cusrom hooks
*/
do_action('wporg_after_settings_page_html');
add_action('wporg_after_settings_page_html', 'custom_fun');
function custom_fun(){
    echo "<h1>Good work</h1>";
}



$post_type_params = array(1,2,3,4,5,6,7,8);
apply_filters('wporg_post_type_params', $post_type_params);
         
add_filter('wporg_post_type_params',  'custom_fun_two', 1);
function custom_fun_two($data){

    unset($data[1]);
    $data['1'] = 2222;
    return $data;
}

/*
* Cusrom hooks
*/

echo get_permalink($postId); 

echo url_to_postid($url);

if (is_front_page()) {
    echo "fron";
}

if (is_page(2711)) {
    echo "fron";
}

if (is_user_logged_in()) { 

}

if (is_admin()) {
    
}




global $wpdb;

$query =  "SELECT * FROM ".$wpdb->prefix."dsplite_program";

$results = $wpdb->get_results( $query );
print_r($results);

foreach ($results as $key) 
{
    echo $key->schedulingId;

    $sql =  "UPDATE ".$wpdb->prefix."ds_scheduling SET playduration = '123' WHERE id=".$key->schedulingId;;
    $wpdb->query($sql);

}


$wpdb->insert( 
'wp_dsplite_program', 
array( 
    'name' => 'value1', 
    'change_date' => 123 
), 
array( 
    '%s', 
    '%d' 
) 
);

$wpdb->update( 
'wp_dsplite_program', 
array( 
    'name' => 'value1', // string
    'change_date' => 22 // integer (number) 
), 
array( 'ID' => 61 ), 
array( 
    '%s',   // value1
    '%d'    // value2
), 
array( '%d' ) 
);


// Using where formatting.
$wpdb->delete( 'wp_dsplite_program', array( 'ID' => 61 ), array( '%d' ) );


//Running General Queries
$wpdb->query('query'); 




//$sql = $wpdb->prepare( 'query' , value_parameter[, value_parameter ... ] );

$metakey = "Harriet's Adages";
$metavalue = "WordPress' database interface is like Sunday Morning: Easy.";

$wpdb->query( $wpdb->prepare( 
    "
        INSERT INTO $wpdb->postmeta
        ( post_id, meta_key, meta_value )
        VALUES ( %d, %s, %s )
    ", 
        array(
        10, 
        $metakey, 
        $metavalue
    ) 
) );


/*
* End:Basic hooks
*/















function customwooupdateqty_shortcode() {

    ob_start();
    
    $paged = ( get_query_var('paged') ? get_query_var('paged') : 1 );
   
    $loop = new WP_Query( array( 'post_type' => 'product', 'category_name' => '', 'posts_per_page'   => 10, 'paged' => $paged) );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            

        <div class="pindex">
            <?php 

            $product_id = get_the_id();

            $_stock = get_post_meta( $product_id, '_stock', true );

            $title = get_the_title();  echo "<br>";

            $_stock_status = get_post_meta($product_id, '_stock_status', true);

            $_manage_stock = get_post_meta($product_id, '_manage_stock', true);

            $product = wc_get_product($product_id);


            if ($product->is_type('simple') ) {
                $product_type = 'simple';        
            }elseif ($product->is_type('variable') ) {
                $product_type = 'variable';   

               /* $childs = $product->get_children();
                echo "<pre>";
                print_r($childs);*/

            }
            else{
                //
            }

            echo '<h3>product_type : '.$product_type; echo "</h3><br>";

            if($_stock == 0 && $_stock!=NULL && $_manage_stock == 'yes' && $_stock_status == 'instock' && $product_type == 'simple')
            {
                echo "If Qty = 0, _manage_stock = yes and _stock_status = instock, simple"; echo "<br>";
                echo 'title: '.$title; echo "<br>";
                echo 'product_id: '.$product_id; echo "<br>";
                echo '_stock: '.$_stock; echo "<br>";
                echo '_manage_stock: '.$_manage_stock; echo "<br>";
                echo '_stock_status: '.$_stock_status; echo "<br>";
                //update_post_meta($product_id, '_manage_stock', 'no');
                //update_post_meta($product_id, '_stock_status', 'outofstock'); // //instock  outofstock
            }
            else
            {
                echo "Qty:true"; echo "<br>";
                echo 'title: '.$title; echo "<br>";
                echo 'product_id: '.$product_id; echo "<br>";
                echo '_stock: '.$_stock; echo "<br>";
                echo '_manage_stock: '.$_manage_stock; echo "<br>";
                echo '_stock_status: '.$_stock_status; echo "<br>";
            }
            ?>
        </div>


        <?php endwhile;
       

        /* 
        * add pagination
        */ 

                echo '<style>.pagination {
                    clear:both;
                    position:relative;
                    font-size:11px; /* Pagination text size */
                    line-height:13px;
                        margin: 0 auto;
                    width: 40%;
                }
                 
                .pagination span, .pagination a {
                    display:block;
                    float:left;
                    margin: 2px 2px 2px 0;
                    padding:6px 9px 5px 9px;
                    text-decoration:none;
                    width:auto;
                    color:#fff; /* Pagination text color */
                    background: #555; /* Pagination non-active background color */
                    -webkit-transition: background .15s ease-in-out;
                    -moz-transition: background .15s ease-in-out;
                    -ms-transition: background .15s ease-in-out;
                    -o-transition: background .15s ease-in-out;
                    transition: background .15s ease-in-out;
                }
                 
                .pagination a:hover{
                    color:#fff;
                    background: #6AAC70; /* Pagination background on hover */
                }
                 
                .pagination .current{
                    padding:6px 9px 5px 9px;
                    background: #6AAC70; /* Current page background */
                    color:#fff;
                }</style>';


                function pagination($pages = '', $range = 4)
                {  
                     $showitems = ($range * 2)+1;  
                 
                     global $paged;
                     if(empty($paged)) $paged = 1;
                 
                     if($pages == '')
                     {
                         global $wp_query;
                         $pages = $wp_query->max_num_pages;
                         if(!$pages)
                         {
                             $pages = 1;
                         }
                     }   
                 
                     if(1 != $pages)
                     {
                         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
                         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
                         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
                 
                         for ($i=1; $i <= $pages; $i++)
                         {
                             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                             {
                                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                             }
                         }
                 
                         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
                         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
                         echo "</div>\n";
                     }
                }
  
                pagination($loop->max_num_pages); 
        /* 
        * add pagination
        */ 


    endif;
    wp_reset_postdata();

        
    
        /**/

    $output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}
//add_shortcode('custom-woo-update-qty', 'customwooupdateqty_shortcode');




















foreach( array( 'edit-post', 'edit-page', 'edit-movie', 'upload' ) as $hook )

add_filter( "views_$hook" , 'wpse_30331_custom_view_count', 10, 1);

function wpse_30331_custom_view_count( $views ) 
{
    global $current_screen;
    switch( $current_screen->id ) 
    {
        case 'edit-post':
            $views = wpse_30331_manipulate_views( 'post', $views );
            break;
        case 'edit-page':
            $views = wpse_30331_manipulate_views( 'page', $views );
            break;
    }
    return $views;
}

function wpse_30331_manipulate_views( $what, $views )
{
    global $user_ID, $wpdb;

    /*
     * This is not working for me, 'artist' and 'administrator' are passing this condition (?)
     */
    if ( !current_user_can('artist') ) 
        return $views;

    /*
     * This needs refining, and maybe a better method
     * e.g. Attachments have completely different counts 
     */
    $total = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_status = 'publish' OR post_status = 'draft' OR post_status = 'pending') AND (post_author = '$user_ID'  AND post_type = '$what' ) ");
    $publish = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_author = '$user_ID' AND post_type = '$what' ");
    $draft = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'draft' AND post_author = '$user_ID' AND post_type = '$what' ");
    $pending = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'pending' AND post_author = '$user_ID' AND post_type = '$what' ");

    /*
     * Only tested with Posts/Pages
     * - there are moments where Draft and Pending shouldn't return any value
     */
    $views['all'] = preg_replace( '/\(.+\)/U', '('.$total.')', $views['all'] ); 
    $views['publish'] = preg_replace( '/\(.+\)/U', '('.$publish.')', $views['publish'] ); 
    $views['draft'] = preg_replace( '/\(.+\)/U', '('.$draft.')', $views['draft'] ); 
    $views['pending'] = preg_replace( '/\(.+\)/U', '('.$pending.')', $views['pending'] ); 

    // Debug info
    //echo 'Default counts: <pre>'.print_r($views,true).'</pre>';
    //echo '<hr><hr>';
    //echo 'Query for this screen of this post_type: <b>'.$what.'</b><pre>'.print_r($wp_query,true).'</pre>';

    return $views;

    print_r(expression)
}



/*
* Registerted custom menus
*/
function wpmm_setup() {

    register_nav_menus( array(
        'regions_menu' => 'Regions Menu'
    ) );

    register_nav_menus( array(
        'popular_destinations_menu' => 'Most Popular destinations Menu'
    ) );

    register_nav_menus( array(
        'interest_types_menu' => 'Interest types Menu'
    ) );

    register_nav_menus( array(
        'safari_holidays_menu' => 'Safari holidays Menu'
    ) );

    register_nav_menus( array(
        'ideas_by_month_menu' => 'Ideas by month Menu'
    ) );

    register_nav_menus( array(
        'other_inspiration_menu' => 'Other inspiration Menu'
    ) );

}
add_action( 'after_setup_theme', 'wpmm_setup' );

wp_nav_menu( array(
    'theme_location' => $aventura_location_menu,
    'menu_class'     => 'nav navbar-nav collapse navbar-collapse tz-nav',
    'menu_id'        => 'tz-navbar-collapse-scroll',
    'container'      => false,
) ) ;

wp_nav_menu(array(
    'theme_location' => 'bar',
    'items_wrap'     => '<ul id="%1$s" class="fl-page-bar-nav nav navbar-nav %2$s">%3$s</ul>',
    'container'      => false,
    'fallback_cb'    => 'FLTheme::nav_menu_fallback',
    
    'menu_id' => 'custom_right_menu_id',
    'menu_class' => 'custom_right_menu_class',
));

if ($menu_type == 'regions_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

      <?php 

    }
/*
* Registerted custom menus
*/



/*
* Template hierarchy
*/
Category:
archive.php 
archive-{post_type}.php 

category-slug.php
category-ID.php
category.php

taxonomy-{taxonomy}-{term}.php
taxonomy-{taxonomy}.php
tag-{slug}.php
tag-{id}.php
category-{slug}.php
category-{ID}.php

/*
* Template hierarchy
*/


?>












<?php
//Place order programmatically

if (isset($_POST['isOrder']) && $_POST['isOrder'] == 1) {
    $address = array(
        'first_name' => $_POST['notes']['domain'],
        'last_name'  => '',
        'company'    => $_POST['customer']['company'],
        'email'      => $_POST['customer']['email'],
        'phone'      => $_POST['customer']['phone'],
        'address_1'  => $_POST['customer']['address'],
        'address_2'  => '', 
        'city'       => $_POST['customer']['city'],
        'state'      => '',
        'postcode'   => $_POST['customer']['postalcode'],
        'country'    => 'NL'
    );

    $order = wc_create_order();
    foreach ($_POST['product_order'] as $productId => $productOrdered) :
        $order->add_product( get_product( $productId ), 1 );
    endforeach;

    $order->set_address( $address, 'billing' );
    $order->set_address( $address, 'shipping' );

    $order->calculate_totals();

    update_post_meta( $order->id, '_payment_method', 'ideal' );
    update_post_meta( $order->id, '_payment_method_title', 'iDeal' );

    // Store Order ID in session so it can be re-used after payment failure
    WC()->session->order_awaiting_payment = $order->id;

    // Process Payment
    $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
    $result = $available_gateways[ 'ideal' ]->process_payment( $order->id );

    // Redirect to success/confirmation/payment page
    if ( $result['result'] == 'success' ) {

        $result = apply_filters( 'woocommerce_payment_successful_result', $result, $order->id );

        wp_redirect( $result['redirect'] );
        exit;
    }
}
?>


<?php


Cron job::

wget https://funtimepartyhire.com.au/admin-panel/daily_status_mailer.php
wget -q -O — http://yourwebsite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1


wget https://funtimepartyhire.com.au/mail_test.php
wget https://funtimepartyhire.com.au/mail_test.php working

/usr/bin/curl --user-agent DIESEL-CronRfrshToken https://www.dieseltruckpartsdirect.com/qb/OAuth_2/RefreshToken.php?k=843536d7-d62b-9c15-1ae5-57654324bbbad8


?>


<?php
/*
* Sent Net30 invoice mail with attachments
*/
function cusrom_send_mailer(){
    
    $attachments = array(WP_CONTENT_DIR . '/uploads/net30-pdf/Test-1.pdf');
    
    $to = "gaurav.clagtech@gmail.com";
    $subject = "Test";
    $message = "Testing! cron.php  55";
    $headers = "From: miller.clagtech@gmail.com";;
    
    $result = wp_mail( $to, $subject, $message, $headers, $attachments );
    
    if($result)
    {
        echo "cron send";
    }
    else{
        
        echo "cron not send";
    }
}



$to = "gaurav.clagtech@gmail.com";
$subject = "Test";
$txt = "Testing! cron.php  55";
$headers = "From: miller.clagtech@gmail.com";;


$result = mail($to,$subject,$txt,$headers);

if($result)
{
    echo "cron send";
}
else{
    echo "cron not send";
}







$to = "peter.quickfix@gmail.com";
$subject = "Test";
$txt = "Testing! cron.php  55";
$headers = "From: peter.quickfix@gmail.com";;


$result = mail($to,$subject,$txt,$headers);

if($result)
{
    echo "csend";
}
else{
    echo "not send";
}















function custom_set_timer_fun($atts){

  extract( shortcode_atts(
        array(
           'id' => '',
            ), $atts )
    );

ob_start();


if (is_user_logged_in()) {



    $user_id = get_current_user_id();

    $minutes_to_add = 10;

    $curr_date = date("Y-m-d H:i:s", strtotime("now"));

    echo 'curr_date: '.$curr_date; echo "<br><br>";

    $time = new DateTime($curr_date);

    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

    $stamp = $time->format('Y-m-d H:i:s'); echo "<br><br>";

    //update_option('_minute_countdown', $stamp);


    $_minute_countdown = get_option('_minute_countdown');

    if ($_minute_countdown && !empty($_minute_countdown)) {
      
        echo 'saved date:  '.$_minute_countdown; echo "<br><br>";

        $get_min_sec = date_create($_minute_countdown);

        $get_min_sec_1 = date_format($get_min_sec,"i:s");

        $get_min = (int)date_format($get_min_sec,"i");

        $get_cal_sec = (int)date_format($get_min_sec,"i")*60;

        echo 'min sec:  '.$get_min_sec_1; echo "<br>";
        echo 'min:  '.$get_min; echo "<br>";
        echo 'cal sec:  '.$get_cal_sec; echo "<br>";

        if ($_minute_countdown > $curr_date) {
          echo "valide";
          ?>
          <div class="countdown"></div>
          <!-- <script type="text/javascript">
            jQuery(document).ready(function() {

              var timer2 = "<?php //echo $get_min_sec_1; ?>";
              var interval = setInterval(function() {
                var timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                jQuery('.countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
              }, 1000);


            });
          </script> -->
          <div class="clock" style="margin:2em;"></div>
          <div class="message"></div>
          <script type="text/javascript">
            jQuery(document).ready(function() {

                var clock;

                var get_cal_sec = "<?php echo $get_cal_sec; ?>";
              
                clock = jQuery('.clock').FlipClock(get_cal_sec, {
                    countdown: true,
                  clockFace: 'HourlyCounter'
                });


            });
          </script>

          <?php

        }else{
          echo "Note valide";
        }

    }



  
}else{

    echo 'Not Logged In';
}
return ob_get_clean();
}
add_shortcode('custom_set_timer', 'custom_set_timer_fun');




<div class="clock" style="margin:2em;"></div>
          <div class="message"></div>
          <script type="text/javascript">
            jQuery(document).ready(function() {

                var clock;

                var get_cal_sec = "<?php echo $get_cal_sec; ?>";
              
                clock = jQuery('.clock').FlipClock(get_cal_sec, {
                    countdown: true,
                  clockFace: 'HourlyCounter'
                });


            });
          </script>
?>












wp-admin/includes/schema.php 
capabilities

Loop post
wp-inculede/post.php
wp-inculede/post-template.php
wp-inculede/post-thumbnail.php

Media
wp-include/media.php
wp-admin/js/custom-background.js:

Style/script include
wp-includes/script-loader.php:
functions.wp-styles.php
functions.wp-scripts.php

style path:
wp-includes/theme.php

Add menu
wp-admin/includes/plugin.php


Meta 

post and postmeta

terms and termmeta

user and usermeta

wp_woocommerce_order_items and wp_woocommerce_order_itemsmeta

coments and comentmeta








