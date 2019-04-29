<?php
add_action( 'wpcf7_init', 'wpcf7_add_form_tag_custom_tour_list', 10, 1 );

function wpcf7_add_form_tag_custom_tour_list() {
 
    wpcf7_add_form_tag(
        array('custom_tour_list', 'custom_tour_list*' ),
        'wpcf7_custom_tour_list_form_tag_handler', 
        array( 'name-attr' => true ) 
    );
}


/*validate fields*/
add_filter( 'wpcf7_validate_custom_tour_list', 'wpcf7_custom_tour_list_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_custom_tour_list*', 'wpcf7_custom_tour_list_validation_filter', 10, 2 );
function wpcf7_custom_tour_list_validation_filter( $result, $tag ) {
    $name = $tag->name;

    $value = isset( $_POST[$name] )
        ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
        : '';

    if ( 'custom_tour_list' == $tag->basetype ) {
        if ( $tag->is_required() and '' == $value ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }
    return $result;
}
/*validate fields*/


function wpcf7_custom_tour_list_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
        return '';
    }


    if (isset($_POST['MainCountryName'])) { //echo "==>".$_POST['MainCountryName']; echo "<br>";

        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){ 


                var htm = "Myself and one other would like to travel to <?php echo $_POST['MainCountryName'];?> in <?php echo $_POST['TravelDates'];?>";

                jQuery("textarea#travelplans").val(htm);

            });
        </script>
        <?php
       
    }

    /*if (isset($_POST['TravelDates'])) { echo "==>".$_POST['TravelDates']; echo "<br>";
       
    }

    if (isset($_POST['GroupSize'])) { echo "==>".$_POST['GroupSize']; echo "<br>";
       
    }*/



    $item_atts = array();

    $selct = "";

    $item_atts['name'] = $tag->name;

    $html .=  '<span class="wpcf7-form-control-wrap '.$item_atts['name'].'">';

    $html .='<select name="'.$item_atts['name'].'" class="contact-drop wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">';

    $html .= '<option value></option>';


    /**/
    $aventura_args_1 = array(
      'post_parent'=>0,
      'post_type' => 'page',
      'posts_per_page' => -1,
      'orderby'    => 'title',
      'order'      => 'ASC',
    );
    $aventura_query_1 = new WP_Query($aventura_args_1);

    if($aventura_query_1->have_posts()){
    while( $aventura_query_1->have_posts() ) {

      $aventura_query_1->the_post(); 
        
      $_country_code = get_post_meta(get_the_ID(), '_country_code', true);

      if (!empty($_country_code)) {

        if (isset($_POST['MainCountryName'])) { 

            if ($_POST['MainCountryName'] == get_the_title()) {  
                $selct = 'selected="selected"'; 
            }
            else{
                $selct = ''; 
            }
       
        }

        $html .= '<option value="'.get_the_title().'" '.$selct.'>'.get_the_title().'</option>';

        }
    } 
    wp_reset_postdata();  
    }
    /**/

    $html .= '</select>';

    $html .= '</span>';


    return $html;
}