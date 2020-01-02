<?php
/*
Plugin Name: Custom Inner Page Banner
Description: This is the InnerPageBanner plugin
Author: Dev
Text Domain: inner-page-banner
*/

//prefix: InnerPageBanner

defined( 'ABSPATH' ) or die();

define( 'InnerPageBanner_VERSION', '1.0.0' );
define( 'InnerPageBanner_URL', plugin_dir_url( __FILE__ ) );
define( 'InnerPageBanner_PATH', plugin_dir_path( __FILE__ ) );

/*
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Put your plugin code here
}*/

add_action( 'plugins_loaded', 'cuspricecal_load_textdomain');
function cuspricecal_load_textdomain(){
  load_plugin_textdomain( 'inner-page-banner', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}


if (!class_exists('InnerPageBanner')) {

  class InnerPageBanner {
    
    function __construct(){  
      
      add_action('init', array($this, 'InnerPageBanner_register_post_type_fun'), 10);

      add_action('add_meta_boxes', array($this, 'TmmLedger_meta_boxes'), 10);

      add_action('save_post', array($this, 'InnerPageBanner_save_post'), 10, 1);

      add_shortcode('InnerPageBannerFrontEndShortcode', array($this, 'InnerPageBannerFrontEndShortcodeFun') );

      add_filter( 'manage_edit-inner_page_banner_columns', array($this, 'InnerPageBannerColumnFun' ) );
 
      add_action( 'manage_inner_page_banner_posts_custom_column', array($this, 'InnerPageBannerValueFun') , 11);

      add_action( 'admin_menu', array($this, 'InnerPageBanner_admin_menu_fun') );

      add_filter( 'posts_join', array($this, 'InnerPageBanner_search_join') );
      add_filter( 'posts_where', array($this, 'InnerPageBanner_search_search_where') );
      add_filter( 'posts_distinct', array($this, 'InnerPageBanner_search_distinct') );

      add_action('admin_enqueue_scripts', array($this, 'InnerPageBanner_admin_enqueue_scripts'), 10, 1);

      add_action( 'wp_ajax_InnerPageBannerSelection_action', array($this, 'InnerPageBannerSelection_action'));
      add_action( 'wp_ajax_nopriv_InnerPageBannerSelection_action', array($this, 'InnerPageBannerSelection_action'));

    }

    public function InnerPageBanner_admin_enqueue_scripts(){

      wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );

      wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery') );

    }


    public function InnerPageBanner_search_join ( $join ) {
        global $pagenow, $wpdb;

        // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
        if ( is_admin() && 'edit.php' === $pagenow && 'inner_page_banner' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {    
            $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
        }
        return $join;
    }

    public function InnerPageBanner_search_search_where( $where ) {
        global $pagenow, $wpdb;

        // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
        if ( is_admin() && 'edit.php' === $pagenow && 'inner_page_banner' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {
            $where = preg_replace(
                "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
        }
        return $where;
    }

    public function InnerPageBanner_search_distinct( $where ){
        global $pagenow, $wpdb;

        if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='inner_page_banner' && $_GET['s'] != '') {
        return "DISTINCT";

        }
        return $where;
    }



    public function InnerPageBanner_admin_menu_fun(){

      $parent_slug = "edit.php?post_type=inner_page_banner"; //edit.php?post_type=product

      $page_title = 'Banner Settings';

      add_submenu_page( $parent_slug, $page_title, $page_title, 'manage_options', 'banner-settings-page', array($this, 'InnerPageBannerSettingsFun') );


    }

    public function InnerPageBannerSettingsFun(){

      ?>

       <div class="wrap">
       <h1>Banner Settings</h1>

      <div>
        <div style="font-size: 21px;">Shortcode: <b>[InnerPageBannerFrontEndShortcode]</b></div>
      </div>
    
      <form action="options.php" method="post">
      <?php wp_nonce_field('update-options') ?>

        <table class="form-table"><tbody>
            

            <tr>
              <th scope="row">
                    <label for="InnerPageBanner_switch_on_off"><?php echo __('Enable: ', 'inner-page-banner');?></label>
              </th>
              <td>
              <input type="checkbox" name="InnerPageBanner_switch_on_off" id="InnerPageBanner_switch_on_off" value="1" <?php if (!empty(get_option('InnerPageBanner_switch_on_off'))) { echo "checked"; } ?>>
              </td>
            </tr>



          </tbody>
        </table>

    
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="InnerPageBanner_switch_on_off,category_banner_image,category_banner_image_option,diesel_ads_url_opt, diesel_inner_page_banner_image" />
      <input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
      </form>
   </div>



      <?php
    }


    public function InnerPageBannerColumnFun( $columns ) {
      
      $columns = array(
              'cb' => '<input type="checkbox" />',
              'title' => __( 'Title' ),
              'banner_img' => __( 'Banner' ),
              'selected_page' => __( 'Selected Page' ),
              'date' => __( 'Date' )
          );

      return $columns;
      
      
  }


  public function InnerPageBannerValueFun( $column ) { 

      global $post;

      switch( $column ) {

        case 'banner_img' :

        $attachment_id = get_post_meta( $post->ID, 'InnerPageBannerImage', true );

        $image_size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
          
        $image_attributes_thumbnail = wp_get_attachment_image_src( $attachment_id, $image_size );

        $banner_url = $image_attributes_thumbnail[0];

        echo '<img src="'.$banner_url.'" style="width:100px;">';
          
              break;

        case 'selected_page' :

            $InnerPageBannerType = get_post_meta( $post->ID, 'InnerPageBannerType', true ); 

            $page_id = (int)get_post_meta( $post->ID, 'InnerPageBannerSelection', true );

           if ($InnerPageBannerType == 'InnerPageBannerPage' || $InnerPageBannerType == 'InnerPageBannerProduct') {  
              $preview_url = get_permalink($page_id);
              $page_id = get_post_meta( $post->ID, 'InnerPageBannerSelection', true );
              $page_title = get_the_title($page_id);

           }else if($InnerPageBannerType == 'InnerPageBannerProductCategory'){ 
              $preview_url = get_term_link( $page_id, 'product_cat' ); 
              $term = get_term($page_id);
              $page_title = $term->name;
           }else{
              $preview_url = "--";
           }

          echo '<a target="_blank" href="'.$preview_url.'">'.$page_title.'</a>';
          
              break;


          default :
                  break;
      }
  }


    public function InnerPageBanner_register_post_type_fun(){

      $labels = array(
          'name'               => _x( 'Banner', 'post type general name' ),
          'singular_name'      => _x( 'Banner', 'post type singular name' ),
          'add_new'            => _x( 'Add New', 'Banner' ),
          'add_new_item'       => __( 'Add New Banner' ),
          'edit_item'          => __( 'Edit Banner' ),
          'new_item'           => __( 'New Banner Items' ),
          'all_items'          => __( 'All Banners' ),
          'view_item'          => __( 'View Banner' ),
          'search_items'       => __( 'Search Banner' ),
          'not_found'          => __( 'No Banner Items found' ),
          'not_found_in_trash' => __( 'No Banner Items found in the Trash' ),
          'parent_item_colon'  => '',
          'menu_name'          => 'Banner'
      );
      $args = array(
          'labels'        => $labels,
          'description'   => 'Banner specific data',
          'public'        => false,
          'show_ui'       => true,
          'show_in_menu'  => true,
          'query_var'     => true,
          'show_in_nav_menus'   => true,
          'show_in_admin_bar'   => true,
          'rewrite'       => array('slug' => 'inner-page-banner'),
          'capability_type'=> 'post',
          'has_archive'   => true,
          'hierarchical'  => false,
          'menu_position' => 5,
          'supports'            => array( 'title'),
          'menu_icon' => 'dashicons-welcome-write-blog'
      );

      register_post_type( 'inner_page_banner', $args );


    }

    public function TmmLedger_meta_boxes(){

      add_meta_box( 'InnerPageBanner', 'Inner Page Banner', array($this, 'InnerPageBannerMetabox'), 'inner_page_banner', 'normal', 'high' );


    }


    public function InnerPageBannerFrontEndShortcodeFun(){

        $InnerPageBanner_switch_on_off = get_option('InnerPageBanner_switch_on_off');

        if ($InnerPageBanner_switch_on_off && !empty($InnerPageBanner_switch_on_off)) {


          if (is_product_category()) {
            $category = get_queried_object();
            $page_id = $category->term_id;
            //echo 'term_id: '.$page_id;
          }else{
            $page_id = get_the_ID();
            //echo 'page_id: '.$page_id;
          }

         
          $InnerPageBanner_Response = $this->InnerPageBanner_GetPageID($page_id);

          if (!empty($InnerPageBanner_Response)) {

            $banner_post_id = $InnerPageBanner_Response[0]->post_id;

            $banner_post_status = get_post_status($banner_post_id);

            if ( $banner_post_status == 'publish') {

              $BannerAttachment = get_post_meta( $banner_post_id, 'InnerPageBannerImage', true );

              if (!empty($BannerAttachment)) {

                $image_size = 'full'; // (thumbnail, medium, large, full or custom size)
                  
                $image_attributes_thumbnail = wp_get_attachment_image_src( $BannerAttachment, $image_size );

                $banner_url = $image_attributes_thumbnail[0];
                ?>
                <div class="diesel-ads-image">
                  <img src="<?php echo $banner_url;?>" style="width:100%;">
                </div>
                <?php

              }
             
            }

          }
         
        }
    }


    public function InnerPageBanner_GetPageID($page_id){

      global $wpdb;

      $query =  "SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'InnerPageBannerSelection' AND meta_value = '".$page_id."'";

      $results = $wpdb->get_results( $query );

      return $results;

    }


    public function InnerPageBannerMetabox(){
      global $post; 

       $InnerPageBannerSelection = (int)get_post_meta( $post->ID, 'InnerPageBannerSelection', true );

       $page_id = $InnerPageBannerSelection;

       $InnerPageBannerImage = get_post_meta( $post->ID, 'InnerPageBannerImage', true );

       $InnerPageBannerType = get_post_meta( $post->ID, 'InnerPageBannerType', true ); echo "<br>";

       if ($InnerPageBannerType == 'InnerPageBannerPage' || $InnerPageBannerType == 'InnerPageBannerProduct') {  
          $preview_url = get_permalink($page_id);
       }else if($InnerPageBannerType == 'InnerPageBannerProductCategory'){ 
          $preview_url = get_term_link( $page_id, 'product_cat' ); 
       }else{
          $preview_url = "";
       }

      ?>
      <div>


        <div>
          <label>Preview: </label>
          <a target="_blank" href="<?php echo $preview_url?>"><?php echo $preview_url?></a>
        </div>



        <div>
          <ul style="display: flex;">
            <li>Page<input type="radio" name="InnerPageBannerType" value="InnerPageBannerPage" style="margin-left: 4px;" <?php if ($InnerPageBannerType == 'InnerPageBannerPage') { echo "checked";}?>></li>

            <li>Product Category<input type="radio" name="InnerPageBannerType" value="InnerPageBannerProductCategory" style="margin-left: 4px;" <?php if ($InnerPageBannerType == 'InnerPageBannerProductCategory') { echo "checked";}?>></li>


            <!-- <li>Product<input type="radio" name="InnerPageBannerType" value="InnerPageBannerProduct" style="margin-left: 4px;" <?php if ($InnerPageBannerType == 'InnerPageBannerProduct') { echo "checked";}?>></li> -->
          </ul>
        </div>


        <div class="tabs">

          <div id="InnerPageBannerPage" class="InnerPageBannerTabLi" style="display: none;">
            <select name='InnerPageBannerSelection' id="InnerPageBannerSelection">
                <option value='0'><?php _e('Select a Page', 'textdomain'); ?></option>
                <?php $pages = get_pages(); ?>
                <?php foreach( $pages as $page ) { ?>
                    <option value='<?php echo $page->ID; ?>' <?php selected( $InnerPageBannerSelection, $page->ID ); ?> ><?php echo $page->post_title; ?></option>
                <?php }; ?>
            </select>
          </div>

          <div id="InnerPageBannerProductCategory" class="InnerPageBannerTabLi" style="display: none;">
          <select name='InnerCatBanner_action_select2' id="InnerCatBanner_action_select2">
                <option value='0'><?php _e('Select a Page', 'textdomain'); ?></option>
                <?php $terms = get_terms( 'product_cat' ); ?>
                <?php foreach( $terms as $term ) { ?>
                    <option value='<?php echo $term->term_id; ?>' <?php selected( $InnerPageBannerSelection, $term->term_id ); ?> ><?php echo $term->name; ?></option>
                <?php }; ?>
            </select>

          </div>


          <!-- <div id="InnerPageBannerProduct" class="InnerPageBannerTabLi" style="display: none;"> -->
            <?php  if ($_GET['post']) {
           /* $product = wc_get_product( $page_id );
            $product_name = $product->get_title();
            $product_id = $product->get_id();*/
             ?>
              <!--  <select name='InnerProductBanner_action_select2' id="InnerProductBanner_action_select2">
                 <option value="<?php echo $product_id;?>" selected><?php echo $product_name?></option>
               </select> -->
            <?php }else{ ?>
              <!-- <select name='InnerProductBanner_action_select2' id="InnerProductBanner_action_select2"></select> -->
            <?php } ?>
          <!-- </div> -->

        </div>


        <br><br>



        <div>
        <?php
            echo $this->inner_page_baaner_image_uploader_field( 'InnerPageBannerImage', $InnerPageBannerImage );
        ?>
        </div>

        <script type="text/javascript">
        jQuery(function($){

          //
          var InnerPageBannerType = '<?php echo $InnerPageBannerType;?>';
          jQuery('#'+InnerPageBannerType).show();

          jQuery(document).on('change', 'input[name="InnerPageBannerType"]', function(){

            var target = jQuery(this);

            var banner_type = target.val();

            jQuery('.InnerPageBannerTabLi').hide();

            jQuery('#'+banner_type).show();

          });
          //


          jQuery.fn.SetBannerAjaxAction = function(page_id, saved_page_id){

              jQuery.ajax({

                url: '<?php echo admin_url( 'admin-ajax.php');?>',
                type: "POST",
                data: {'action': 'InnerPageBannerSelection_action', 'page_id': page_id},
                cache: false,
                dataType: 'json',
                beforeSend: function(){
                },
                complete: function(){
                },
                success: function (response) { 

                  var a = parseInt(response['page_id']);

                  var b = parseInt(saved_page_id);

                  var c = (a+b);

                  if (a != b) {

                    if (response['count'] == 1) {
                      jQuery( "#publish" ).prop( "disabled", true );
                      alert('This page alredy use for banner');
                    }else{
                      jQuery( "#publish" ).prop( "disabled", false );
                    }

                  }else{
                    jQuery( "#publish" ).prop( "disabled", false );
                  }
                  console.log(response);
                }
            });

          }
        
          /*
          * Select Page
          */ 
          jQuery('#InnerPageBannerSelection').select2({
            width: '100%',
            placeholder : "select me" 
          });
          jQuery(document).on('change', '#InnerPageBannerSelection', function(){

            jQuery( "#publish" ).prop( "disabled", true );

            var page_id = jQuery(this).find(':selected').val(); 

            var saved_page_id = '<?php echo $page_id;?>';

            jQuery(this).SetBannerAjaxAction(page_id, saved_page_id);

          });
          /*
          * Select Page
          */ 


          /*
          * Select Product Category
          */ 
          /*jQuery('#InnerCatBanner_action_select2').select2({
            width: '100%',
            placeholder : "select me" 
          });*/

          jQuery('#InnerCatBanner_action_select2').select2({
            ajax: {
              url: '<?php echo admin_url( 'admin-ajax.php');?>', //"https://api.github.com/search/repositories",
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {  
                  return {
                    q: params.term, // search query
                    action: 'InnerCatBanner_action_select2' // AJAX action for admin-ajax.php
                  };
              },
              processResults: function( data ) {  

                console.log(data);

                jQuery("#InnerPageBannerSelection").select2('val', '0');

                var options = [];
                if ( data ) {
                
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                    jQuery.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
                      options.push( { id: text[0], text: text[1]  } );
                    });


                }
                return {
                  results: options
                };
            },
            cache: true
            },
            minimumInputLength: 3, // the minimum of symbols to input before perform a search
            width: '100%',
            placeholder : "select me" 
          });
          /*
          * Select Product Category
          */ 


          /*
          * Select Product
          */
          /*jQuery('#InnerProductBanner_action_select2').select2({
            ajax: {
              url: '<?php echo admin_url( 'admin-ajax.php');?>', //"https://api.github.com/search/repositories",
              dataType: 'json',
              delay: 250, // delay in ms while typing when to perform a AJAX search
              data: function (params) {  
                  return {
                    q: params.term, // search query
                    action: 'InnerProductBanner_action_select2' // AJAX action for admin-ajax.php
                  };
              },
              processResults: function( data ) {  

                console.log(data);

               
                var options = [];
                if ( data ) {
                
                  // data is the array of arrays, and each of them contains ID and the Label of the option
                    jQuery.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
                      options.push( { id: text[0], text: text[1]  } );
                    });


                }
                return {
                  results: options
                };
            },
            cache: true
            },
            minimumInputLength: 3, // the minimum of symbols to input before perform a search
            width: '100%',
            placeholder : "select me" 
          });*/
          /*
          * Select Product
          */


          /*
           * Select/Upload image(s) event
           */
          jQuery('body').on('click', '.consultant_upload_image_button', function(e){
              e.preventDefault();

                  var button = jQuery(this),
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
                  jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:50%;display:block;" />').next().val(attachment.id).next().show();
              })
              .open();
          });

          /*
           * Remove image event
           */
          jQuery('body').on('click', '.misha_remove_image_button', function(){
              jQuery(this).hide().prev().val('').prev().addClass('button').html('Upload image');
              return false;
          });
         
        });
        </script>

      </div>
      <?php
    }



    public function InnerPageBanner_save_post($post_id){

      global $post;

      $InnerPageBannerType = $_POST['InnerPageBannerType'];

     
      if ($InnerPageBannerType == 'InnerPageBannerPage'){ 

        $sanitized = wp_filter_post_kses( $_POST['InnerPageBannerSelection'] );
        update_post_meta( $post_id, 'InnerPageBannerSelection', $sanitized );

        $InnerPageBannerTitle = get_the_title($sanitized);
        update_post_meta( $post_id, 'InnerPageBannerTitle', $InnerPageBannerTitle );


       }

       if ($InnerPageBannerType == 'InnerPageBannerProductCategory'){ 
          
          $sanitized = wp_filter_post_kses( $_POST['InnerCatBanner_action_select2'] );
          update_post_meta( $post_id, 'InnerPageBannerSelection', $sanitized );

          $term = get_term($sanitized);
          $category_name = $term->name;
          update_post_meta( $post_id, 'InnerPageBannerTitle', $category_name );

       }


       /*if ($InnerPageBannerType == 'InnerPageBannerProduct'){ 
          
          $sanitized = wp_filter_post_kses( $_POST['InnerProductBanner_action_select2'] );
          update_post_meta( $post_id, 'InnerPageBannerSelection', $sanitized );

          $product = wc_get_product( $sanitized );

          $product_name = $product->get_title();

          update_post_meta( $post_id, 'InnerPageBannerTitle', $product_name );

       }*/



       


      if (isset( $_POST['InnerPageBannerImage'] ) ) {
        $sanitized = wp_filter_post_kses( $_POST['InnerPageBannerImage'] );
        update_post_meta( $post_id, 'InnerPageBannerImage', $sanitized );
      }


      if (isset( $_POST['InnerPageBannerType'] ) ) {
        $sanitized = wp_filter_post_kses( $_POST['InnerPageBannerType'] );
        update_post_meta( $post_id, 'InnerPageBannerType', $sanitized );
      }


       //die();

    }


    public function InnerPageBannerSelection_action(){

      global $wpdb;

      $page_id = $_POST['page_id'];

      $count = 0;

      $query =  "SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'InnerPageBannerSelection' AND meta_value=".$page_id;

      $results = $wpdb->get_results( $query );

      $count = sizeof($results);

      $myArr = array('response' => $results, 'page_id' => $page_id, 'count' => $count);
      $myJSON = json_encode($myArr); 
      echo $myJSON;
      die();
    }

    public function inner_page_baaner_image_uploader_field( $name, $value = '') {
      $image = ' button">Upload image';
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
              <a href="#" class="button button-primary misha_remove_image_button" style="margin-top: 10px;;display:inline-block;display:' . $display . '">Remove image</a>
          </div>';

    }

  }

}

new InnerPageBanner();



add_action( 'wp_ajax_InnerCatBanner_action_select2', 'InnerCatBanner_action_select2');
add_action( 'wp_ajax_nopriv_InnerCatBanner_action_select2', 'InnerCatBanner_action_select2');
function InnerCatBanner_action_select2(){
  // we will pass post IDs and titles to this array
  $return = array();

  $terms = get_terms( 'product_cat', array(
      'name__like' => $_GET['q'],
      'hide_empty' => true // Optional 
  ) );
  if ( count($terms) > 0 ){

      foreach ( $terms as $term ) {

         $return[] = array( $term->term_id, $term->name );

          
      }
  }

  echo json_encode( $return );
  die;
}


add_action( 'wp_ajax_InnerProductBanner_action_select2', 'InnerProductBanner_action_select2');
add_action( 'wp_ajax_nopriv_InnerProductBanner_action_select2', 'InnerProductBanner_action_select2');
function InnerProductBanner_action_select2(){
  // we will pass post IDs and titles to this array
  $return = array();

  // you can use WP_Query, query_posts() or get_posts() here - it doesn't matter
  $search_results = new WP_Query( array( 
    's'=> $_GET['q'], // the search query
     'post_type'        => 'product',
    'post_status' => 'publish', // if you don't want drafts to be returned
    //'ignore_sticky_posts' => 1,
    'posts_per_page' => -1 // how much to show at once
  ) );

  if( $search_results->have_posts() ) :
    while( $search_results->have_posts() ) : $search_results->the_post(); 
      // shorten the title a little
      $title = ( mb_strlen( $search_results->post->post_title ) > 50 ) ? mb_substr( $search_results->post->post_title, 0, 49 ) . '...' : $search_results->post->post_title;
      $return[] = array( $search_results->post->ID, $title ); // array( Post ID, Post Title )
    endwhile;
  endif;

  echo json_encode( $return );
  die;
}





?>