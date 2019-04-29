<?php
add_action( 'wpcf7_admin_init', 'wpcf7_add_tag_generator_custom_coutry_list', 35, 0 );

function wpcf7_add_tag_generator_custom_coutry_list() {
  $tag_generator = WPCF7_TagGenerator::get_instance();
  $tag_generator->add( 'custom_coutry_list', __( 'Custom Coutry List', 'contact-form-7' ),
    'wpcf7_tag_generator_custom_coutry_list' );
}

function wpcf7_tag_generator_custom_coutry_list( $contact_form, $args = '' ) {
    $args = wp_parse_args( $args, array() );
    $type = 'custom_coutry_list';

    $description = __( "Generate a form-tag for an custom_coutry_list checkbox. For more details, see %s.", 'contact-form-7' );

    $desc_link = wpcf7_link( __( 'https://contactform7.com/custom_coutry_list-checkbox/', 'contact-form-7' ), __( 'custom_coutry_list Checkbox', 'contact-form-7' ) );

?>
<div class="control-box">
<fieldset>
<legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>

<table class="form-table">
<tbody>

    <tr>
    <th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
    <td>
        <fieldset>
        <legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
        <label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
        </fieldset>
    </td>
    </tr>
    
    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
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