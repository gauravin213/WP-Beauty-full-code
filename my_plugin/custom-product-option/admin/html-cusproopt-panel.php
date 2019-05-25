<div id='cusproopt_settings' class='panel woocommerce_options_panel cuspricecal_options_panel wc-metaboxes-wrapper'>

	<div class="woocommerce_product_addons wc-metaboxes ui-sortable">
		<?php
		$loop = 0;
		foreach ( $_cusproopt_position as $addon ) {

			include( 'html-addon.php' );

			$loop++;
		}
		?>
	</div>

	<div class="toolbar">
		<button type="button" class="button add_new_addon button-primary"><?php _e( 'New Addon Group', 'woocommerce-product-addons' ); ?></button>

		<button type="button" class="button import_addons"><?php _e( 'Import', 'woocommerce-product-addons' ); ?></button>

		<button type="button" class="button export_addons"><?php _e( 'Export', 'woocommerce-product-addons' ); ?></button>
	</div>

		

<script type="text/javascript">
	jQuery(function(){

		<?php //if ( version_compare( WC_VERSION, '2.3.0', '<' ) ) { ?>
			jQuery( 'select.chosen_select' ).chosen();
		<?php //} ?>

		jQuery('#cusproopt_settings')
		.on( 'change', '.addon_name input', function() {
			if ( jQuery(this).val() )
				jQuery(this).closest('.woocommerce_product_addon').find('span.group_name').text( '"' + jQuery(this).val() + '"' );
			else
				jQuery(this).closest('.woocommerce_product_addon').find('span.group_name').text('');
		})
		.on( 'change', 'select.product_addon_type', function() {

			var value = jQuery(this).val();

			if ( value == 'custom' || value == 'custom_price' || value == 'custom_textarea' || value == 'input_multiplier' ) {
				jQuery(this).closest('.woocommerce_product_addon').find('td.minmax_column, th.minmax_column').show();
			} else {
				jQuery(this).closest('.woocommerce_product_addon').find('td.minmax_column, th.minmax_column').hide();
			}

			if ( value == 'custom_price' ) {
				jQuery(this).closest('.woocommerce_product_addon').find('td.price_column, th.price_column').hide();
			} else {
				jQuery(this).closest('.woocommerce_product_addon').find('td.price_column, th.price_column').show();
			}
		})
		.on( 'click', 'button.add_addon_option', function() {

			var loop = jQuery(this).closest('.woocommerce_product_addon').index('.woocommerce_product_addon');

			var html = '<?php
				ob_start();

				$option['label'] 	= '';
				$option['price']	= '';
				$option['min'] 		= '';
				$option['max'] 		= '';
				$loop = "{loop}";

				include( 'html-addon-option.php' );

				$html = ob_get_clean();
				echo str_replace( array( "\n", "\r" ), '', str_replace( "'", '"', $html ) );
			?>';

			html = html.replace( /{loop}/g, loop );

			jQuery(this).closest('.woocommerce_product_addon .data').find('tbody').append( html );

			jQuery('select.product_addon_type').change();

			return false;
		})
		.on( 'click', '.add_new_addon', function() { 

			var loop = jQuery('.woocommerce_product_addons .woocommerce_product_addon').size();

			var html = '<?php
				ob_start();

				$addon['name'] 			= '';
				$addon['description']	= '';
				$addon['required'] 		= '';
				$addon['type'] 			= 'checkbox';
				$addon['options'] 		= array();
				$loop = "{loop}";

				include( 'html-addon.php' );

				$html = ob_get_clean();
				echo str_replace( array( "\n", "\r" ), '', str_replace( "'", '"', $html ) );
			?>';

			html = html.replace( /{loop}/g, loop );

			jQuery('.woocommerce_product_addons').append( html );

			jQuery('select.product_addon_type').change();

			return false;
		})
		.on( 'click', '.remove_addon', function() {

			var answer = confirm('<?php _e('Are you sure you want remove this add-on?', 'woocommerce-product-addons'); ?>');

			if (answer) {
				var addon = jQuery(this).closest('.woocommerce_product_addon');
				jQuery(addon).find('input').val('');
				jQuery(addon).hide();
			}

			return false;
		})
		.find('select.product_addon_type').change();

		// Import / Export
		jQuery('#product_addons_data').on('click', '.export_addons', function() {

			jQuery('#product_addons_data textarea.import').hide();
			jQuery('#product_addons_data textarea.export').slideToggle('500', function() {
				jQuery(this).select();
			});

			return false;
		});

		jQuery('#product_addons_data').on('click', '.import_addons', function() {

			jQuery('#product_addons_data textarea.export').hide();
			jQuery('#product_addons_data textarea.import').slideToggle('500', function() {
				jQuery(this).val('');
			});

			return false;
		});

		// Sortable
		jQuery('.woocommerce_product_addons').sortable({
			items:'.woocommerce_product_addon',
			cursor:'move',
			axis:'y',
			handle:'h3',
			scrollSensitivity:40,
			helper:function(e,ui){
				return ui;
			},
			start:function(event,ui){
				ui.item.css('border-style','dashed');
			},
			stop:function(event,ui){
				ui.item.removeAttr('style');
				addon_row_indexes();
			}
		});

		function addon_row_indexes() {
			jQuery('.woocommerce_product_addons .woocommerce_product_addon').each(function(index, el){ jQuery('.product_addon_position', el).val( parseInt( jQuery(el).index('.woocommerce_product_addons .woocommerce_product_addon') ) ); });
		};

		// Sortable options
		jQuery('.woocommerce_product_addon .data table tbody').sortable({
			items:'tr',
			cursor:'move',
			axis:'y',
			scrollSensitivity:40,
			helper:function(e,ui){
				ui.children().each(function(){
					jQuery(this).width(jQuery(this).width());
				});
				return ui;
			},
			start:function(event,ui){
				ui.item.css('background-color','#f6f6f6');
			},
			stop:function(event,ui){
				ui.item.removeAttr('style');
			}
		});

		// Remove option
		jQuery('button.remove_addon_option').live('click', function(){

			var answer = confirm('<?php _e('Are you sure you want delete this option?', 'woocommerce-product-addons'); ?>');

			if (answer) {
				jQuery(this).closest('tr').remove();
			}

			return false;

		});

	});
</script>
</div>