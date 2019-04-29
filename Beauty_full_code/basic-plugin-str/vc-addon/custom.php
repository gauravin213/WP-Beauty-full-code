<?php
function tzaventura_custom($atts) {

    $tz_icon = $custom_dropdown1 = $custom_textfield1 = $el_class = $css = '';
    extract(shortcode_atts(array(
        'tz_icon'               => '1',
        'custom_dropdown1'      => '',
        'custom_count'       => '',
        'custom_cat'       => '',
        'el_class'              => '',
        'css'                   => '',
    ),$atts));
    ob_start();

    wp_enqueue_script('tz-custom');
    ?>
    <div class="tzElement_custom <?php if( $el_class != '' ) echo esc_attr($el_class); ?> <?php echo vc_shortcode_custom_css_class( $css ); ?>">

            <?php
            if (!empty($custom_count)) {
                echo do_shortcode('['.$custom_dropdown1.' count="'.$custom_count.'"]');
            }else{
                 echo do_shortcode('['.$custom_dropdown1.']');
            }
            ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('tz-custom','tzaventura_custom');
?>