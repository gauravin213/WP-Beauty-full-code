<?php
/*
* Plugin Name: Approve User Image
* Author: Clag Dev
* Text Domain: approve-user-image
* Description: This is the custom approve user image plugin
* Version: 1.0.0
*/


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

//approve_user_image  ApproveUserImage

define( 'ApproveUserImage_VERSION', '1.0.0' );
define( 'ApproveUserImage_URI', plugin_dir_url( __FILE__ ) );

function rr_scripts() {

  if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
  }

  wp_enqueue_script( 'cus-js1',ApproveUserImage_URI .'fancybox-source/jquery.fancybox.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_style('cus-css1', ApproveUserImage_URI .'fancybox-source/jquery.fancybox.css', array(), '1.0', 'all' );
}

add_action( 'wp_enqueue_scripts', 'rr_scripts' );
add_action( 'admin_enqueue_scripts', 'rr_scripts' );


add_action('admin_init', 'allow_new_role_uploads');
function allow_new_role_uploads() {
    add_role(
        'freelancer',
        __( 'Freelancer' ),
        array(
            'read'         => true,  // true allows this capability
            'edit_posts'   => true,
        )
    );
    $new_role = get_role('freelancer');
    $new_role->add_cap('upload_files');
}


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
}


function basic_plugin_function(){
  echo "<h1> Basic Plugin Str</h1>";
}



/*add_action( 'user_register', 'approve_user_image_user_register', 10, 1 );
function approve_user_image_user_register( $user_id ) {

    echo $_POST['first_name'];
    
    $user_meta=get_userdata($user_id);

    echo "<pre>";
    print_r($user_meta);
    echo "</pre>";
    die();

}*/



//custom user meta fields
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { //echo "==>".$user->roles[0];

  if ($user->roles[0] == 'freelancer') { ?>
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

        //Fancybox
         jQuery('.fancybox-buttons').fancybox({ 
          openEffect  : 'none',
          closeEffect : 'none',

          prevEffect : 'none',
          nextEffect : 'none',

          closeBtn  : true,

          helpers : {
            title : {
              type : 'inside'
            },
            buttons : {}
          },

          afterLoad : function() {
            this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
          }
        });
          

     });
  </script>
  <!---->

  <?php }   

}


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    update_user_meta( $user_id, 'left_image', $_POST['left_image'] );
    update_user_meta( $user_id, 'front_image', $_POST['front_image'] );
    update_user_meta( $user_id, 'right_image', $_POST['right_image'] );
}

//custom user meta fields



/*
* Upload Image Featured
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



