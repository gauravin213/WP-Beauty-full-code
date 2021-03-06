<?php
/*
* Plugin Name: Basic Plugin Str
* Author: Clag Dev
* Text Domain: basic-plugin-str
* Description: This is the custom price calculator plugin
* Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*define( 'basicpluginstr_VERSION', '1.0.0' );
define( 'basicpluginstr_URI', plugin_dir_url( __FILE__ ) );
class basicpluginstr
{
	
	function __construct()
	{
		//Load textdomain
		add_action( 'plugins_loaded', array( $this, 'basicpluginstr_load_textdomain' ) );

		// Product data
		add_action( 'save_post', array( $this, 'basicpluginstr_save_option_field' ) );
	
		// Enqueue backend scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'basicpluginstr_admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_basicpluginstr_myback_action', array( $this,'basicpluginstr_myback_action_function'));
		add_action( 'wp_ajax_nopriv_basicpluginstr_myback_action', array( $this,'basicpluginstr_myback_action_function'));

		// Add front-end ajax
		add_action( 'wp_enqueue_scripts', array( $this,'basicpluginstr_wp_enqueue_scripts'));
		add_action( 'wp_ajax_basicpluginstr_my_action', array( $this,'basicpluginstr_my_action_function'));
		add_action( 'wp_ajax_nopriv_basicpluginstr_my_action', array( $this,'basicpluginstr_my_action_function'));

	}


	function basicpluginstr_load_textdomain(){
		load_plugin_textdomain( 'basic-plugin-str', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	
}
new basicpluginstr();*/



add_action( 'admin_menu', 'basicpluginstr_admin_menu_function' );
function basicpluginstr_admin_menu_function() {

	$page_title = "Basic Plugin";
	$menu_title = "Basic Plugin";
	$capability = "manage_options";
	$menu_slug = "basic-plugin";
	$function = "basic_plugin_function";
	$icon_url = "";
	$position = "";
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );


	$parent_slug = "basic-plugin"; //edit.php?post_type=product
	$page_title = "Basic Plugin sub menu";
	$menu_title = "Basic Plugin sub menu";
	$capability = "manage_options";
	$menu_slug = "basic-plugin-sub-menu";
	$function = "basic_plugin_submenu_function";
	add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );


	$page_title = "Basic Plugin options";
	$menu_title = "Basic Plugin options";
	$capability = "manage_options";
	$menu_slug = "basic-plugin-options";
	$function = "basic_plugin_options_function";
	add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
}


function basic_plugin_function(){
	echo "<h1> Basic Plugin Str</h1>";
}

function basic_plugin_submenu_function(){
	echo "<h1> Basic Plugin Str sub menu</h1>";
}

function basic_plugin_options_function(){
	?>
	 <div class="wrap">
      <h1> Basic Plugin Str sub menu</h1>

      <p>&lt;?php echo do_shortcode( '[get_upcoming_events_list]' );?&gt;</p>

      <?php 


      //do_action('gaurav_sharma_xyx', 'aaa', 'bbb' ,'ccc'); 

      $arg = array('a','b','c','d');
      $yyyy = apply_filters('gaurav_sharma_xyx', $arg );

      print_r($yyyy);


      ?>

      <form action="options.php" method="post">
      <?php wp_nonce_field('update-options') ?>

      	<table class="optiontable editform"><tbody>
	         <tr>
	            <td></td>
	            <td>
	               <label for="basicpluginstr_option">
	                  <input id="basicpluginstr_option" type="text"
	                        name="basicpluginstr_option" value="<?php if (get_option('basicpluginstr_option')) echo get_option('basicpluginstr_option'); ?>"/>
	               </label>
	            </td>
	         </tr>

	         <tr>
	            <td></td>
	            <td>
	               <?php
			      $content = get_option( 'custom_nofollow_text');
			      $editor_id = 'custom_nofollow_text';
			      wp_editor( $content, $editor_id );
			      ?>
	            </td>
	         </tr>
	      </tbody>
	  	</table>

    
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="basicpluginstr_option,custom_nofollow_text" />
      <input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
      </form>
   </div>
	<?php
}




/*add_action('gaurav_sharma_xyx', 'gaurav_sharma_xyx_function', 3, 10);

function gaurav_sharma_xyx_function($a, $b, $c){

    echo $a."<h1>PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP</h1>".$b.$c;
}*/


add_filter($tag, $function_to_add, $priority, $accepted_args);
add_filter('gaurav_sharma_xyx', 'gaurav_sharma_xyx_function');
function gaurav_sharma_xyx_function($accepted_args){

    $accepted_args['2'] = "PPPPPPPPPPPPPP";
   
   return $accepted_args;
}







// Add settings link on plugin page
add_filter("plugin_action_links_" . plugin_basename( __FILE__ ), 'basicpluginstr_plugin_action_links',10,2);
function basicpluginstr_plugin_action_links($links) {
    $this_plugin = '';
    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($this_plugin) {
        $settings_link = '<a href="options-general.php?page=basic-plugin-options">Settings</a>';
        array_unshift($links, $settings_link);

        $upgrade_link=
            '<a href="'.WP_IMPORTANT_INFO_URL.'" style="color:#fff; padding:3px 10px; background: red;" target="_blank">Upgrade</a>';
        array_unshift($links, $upgrade_link);          

    }

    return $links;
}
add_filter( 'plugin_row_meta', 'basicpluginstr_plugin_row_meta', 10, 2 );
function basicpluginstr_plugin_row_meta( $links, $file ) {

    if ( strpos( $file, 'basic-plugin-str/basic-plugin-str.php' ) !== false ) {
        
        $more_links = array(

                'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=jwthemeltd@gmail.com&lc=US&item_name=Donate&currency_code=USD&bn=PP-DonationsBF:btn_donate_SM.gif:NonHostedGuest" target="_blank">Donate</a>',

                'doc' => '<a href="https://docs.jeweltheme.com/category/wordpress-plugins/awesome-faq-pro/" target="_blank">Documentation</a>',
                'upgrade' => '<a href="'.WP_IMPORTANT_INFO_URL.'" style="color:#fff; padding:3px 10px; background: red;" target="_blank">Upgrade</a>'

        );
        
        $links = array_merge( $links, $more_links );
    }
    
    return $links;
}



add_action('admin_notices', 'basicpluginstr_admin_notices');
function basicpluginstr_admin_notices() {
   /* global $current_user ;
        $user_id = $current_user->ID;
    if ( ! get_user_meta($user_id, 'basicpluginstr_ignore_notice') ) {*/
        echo '<div class="updated"><p>';
        printf(__('<h2 style="font-size: 20px; color: #5FA52A; font-weight: normal; margin-bottom: 10px; margin-top: 5px;">
                    <a href="https://goo.gl/kX2nGF" target="_blank">#1 Video WordPress Theme on Market, now only $53 !!!</a></h2>
                    <h4 style="font-size: 20px; color: #5FA52A; font-weight: normal; margin-bottom: 10px; margin-top: 5px;">
                    <a href="https://jeweltheme.com/shop/wordpress-faq-plugin/" target="_blank">Get WP Awesome FAQ PRO Today!</a></h4>
                    Check out Premium Features of <a href="https://jeweltheme.com/shop/wordpress-faq-plugin/" target="_blank">WP Awesome FAQ</a> Plugin. Compare Why this Plugin is really awesome !!! <br>
            Jewel Theme, always express the power of WordPress. We are one of the best Team for creating stunning WordPress Themes - Plugins and Website Templates. <br>
            Check all of our <a href="https://jeweltheme.com/cat/wordpress-themes/" target="_blank">Free and Premium WordPress Themes</a> and <a href="https://jeweltheme.com/cat/wordpress-plugins/" target="_blank">WordPress Plugins </a> <a style="float: right;" href="%1$s">X</a>'), '?basicpluginstr_admin_init_ignore=0');
        echo "</p></div>";
    //}
}
add_action('admin_init', 'basicpluginstr_admin_init_ignore');
function basicpluginstr_admin_init_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['basicpluginstr_admin_init_ignore']) && '0' == $_GET['basicpluginstr_admin_init_ignore'] ) {
             add_user_meta($user_id, 'basicpluginstr_ignore_notice', 'true', true);
    }
}







// Manage Category Shortcode Columns
add_filter("manage_edit-product_cat_columns", 'basicpluginstr_manage_edit_product_cat_columns');
function basicpluginstr_manage_edit_product_cat_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'product_category_shortcode' => __( 'Product Category Shortcode', 'jeweltheme' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
        );
    return $new_columns;
}
add_filter("manage_product_cat_custom_column", 'basicpluginstr_manage_product_cat_custom_column', 10, 3);
function basicpluginstr_manage_product_cat_custom_column($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'product_cat');
    switch ($column_name) {

        case 'title':
            echo get_the_title();
        break;

        case 'product_category_shortcode':
             echo '[basicpluginstr cat_id="' . $theme_id. '"]';
        break;

        default:
            break;
    }
    return $out;
}


//Custom INFO Post Type
function jeweltheme_wp_important_post_type() {
    $labels = array(
        'name'               => _x( 'INFO', 'post type general name' ),
        'singular_name'      => _x( 'INFO', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New INFO' ),
        'edit_item'          => __( 'Edit INFO' ),
        'new_item'           => __( 'New INFO Items' ),
        'all_items'          => __( 'All INFO\'s' ),
        'view_item'          => __( 'View INFO' ),
        'search_items'       => __( 'Search INFO' ),
        'not_found'          => __( 'No INFO Items found' ),
        'not_found_in_trash' => __( 'No INFO Items found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'IMPORTANT INFO'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds INFO specific data',
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'info'),
        'capability_type'=> 'post',
        'has_archive'   => true,
        'hierarchical'  => false,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor'),
        'menu_icon' => 'dashicons-welcome-write-blog'
    );

    register_post_type( 'info', $args );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'INFO Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'INFO Category', 'taxonomy singular name' ),
            'search_items'      =>  __( 'Search INFO Categories' ),
            'all_items'         => __( 'All INFO Category' ),
            'parent_item'       => __( 'Parent INFO Category' ),
            'parent_item_colon' => __( 'Parent INFO Category:' ),
            'edit_item'         => __( 'Edit INFO Category' ),
            'update_item'       => __( 'Update INFO Category' ),
            'add_new_item'      => __( 'Add New INFO Category' ),
            'new_item_name'     => __( 'New INFO Category Name' ),
            'menu_name'         => __( 'INFO Category' ),
        );

        register_taxonomy('info_cat',array('info'), array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
            'rewrite'      => array( 'slug' => 'info_cat' ),
        ));
}
//add_action( 'init', 'jeweltheme_wp_important_post_type' );



function basicpluginstr_shortcode($atts, $content= null) {

    extract( shortcode_atts(
        array(
           'id' => '',
            'content'  => '',
            "cat_id" => '',
            "cat_icon_class" => '',
            "image" => '',
            ), $atts )
    );


    // WP_Query arguments
    if( $cat_id == '' ) :
        $args = array (
            'posts_per_page'        => -1,
            'post_type'             => 'product',
            'p'                     => $id,
            'order' =>"DESC"
            );
    else:
        $args = array (
            'posts_per_page'        => -1,
            'post_type'             => 'product',
            'p'                     => $id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => array( $cat_id ),
                    ),
                ),

            'order' =>"DESC"
            );
    endif;

    $query = new WP_Query( $args );

    ob_start();

    global $faq;

    $count = 0;
    $accordion = 'accordion-' . time() . rand();

    /*echo "<pre>";
    print_r($atts);
    echo "</pre>";*/

    ?>
        <div class="accordion-info" id="<?php echo $accordion .  $count;?>">



            <?php if( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

               <h3><?php the_title();?></h3>
                <i class="<?php echo $cat_icon_class;?>" aria-hidden="true"></i>
                <div class="ppppp">
                <?php if($image) echo "<img src='" . $image ."'>"; ?>
                    <?php the_content();?>
                </div>

                <?php } //end while
            } ?>
        </div>




    <?php
   //Reset the query
    wp_reset_query();
    wp_reset_postdata();
    $output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}
add_shortcode('basicpluginstr', 'basicpluginstr_shortcode');


/*add_action('admin_init', 'basicpluginstr_settings_store');
//Register Settings Page
function basicpluginstr_settings_store() { 
    register_setting('basicpluginstr_settings_store_collapse', 'basicpluginstr_settings_store_collapse');
}*/

/*function jeweltheme_wp_important_info_admin_inline_js(){ ?>
    <style>
        i.mce-ico.mce-i-faq-icon {
            background-image: url('<?php echo  plugins_url( 'icon.png', __FILE__ );?>');
        }
    </style>
<?php }
add_action( 'admin_print_scripts', 'jeweltheme_wp_important_info_admin_inline_js' );*/