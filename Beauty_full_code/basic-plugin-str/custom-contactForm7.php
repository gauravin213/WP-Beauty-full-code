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



/* form_tag handler */

add_action( 'wpcf7_init', 'wpcf7_add_form_tag_custom_acceptance', 10, 0 );

function wpcf7_add_form_tag_custom_acceptance() {
    wpcf7_add_form_tag( 'custom_acceptance',
        'wpcf7_custom_acceptance_form_tag_handler',
        array(
            'name-attr' => true,
        )
    );
}

function wpcf7_custom_acceptance_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
        return '';
    }

    $validation_error = wpcf7_get_validation_error( $tag->name );

    $class = wpcf7_form_controls_class( $tag->type );

    if ( $validation_error ) {
        $class .= ' wpcf7-not-valid';
    }

    if ( $tag->has_option( 'invert' ) ) {
        $class .= ' invert';
    }

    if ( $tag->has_option( 'optional' ) ) {
        $class .= ' optional';
    }

    $atts = array(
        'class' => trim( $class ),
    );

    $item_atts = array();

    $item_atts['type'] = 'checkbox';
    $item_atts['name'] = $tag->name;
    $item_atts['value'] = '1';
    $item_atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );
    $item_atts['aria-invalid'] = $validation_error ? 'true' : 'false';

    if ( $tag->has_option( 'default:on' ) ) {
        $item_atts['checked'] = 'checked';
    }

    $item_atts['class'] = $tag->get_class_option();
    $item_atts['id'] = $tag->get_id_option();

    $item_atts = wpcf7_format_atts( $item_atts );

    $content = empty( $tag->content )
        ? (string) reset( $tag->values )
        : $tag->content;

    $content = trim( $content );

    if ( $content ) {
        $html = sprintf(
            '<span class="wpcf7-list-item"><label><input %1$s /><span class="wpcf7-list-item-label">%2$s</span></label></span>',
            $item_atts, $content );
    } else {
        $html = sprintf(
            '<span class="wpcf7-list-item"><input %1$s /></span>',
            $item_atts );
    }

    $atts = wpcf7_format_atts( $atts );

    $html = sprintf(
        '<span class="wpcf7-form-control-wrap %1$s"><span %2$s>%3$s</span>%4$s</span>',
        sanitize_html_class( $tag->name ), $atts, $html, $validation_error );

    return $html;
}



add_action( 'wpcf7_admin_init', 'wpcf7_add_tag_generator_custom_acceptance', 35, 0 );

function wpcf7_add_tag_generator_custom_acceptance() {
  $tag_generator = WPCF7_TagGenerator::get_instance();
  $tag_generator->add( 'custom_acceptance', __( 'custom_acceptance', 'contact-form-7' ),
    'wpcf7_tag_generator_custom_acceptance' );
}

function wpcf7_tag_generator_custom_acceptance( $contact_form, $args = '' ) {
    $args = wp_parse_args( $args, array() );
    $type = 'custom_acceptance';

    $description = __( "Generate a form-tag for an custom_acceptance checkbox. For more details, see %s.", 'contact-form-7' );

    $desc_link = wpcf7_link( __( 'https://contactform7.com/custom_acceptance-checkbox/', 'contact-form-7' ), __( 'custom_acceptance Checkbox', 'contact-form-7' ) );

?>
<div class="control-box">
<fieldset>
<legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>

<table class="form-table">
<tbody>
    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
    </tr>

    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-content' ); ?>"><?php echo esc_html( __( 'Condition', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="content" class="oneline large-text" id="<?php echo esc_attr( $args['content'] . '-content' ); ?>" /></td>
    </tr>

    <tr>
    <th scope="row"><?php echo esc_html( __( 'Options', 'contact-form-7' ) ); ?></th>
    <td>
        <fieldset>
        <legend class="screen-reader-text"><?php echo esc_html( __( 'Options', 'contact-form-7' ) ); ?></legend>
        <label><input type="checkbox" name="optional" class="option" checked="checked" /> <?php echo esc_html( __( 'Make this checkbox optional', 'contact-form-7' ) ); ?></label>
        </fieldset>
    </td>
    </tr>

    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
    </tr>

    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
    </tr>

</tbody>
</table>
</fieldset>
</div>

<div class="insert-box">
    <input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

    <div class="submitbox">
    <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
    </div>
</div>
<?php
}



