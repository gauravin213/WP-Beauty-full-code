<?php
function tzaventura_spacialist($atts) {

    $tz_icon = $custom_dropdown1 = $custom_textfield1 = $el_class = $css = '';
    extract(shortcode_atts(array(
        'tz_icon'               => '1',
        'spacialist_title'       => '',
        'spacialist_caption_text' => '',
        'spacialist_mobile'       => '',
        'spacialist_link'       => '',
        'el_class'              => '',
        'css'                   => '',
    ),$atts));
    ob_start();

    wp_enqueue_script('tz-custom');
    ?>
    <div class="spacialist_custom tzElement_custom <?php if( $el_class != '' ) echo esc_attr($el_class); ?> <?php echo vc_shortcode_custom_css_class( $css ); ?>">

        <div class="sp_heading"><?php echo $spacialist_title; ?></div>
        <div class="specialist-container">
            <p><?php echo $spacialist_caption_text;?></p>
            <b><?php echo $spacialist_mobile; ?></b>
        </div>


        <?php
        global $post; 

        if ($post->post_parent ){
            $post_id = $post->post_parent;
        }
        else{
            $post_id = $post->ID;
        }

        $custo_destination_id = get_post_meta($post_id, 'custo_destination', true);

        //echo "post_id: ".$post_id; echo "<br>";
        //echo "custo_destination_id: ".$custo_destination_id; echo "<br>";

        if (!empty($custo_destination_id)) {

          $aventura_args_1 = array(
              'post_parent'=>0,
              'post_type' => 'specialist',
              'posts_per_page' => 1,
              'orderby'    => 'rand',
              'order'      => 'DESC',
              'meta_query'    => array(
                  array(
                      'key'       => 'custo_destination',
                      'value'     =>  $custo_destination_id,
                      'compare'   => '=',
                  )
              )
          );  

        }else{ 

          $aventura_args_1 = array(
              'post_parent'=>0,
              'post_type' => 'specialist',
              'posts_per_page' => 1,
              'orderby'    => 'rand',
              'order'      => 'DESC'
          );

        }
        ?>



        <?php

          $aventura_query_1 = new WP_Query($aventura_args_1);

          if($aventura_query_1->have_posts()){  
              
            while( $aventura_query_1->have_posts() ) {

              $aventura_query_1->the_post(); 
                
              $thumb_id = get_post_thumbnail_id(get_the_ID()); 
              //get_the_excerpt();
              $image = "";
              if (!empty($thumb_id)) {
                $image_src = wp_get_attachment_image_src($thumb_id,'thumbnail'); 
                $image = $image_src[0];
              }

              ?>

            
                <div class="specialist-card">

                  <a href=" <?php echo get_permalink(); ?>" class="specialist">
                    <img src="<?php echo $image; ?>">
                    <div class="caption"><div class="text"><?php echo get_the_title(); ?></div></div>
                  </a>

                </div>
         <p class="specialist_link"><a href="<?php echo $spacialist_link;?>">Make an enquiry <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>

              <?php
            } 

          wp_reset_postdata();   
          }else{
            echo "<h1>Not Found Spacialist Data</h1>";
          }
          
        ?>


    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('tz-spacialist','tzaventura_spacialist');
?>