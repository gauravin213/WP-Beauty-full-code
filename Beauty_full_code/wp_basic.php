<?php

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

/*
*  End:wp_enqueue_scripts action
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
}
/*
* End:add metabox
*/


/*
*  Start:Add the fields to the "category" taxonomy, using our callback function  
*/
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
add_action( 'edit_form_after_title', 'my_custom_fun' );
function my_custom_fun($post_id){

}


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
* Start:Register Custom widgets 12.jun.2018
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

/*
* End:Register Custom widgets 12.jun.2018
*/


/*
* Start:add shortcode
*/
function acf_gallery_function(){
ob_start();


return ob_get_clean();
}
add_shortcode('acf_gallery_shortcode', 'acf_gallery_function');
/*
* End:add shortcode
*/



/* 
* Start:Post argument
*/
$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'category'         => $kategory,
    'category_name'    => '',
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
    ),
    'date_query'     => array( 'after' => $search_date ),
);

// The Query
//$query = new WP_Query( $args );
$post_query_1 = get_posts($args);

if($post_query_1->have_posts()){

    while( $post_query_1->have_posts() ) { 
        $post_query_1->the_post();

        echo "==>".get_the_ID(); echo "<br>";
        echo "==>".get_the_title(); echo "<br>";

    }

}
/* 
* End:Post argument
*/


/*
* Start:register_post_type_args filter
*/ 
function wp1482371_custom_post_type_args( $args, $post_type ) {
    if ( $post_type == "testimonial" ) {
     
        $args['supports'] = array( 'title', 'editor', 'comments');
    }

    return $args;
}
add_filter( 'register_post_type_args', 'wp1482371_custom_post_type_args', 20, 2 );
/*
* End:register_post_type_args filter
*/ 



/*
* Start:pre_get_posts wp query filter
*/
function add_role_filter_to_posts_query( $query ) {

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
* Start:pre_get_posts wp query filter
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

pagination($myposts->max_num_pages); 
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













/*
* get post category by post id 
* Return textonomi detaisl + categoty details like category count, description etc..
*/
get_the_terms( int|object $post, string $taxonomy )
Retrieve the terms of the taxonomy that are attached to the post.

get_terms(); //taxonomy
Get custom post type categories

get_term( int|WP_Term|object $term, string $taxonomy = '', string $output = OBJECT, string $filter = 'raw' )
Get all Term data from database by Term ID.





get_the_category( int $id = false ) //post id
Retrieve post categories.

get_categories( string|array $args = '' ) //taxonomy
Retrieve list of category objects.

get_category( int|object $category, string $output = OBJECT, string $filter = 'raw' )
Retrieves category data given a category ID or category object.

/*
* get post category by post id 
* Return textonomi detaisl + categoty details like category count, description etc..
*/



/*
* Start:get path
*/
echo plugin_dir_path( dirname( __FILE__ ) );   

echo plugin_dir_url( dirname( __FILE__ ) );  

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

$query =  "SELECT * FROM wp_dsplite_program";

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
?>