<?php foreach ($_cusproopt_position as $keys => $values) { 

  				  if ($values!="") {
				?>
				

				<div class="woocommerce_product_addon wc-metabox closed">
				<h3>
					<button type="button" class="remove_addon button"><?php _e( 'Remove', 'woocommerce-product-addons' ); ?></button>
					<div class="handlediv" title="<?php _e( 'Click to toggle', 'woocommerce-product-addons' ); ?>"></div>

					<strong>Group <span class="group_name">"A"<?php echo $values;?></span> — </strong>


					<input type="text" name="text" value="55555">
					
					<input type="hidden" name="product_addon_position[<?php echo $values;?>]" class="product_addon_position" value="<?php echo $values;?>" />

				</h3>
				<table cellpadding="0" cellspacing="0" class="wc-metabox-content">
					<tbody>
						<tr>
							<td class="addon_name" width="50%">
								aaaaaaaaaaa
							</td>
							
						</tr>
						<tr>
							<td class="addon_description" colspan="3">
								bbbbbbbbbbbbbbbbbbb
							</td>
						</tr>
						
						
					</tbody>
				</table>
			</div>


			<?php } } ?>