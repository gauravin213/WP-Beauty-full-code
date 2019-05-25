<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="spin-tool-btn">

	<a title="<h2 style='padding:0.5em;'>Spinrewriter Popup<h2>" href="#TB_inline?width=600&height=550&inlineId=my-content-id" class="thickbox button">Spin this article</a>    

	<?php add_thickbox(); ?>
	<div id="my-content-id" style="display:none;">
		<div id="tabs" style="">

			<textarea name="spin_textarea_content" id="spin_textarea_content"></textarea>

			<button id="spin_content_btn" class="button button-primary">Spin Content</button>

		</div>

		<div class="cuspricecal_ajax_loading">Loading...</div>

	</div>

	<script>
		jQuery(function() {
			jQuery( "#tabs" ).tabs();
		});
	</script>

</div>