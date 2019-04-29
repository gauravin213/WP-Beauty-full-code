<?php
if(function_exists('vc_map')):
vc_map( array(
    "name" => esc_html__("Custom", "aventura-plugin"),
    "weight" => 14,
    "base" => "tz-custom",
    "icon" => "icon-element",
    "description" => "",
    "class" => "tzElement_extended",
    "category" => esc_html__("Aventura", "aventura-plugin"),
    "params" => array(
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => esc_html__("Custom dropdown1", "aventura-plugin"),
            "param_name"    => "custom_dropdown1",
            "description"   => esc_html__("", "aventura-plugin"),
            "value"         => array(
                esc_html__("--select option--", "aventura-plugin")          => '',
                esc_html__("[custom_toue_filter_list_shortcode]",  "aventura-plugin")         => 'custom_toue_filter_list_shortcode',
                esc_html__("[custom_toue_carousel_shortcode]",  "aventura-plugin")         => 'custom_toue_carousel_shortcode',
                esc_html__("[custom_toue_list_shortcode]",  "aventura-plugin")         => 'custom_toue_list_shortcode',
                esc_html__("[toue_guides_shortcode]",  "aventura-plugin")         => 'toue_guides_shortcode',

                esc_html__("[custom_places_list_shortcode]",  "aventura-plugin")         => 'custom_places_list_shortcode',
                esc_html__("[custom_hotels_list_shortcode]",  "aventura-plugin")         => 'custom_hotels_list_shortcode',
                esc_html__("[custom_activities_list_shortcode]",  "aventura-plugin")         => 'custom_activities_list_shortcode',
                esc_html__("[custom_cruises_list_shortcode]",  "aventura-plugin")         => 'custom_cruises_list_shortcode',
                esc_html__("[custom_best_time_to_visit_list_shortcode]",  "aventura-plugin")         => 'custom_best_time_to_visit_list_shortcode',
            ),
            "default"       => '1',
        ),

        array(
            'type'        => 'textfield',
            'param_name'  => 'custom_count',
            'heading'     => esc_html__( 'Cout', 'aventura-plugin' ),
        ),
        /*array(
            'type'        => 'textfield',
            'param_name'  => 'custom_cat',
            'heading'     => esc_html__( 'Category id', 'aventura-plugin' ),
        ),*/

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