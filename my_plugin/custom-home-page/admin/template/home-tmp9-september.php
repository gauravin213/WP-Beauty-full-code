<div class="clag-tab" id="september" style="display: none;">
	<form action="options.php" method="post">
	<?php wp_nonce_field('update-options') ?>
	<h2>September</h2>
	<table cellspacing="0" class="optiontable editform">
		<tbody>
						<tr>
			<th scope="row">Calender Category Name:</th>
			<td>
				<label for="september_calender_category_name">
					<input id="september_calender_category_name" type="text" name="september_calender_category_name" value="<?php if (get_option('september_calender_category_name')) echo get_option('september_calender_category_name'); ?>" />
					<input id="9_month" type="hidden" name="9_month" value="9" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Calender Title:</th>
			<td>
				<label for="september_calender_title">
					<input id="september_calender_title" type="text" name="september_calender_title" value="<?php if (get_option('september_calender_title')) echo get_option('september_calender_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Calender Description:</th>
			<td>
				<label for="september_calender_description">
					<textarea id="september_calender_description" type="text" name="september_calender_description"><?php if (get_option('september_calender_description')) echo get_option('september_calender_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Calender Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_cal', get_option( 'september_image_cal') );?>
				</div>
				<div>Size: 800 x 534 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Calender Link:</th>
			<td>
				<label for="september_calender_link">
					<input id="september_calender_link" type="text" name="september_calender_link" value="<?php if (get_option('september_calender_link')) echo get_option('september_calender_link'); ?>" />
				</label>
			</td>
		</tr>
				<tr>
			<th scope="row">Favorites Category Name:</th>
			<td>
				<label for="september_favorites_category_name">
					<input id="september_favorites_category_name" type="text" name="september_favorites_category_name" value="<?php if (get_option('september_favorites_category_name')) echo get_option('september_favorites_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Favorites Title:</th>
			<td>
				<label for="september_favorites_title">
					<input id="september_favorites_title" type="text" name="september_favorites_title" value="<?php if (get_option('september_favorites_title')) echo get_option('september_favorites_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Favorites Description:</th>
			<td>
				<label for="september_favorites_description">
					<textarea id="september_favorites_description" type="text" name="september_favorites_description"><?php if (get_option('september_favorites_description')) echo get_option('september_favorites_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Favorites Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_fav', get_option( 'september_image_fav') );?>
				</div>
				<div>Size: 533 x 800 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Favorites Link:</th>
			<td>
				<label for="september_favorites_link">
					<input id="september_favorites_link" type="text" name="september_favorites_link" value="<?php if (get_option('september_favorites_link')) echo get_option('september_favorites_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 1 Category Name:</th>
			<td>
				<label for="september_home_1_category_name">
					<input id="september_home_1_category_name" type="text" name="september_home_1_category_name" value="<?php if (get_option('september_home_1_category_name')) echo get_option('september_home_1_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 1 Title:</th>
			<td>
				<label for="september_home_1_title">
					<input id="september_home_1_title" type="text" name="september_home_1_title" value="<?php if (get_option('september_home_1_title')) echo get_option('september_home_1_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 1 Description:</th>
			<td>
				<label for="september_home_1_description">
					<textarea id="september_home_1_description" type="text" name="september_home_1_description"><?php if (get_option('september_home_1_description')) echo get_option('september_home_1_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 1 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_1', get_option( 'september_image_1') );?>
				</div>
				<div>Size: 4595 x 3804 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 1 Link:</th>
			<td>
				<label for="september_home_1_link">
					<input id="september_home_1_link" type="text" name="september_home_1_link" value="<?php if (get_option('september_home_1_link')) echo get_option('september_home_1_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 2 Category Name:</th>
			<td>
				<label for="september_home_2_category_name">
					<input id="september_home_2_category_name" type="text" name="september_home_2_category_name" value="<?php if (get_option('september_home_2_category_name')) echo get_option('september_home_2_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
		<th scope="row">Home 2 Title:</th>
		<td>
		<label for="september_home_2_title">
		<input id="september_home_2_title" type="text" name="september_home_2_title" value="<?php if (get_option('september_home_2_title')) echo get_option('september_home_2_title'); ?>" />

		</label>
		</td>
		</tr>

		<tr>
		<th scope="row">Home 2 Image:</th>
		<td>

			<div class="thumb-img-front">
		<?php echo consultant_image_uploader_field( 'september_image_2', get_option('september_image_2') );?>
		</div>
		<div>Size: 590 x 583 px</div>

		</td>
		</tr>

		<tr>
		<th scope="row">Home 2 Description:</th>
		<td>
		<label for="september_home_2_description">
		<textarea id="september_home_2_description" type="text" name="september_home_2_description"><?php if (get_option('september_home_2_description')) echo get_option('september_home_2_description'); ?></textarea>

		</label>
		</td>
		</tr>


		<tr>
			<th scope="row">Home 2 Link:</th>
			<td>
				<label for="september_home_2_link">
					<input id="september_home_2_link" type="text" name="september_home_2_link" value="<?php if (get_option('september_home_2_link')) echo get_option('september_home_2_link'); ?>" />
				</label>
			</td>
		</tr>

		<tr>
			<th scope="row">Home 3 Category Name:</th>
			<td>
				<label for="september_home_3_category_name">
					<input id="september_home_3_category_name" type="text" name="september_home_3_category_name" value="<?php if (get_option('september_home_3_category_name')) echo get_option('september_home_3_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 3 Title:</th>
			<td>
				<label for="september_home_3_title">
					<input id="september_home_3_title" type="text" name="september_home_3_title" value="<?php if (get_option('september_home_3_title')) echo get_option('september_home_3_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 3 Description:</th>
			<td>
				<label for="september_home_3_description">
					<textarea id="september_home_3_description" type="text" name="september_home_3_description"><?php if (get_option('september_home_3_description')) echo get_option('september_home_3_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 3 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_3', get_option( 'september_image_3') );?>
				</div>
				<div>Size: 262 x 279 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 3 Link:</th>
			<td>
				<label for="september_home_3_link">
					<input id="september_home_3_link" type="text" name="september_home_3_link" value="<?php if (get_option('september_home_3_link')) echo get_option('september_home_3_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 4 Category Name:</th>
			<td>
				<label for="september_home_4_category_name">
					<input id="september_home_4_category_name" type="text" name="september_home_4_category_name" value="<?php if (get_option('september_home_4_category_name')) echo get_option('september_home_4_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 4 Title:</th>
			<td>
				<label for="september_home_4_title">
					<input id="september_home_4_title" type="text" name="september_home_4_title" value="<?php if (get_option('september_home_4_title')) echo get_option('september_home_4_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 4 Description:</th>
			<td>
				<label for="september_home_4_description">
					<textarea id="september_home_4_description" type="text" name="september_home_4_description"><?php if (get_option('september_home_4_description')) echo get_option('september_home_4_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 4 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_4', get_option( 'september_image_4') );?>
				</div>
				<div>Size: 413 x 314 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 4 Link:</th>
			<td>
				<label for="september_home_4_link">
					<input id="september_home_4_link" type="text" name="september_home_4_link" value="<?php if (get_option('september_home_4_link')) echo get_option('september_home_4_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 5 Category Name:</th>
			<td>
				<label for="september_home_5_category_name">
					<input id="september_home_5_category_name" type="text" name="september_home_5_category_name" value="<?php if (get_option('september_home_5_category_name')) echo get_option('september_home_5_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 5 Title:</th>
			<td>
				<label for="september_home_5_title">
					<input id="september_home_5_title" type="text" name="september_home_5_title" value="<?php if (get_option('september_home_5_title')) echo get_option('september_home_5_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 5 Description:</th>
			<td>
				<label for="september_home_5_description">
					<textarea id="september_home_5_description" type="text" name="september_home_5_description"><?php if (get_option('september_home_5_description')) echo get_option('september_home_5_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 5 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_5', get_option( 'september_image_5') );?>
				</div>
				<div>Size: 310 x 368 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 5 Link:</th>
			<td>
				<label for="september_home_5_link">
					<input id="september_home_5_link" type="text" name="september_home_5_link" value="<?php if (get_option('september_home_5_link')) echo get_option('september_home_5_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 6 Category Name:</th>
			<td>
				<label for="september_home_6_category_name">
					<input id="september_home_6_category_name" type="text" name="september_home_6_category_name" value="<?php if (get_option('september_home_6_category_name')) echo get_option('september_home_6_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 6 Title:</th>
			<td>
				<label for="september_home_6_title">
					<input id="september_home_6_title" type="text" name="september_home_6_title" value="<?php if (get_option('september_home_6_title')) echo get_option('september_home_6_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 6 Description:</th>
			<td>
				<label for="september_home_6_description">
					<textarea id="september_home_6_description" type="text" name="september_home_6_description"><?php if (get_option('september_home_6_description')) echo get_option('september_home_6_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 6 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_6', get_option( 'september_image_6') );?>
				</div>
				<div>Size: 676 x 836 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 6 Link:</th>
			<td>
				<label for="september_home_6_link">
					<input id="september_home_6_link" type="text" name="september_home_6_link" value="<?php if (get_option('september_home_6_link')) echo get_option('september_home_6_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 7 Category Name:</th>
			<td>
				<label for="september_home_7_category_name">
					<input id="september_home_7_category_name" type="text" name="september_home_7_category_name" value="<?php if (get_option('september_home_7_category_name')) echo get_option('september_home_7_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 7 Title:</th>
			<td>
				<label for="september_home_7_title">
					<input id="september_home_7_title" type="text" name="september_home_7_title" value="<?php if (get_option('september_home_7_title')) echo get_option('september_home_7_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 7 Description:</th>
			<td>
				<label for="september_home_7_description">
					<textarea id="september_home_7_description" type="text" name="september_home_7_description"><?php if (get_option('september_home_7_description')) echo get_option('september_home_7_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 7 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_7', get_option( 'september_image_7') );?>
				</div>
				<div>Size: 464 x 351 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 7 Link:</th>
			<td>
				<label for="september_home_7_link">
					<input id="september_home_7_link" type="text" name="september_home_7_link" value="<?php if (get_option('september_home_7_link')) echo get_option('september_home_7_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 8 Category Name:</th>
			<td>
				<label for="september_home_8_category_name">
					<input id="september_home_8_category_name" type="text" name="september_home_8_category_name" value="<?php if (get_option('september_home_8_category_name')) echo get_option('september_home_8_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 8 Title:</th>
			<td>
				<label for="september_home_8_title">
					<input id="september_home_8_title" type="text" name="september_home_8_title" value="<?php if (get_option('september_home_8_title')) echo get_option('september_home_8_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 8 Description:</th>
			<td>
				<label for="september_home_8_description">
					<textarea id="september_home_8_description" type="text" name="september_home_8_description"><?php if (get_option('september_home_8_description')) echo get_option('september_home_8_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 8 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_8', get_option( 'september_image_8') );?>
				</div>
				<div>Size: 891 x 326 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 8 Link:</th>
			<td>
				<label for="september_home_8_link">
					<input id="september_home_8_link" type="text" name="september_home_8_link" value="<?php if (get_option('september_home_8_link')) echo get_option('september_home_8_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 9 Category Name:</th>
			<td>
				<label for="september_home_9_category_name">
					<input id="september_home_9_category_name" type="text" name="september_home_9_category_name" value="<?php if (get_option('september_home_9_category_name')) echo get_option('september_home_9_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 9 Title:</th>
			<td>
				<label for="september_home_9_title">
					<input id="september_home_9_title" type="text" name="september_home_9_title" value="<?php if (get_option('september_home_9_title')) echo get_option('september_home_9_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 9 Description:</th>
			<td>
				<label for="september_home_9_description">
					<textarea id="september_home_9_description" type="text" name="september_home_9_description"><?php if (get_option('september_home_9_description')) echo get_option('september_home_9_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 9 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_9', get_option( 'september_image_9') );?>
				</div>
				<div>Size: 367 x 342 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 9 Link:</th>
			<td>
				<label for="september_home_9_link">
					<input id="september_home_9_link" type="text" name="september_home_9_link" value="<?php if (get_option('september_home_9_link')) echo get_option('september_home_9_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 10 Category Name:</th>
			<td>
				<label for="september_home_10_category_name">
					<input id="september_home_10_category_name" type="text" name="september_home_10_category_name" value="<?php if (get_option('september_home_10_category_name')) echo get_option('september_home_10_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 10 Title:</th>
			<td>
				<label for="september_home_10_title">
					<input id="september_home_10_title" type="text" name="september_home_10_title" value="<?php if (get_option('september_home_10_title')) echo get_option('september_home_10_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 10 Description:</th>
			<td>
				<label for="september_home_10_description">
					<textarea id="september_home_10_description" type="text" name="september_home_10_description"><?php if (get_option('september_home_10_description')) echo get_option('september_home_10_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 10 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_10', get_option( 'september_image_10') );?>
				</div>
				<div>Size: 567 x 429 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 10 Link:</th>
			<td>
				<label for="september_home_10_link">
					<input id="september_home_10_link" type="text" name="september_home_10_link" value="<?php if (get_option('september_home_10_link')) echo get_option('september_home_10_link'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 11 Category Name:</th>
			<td>
				<label for="september_home_11_category_name">
					<input id="september_home_11_category_name" type="text" name="september_home_11_category_name" value="<?php if (get_option('september_home_11_category_name')) echo get_option('september_home_11_category_name'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 11 Title:</th>
			<td>
				<label for="september_home_11_title">
					<input id="september_home_11_title" type="text" name="september_home_11_title" value="<?php if (get_option('september_home_11_title')) echo get_option('september_home_11_title'); ?>" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 11 Description:</th>
			<td>
				<label for="september_home_11_description">
					<textarea id="september_home_11_description" type="text" name="september_home_11_description"><?php if (get_option('september_home_11_description')) echo get_option('september_home_11_description'); ?></textarea>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 11 Image:</th>
			<td>
				<div class="thumb-img-front">
					<?php echo consultant_image_uploader_field( 'september_image_11', get_option( 'september_image_11') );?>
				</div>
				<div>Size: 464 x 351 px</div>
			</td>
		</tr>
		<tr>
			<th scope="row">Home 11 Link:</th>
			<td>
				<label for="september_home_11_link">
					<input id="september_home_11_link" type="text" name="september_home_11_link" value="<?php if (get_option('september_home_11_link')) echo get_option('september_home_11_link'); ?>" />
				</label>
			</td>
		</tr>

	</tbody>
</table>


<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="september_calender_category_name,september_calender_description,september_calender_title,september_calender_link,september_favorites_category_name,september_favorites_description,september_favorites_title,september_favorites_link,september_home_1_category_name,september_home_1_description,september_home_1_title,september_home_1_link,september_home_2_title,september_home_2_category_name,september_home_2_description,september_image_1,september_image_2,september_image_3,september_image_4,september_image_5,september_image_6,september_image_7,september_image_8,september_image_9,september_image_10,september_image_11,september_image_cal,september_image_fav,september_home_2_link,september_home_3_title,september_home_3_category_name,september_home_3_description,september_image_3,september_home_3_link,september_home_4_title,september_home_4_category_name,september_home_4_description,september_image_4,september_home_4_link,september_home_5_title,september_home_5_category_name,september_home_5_description,september_image_5,september_home_5_link,september_home_6_title,september_home_6_category_name,september_home_6_description,september_image_6,september_home_6_link,september_home_7_title,september_home_7_category_name,september_home_7_description,september_image_7,september_home_7_link,september_home_8_title,september_home_8_category_name,september_home_8_description,september_image_8,september_home_8_link,september_home_9_title,september_home_9_category_name,september_home_9_description,september_image_9,september_home_9_link,september_home_10_title,september_home_10_category_name,september_home_10_description,september_image_10,september_home_10_link,september_home_11_title,september_home_11_category_name,september_home_11_description,september_image_11,september_home_11_link,9_month" />

<p class="submit">
<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
</p>


</form>
</div>