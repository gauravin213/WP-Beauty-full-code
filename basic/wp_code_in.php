<?php
//https://codex.wordpress.org/Plugin_API


//hokks are basicly allow user to create themes and plugins without editing any core files.
//add_action() use to insert custom code from out side resouce without editing any core files.
//add_filter() use to modify code from out side resouce without editing any core files.

/*
* Filter Functions
*/
has_filter($tag, $function_to_check) //Check if any filter has been registered for a hook.

add_filter($tag, $function_to_add, $priority, $accepted_args)//spacify the filter action

apply_filters(string $tag, $arg )//Execute functions who attached or hooked on a specific filter hook.

apply_filters_ref_array( $tag, $args ) //Execute functions who hooked on a specific filter hook.but specifying arguments in an array.

current_filter()// Retrieve the name of the current filter or action.

remove_filter($tag, $function_to_remove, $priority) //This function removes a function who attached or hooked to a specified filter hook

remove_all_filters( $tag, $priority) //Remove all of the hooks from a filter.

doing_filter($filter) //Checks to see if an filter is currently being executed and Return  boolean Values.


/*
* Actions Functions
*/
has_action($tag, $function_to_check) //Check if any action has been registered for a hook.
add_action($tag, $function_to_add, $priority, $accepted_args) //spacify the action 
do_action($tag, $arg) //Execute functions who attached ot hooked on a specific action hook.
do_action_ref_array() //Execute functions who attached ot hooked on a specific action hook.but specifying arguments in an array.
did_action( $tag) //Retrieve the number of times an action is fired.
remove_action($tag, $function_to_remove, $priority) //This function removes a function who attached or hooked to a specified action hook
remove_all_actions() //Remove all of the hooks from an action.
doing_action($action)) //Checks to see if an action is currently being executed and and Return  boolean Values.


/*
* Activation/Deactivation/Uninstall Functions
*/
register_activation_hook($file, $function) //registers a plugin function to be run when the plugin is activated.

register_deactivation_hook($file, $function)  //registers a plugin function to be run when the plugin is deactivated.

register_uninstall_hook($file, $function) //registers a plugin function to be run when the plugin is uninstall.




/* 
* Some Common Action hooks
*/

add_action( 'wp_head', 'my_custom_fun' ); 
add_action( 'admin_head', 'my_custom_fun' );

add_action( 'wp_enqueue_scripts', 'enqueue_fun' );
add_action( 'admin_enqueue_scripts', 'enqueue_fun' ); 


add_action( 'wp_footer', 'my_custom_fun' );
add_action( 'admin_footer', 'my_custom_fun' );


add_action( 'init', 'my_custom_fun' ); 
add_action( 'admin_init', 'my_custom_fun' ); 


add_action( 'admin_menu', 'my_custom_fun' );

add_action( 'wp_ajax_slider_my_action', 'slider_my_action_function');
add_action( 'wp_ajax_nopriv_slider_my_action', 'slider_my_action_function');


add_action('admin_post_{action_name}', 'post_function');
add_action('admin_post_nopriv_{action_name}','post_function');

add_action( 'after_setup_theme', 'wetime_theme_setup' );




/*
* create admin page
*/

//add admin menu
add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
$capability = manage_options
//add sub menu
$parent_slug = 'edit.php?post_type=my_custom_activity';
add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )

//add option page
add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);


/*
* css js
*/
wp_register_script( string $handle, string $src, array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )

wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer )

wp_enqueue_script('boot1sc','public/bootstrap/js/bootstrap.js', array('jquery'), $this->version, ture );

wp_deregister_script( $handle );

wp_dequeue_script( $handle );

$handle
(string) (Required) Name of the script. Should be unique.

$src
(string) (Optional) Full URL of the script, or path of the script relative to the WordPress root directory.

Default value: ''

$deps
(array) (Optional) An array of registered script handles this script depends on.

Default value: array()

$ver
(string|bool|null) (Optional) String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.

Default value: false

$in_footer
(bool) (Optional) Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.

Default value: false




wp_register_style( $handle, $src, $deps, $ver, $media)

wp_enqueue_style( $handle, $src, $deps, $ver, $media)

wp_enqueue_style('boot1st', plugin_dir_url( dirname( __FILE__ ) ) . 'public/bootstrap/css/bootstrap.css', array(), $this->version, 'all' );

wp_deregister_style( $handle );

wp_dequeue_style( $handle );

$handle
(string) (Required) Name of the stylesheet Should be unique.

$src
(string) (Optional) Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.

Default value: ''

$deps
(array) (Optional) An array of registered stylesheet handles this stylesheet depends on.

Default value: array()

$ver
(string|bool|null) (Optional) String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.

Default value: false

$media
(string) (Optional) The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.

Default value: 'all'






/*
* post meta
*/

get_field('external_link', $post_id); //get the Advace custom fields

get_post_meta( int $post_id, string $key = '', bool $single = false )

$post_id
(int) (Required) Post ID.

$key
(string) (Optional) The meta key to retrieve. By default, returns data for all keys.

Default value: ''

$single
(bool) (Optional) Whether to return a single value if true otherwise false.

Default value: false


update_post_meta( $post_id, $meta_key, $meta_value, $prev_value ); //updates the value of an existing meta key

$post_id
(integer) (required) The ID of the post which contains the field you will edit.
Default: None
$meta_key
(string) (required) The key of the custom field you will edit. (this should be raw as opposed to sanitized for database queries)
Default: None
$meta_value
(mixed) (required) The new value of the custom field. A passed array will be serialized into a string.(this should be raw as opposed to sanitized for database queries)
Default: None
$prev_value
(mixed) (optional) The old value of the custom field you wish to change. This is to differentiate between several fields with the same key. If omitted, and there are multiple rows for this post and meta key, all meta values will be updated.
Default: Empty





/*
* Directory path functions
*/
plugin_dir_path( dirname( __FILE__ ) ); //Get the Get the filesystem directory path (with trailing slash) for the plugin __FILE__ passed in  ///var/www/html/wordpress

plugin_dir_url( dirname( __FILE__ ) );  //Get the URL directory path (with trailing slash) for the plugin __FILE__ passed in  

 
get_stylesheet_directory_uri(); //Retrieve stylesheet directory URI of the current theme
Note: Does not contain a trailing slash.

get_template_directory_uri(); //Retrieves the absolute directory path of parent theme

home_url(); //retrieves the home URL of site.



/*
* wpdb
*/

WordPress defines a class called wpdb, which contains a set of functions used to interact with a database.


Note: Methods in the wpdb() class should not be called directly. Use the global $wpdb object instead!

global $wpdb;
$wpdb->get_results( $query );
$wpdb->prefix
$wpdb->query($sql);

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



/*
* Page functions
*/
//This is a boolean function, meaning it returns either TRUE or FALSE. It returns TRUE when the main blog page is being displaye
//Settings->Reading->Front page displays set A static page
if (is_front_page()) 
{
    echo "fron";
}


//Is the query for an existing single page?
$page
(int|string|array) (Optional) Page ID, title, slug, or array of such.
Default value: ''

is_page( int|string|array $page = '' )
{
    echo "fron";
}

//Check user logged in or not 
if (is_user_logged_in()) { 
 
}
else { 
   
} 


/*
* permalink
*/

get_permalink($postId); //get full permalink url 

url_to_postid($url); //get post id by url

/*
* 
*/













add_filter('display_randon_text', 'custom_display_randon_text', 10, 3);

function custom_display_randon_text($args1, $args2, $args3){

    echo "<pre>";
    print_r($args1);
    print_r($args2);
    print_r($args3);
    echo "</pre>";

    return 222222;
}


add_action('display_random_image', 'custom_display_random_image', 10, 2);
function custom_display_random_image($args1, $args2){


    echo "<pre>";
    print_r($args1);
    print_r($args2);
    //print_r($args3);
    echo "</pre>";
    echo 'imagesssssss';

}



$text = 'Gaurav Sharma';
echo "==>".apply_filters('display_randon_text', $text, '1111', '2222');


do_action('display_random_image', '11', '22');