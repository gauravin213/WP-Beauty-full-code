<?php
if(function_exists('vc_map')):
vc_map( array(
    "name" => esc_html__("Spacialist", "aventura-plugin"),
    "weight" => 14,
    "base" => "tz-spacialist",
    "icon" => "icon-element",
    "description" => "",
    "class" => "tzElement_extended",
    "category" => esc_html__("Aventura", "aventura-plugin"),
    "params" => array(

        /*array(
          'type' => 'textarea_html',
          'holder' => 'div',
          'heading' => __( 'Text', 'aventura-plugin' ),
          'param_name' => 'spacialist_caption_text',
          'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'js_composer' ),
        ),*/
        array(
            'type'        => 'textfield',
            'param_name'  => 'spacialist_title',
            'heading'     => esc_html__( 'Title', 'aventura-plugin' ),
        ),
        array(
            'type'        => 'textarea',
            'param_name'  => 'spacialist_caption_text',
            'heading'     => esc_html__( 'Caption Text', 'aventura-plugin' ),
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'spacialist_mobile',
            'heading'     => esc_html__( 'Mobile', 'aventura-plugin' ),
        ),
         array(
            'type'        => 'textfield',
            'param_name'  => 'spacialist_link',
            'heading'     => esc_html__( 'Link', 'aventura-plugin' ),
        ),

        array(
            'type'        => 'textfield',
            'param_name'  => 'el_class',
            'heading'     => esc_html__( 'Extra class name', 'aventura-plugin' ),
        ),
        array(
            'type'        => 'css_editor',
            'param_name'  => 'css',
            'heading'     => esc_html__( 'CSS box', 'aventura-plugin' ),
            'group'       => esc_html__( 'Design Options', 'aventura-plugin' ),
        )
    )
) );
endif;
?>