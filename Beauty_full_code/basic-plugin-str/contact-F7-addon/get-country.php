<?php
add_action( 'wpcf7_init', 'wpcf7_add_form_tag_custom_coutry_list', 10, 1 );

function wpcf7_add_form_tag_custom_coutry_list() {
 
    wpcf7_add_form_tag(
        array('custom_coutry_list', 'custom_coutry_list*' ),
        'wpcf7_custom_coutry_list_form_tag_handler', 
        array( 'name-attr' => true ) 
    );
}


/*validate fields*/
add_filter( 'wpcf7_validate_custom_coutry_list', 'wpcf7_custom_coutry_list_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_custom_coutry_list*', 'wpcf7_custom_coutry_list_validation_filter', 10, 2 );
function wpcf7_custom_coutry_list_validation_filter( $result, $tag ) {
    $name = $tag->name;

    $value = isset( $_POST[$name] )
        ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
        : '';

    if ( 'custom_coutry_list' == $tag->basetype ) {
        if ( $tag->is_required() and '' == $value ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }
    return $result;
}
/*validate fields*/


function wpcf7_custom_coutry_list_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
        return '';
    }

    $url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=2b3d7d0ad1a285279139487ce77f3f58d980eea9546b5ccc5d08f5ee62ce7471&ip=".$_SERVER['REMOTE_ADDR']."&format=json"));

  /*echo "<pre>";
    print_r($url);
    echo "</pre>";*/

    $countryName = $url->countryName;
  
    $item_atts = array();
    $selct = "";
    $item_atts['name'] = $tag->name;

    $html .=  '<span class="wpcf7-form-control-wrap '.$item_atts['name'].'">';

    $html .='<select name="'.$item_atts['name'].'" class="contact-drop wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">';

      $html .= '<option value></option>';

    $woo_country_list = WC()->countries->countries;

    foreach ($woo_country_list as $key => $value) {

        if ($countryName == $value) {  
            $selct = 'selected="selected"'; 
        }
        else{
            $selct = ''; 
        }

        $html .= '<option value="'.$value.'" '.$selct.'>'.$value.'</option>';

    }

    $html .= '</select>';

    $html .= '</span>';


    return $html;
}