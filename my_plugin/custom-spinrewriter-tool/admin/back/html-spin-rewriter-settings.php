<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}	
?>
<div class="wrap">
	<h1><?php echo _e('Spinrewriter Tool Settings', 'cus-spin-tool');?></h1>

	<form method="post" action="options.php" novalidate="novalidate">

      <?php wp_nonce_field('update-options') ?>

		<table class="form-table">

			<tbody>

			<tr>
				<th scope="row"><label for="spinrewriter_email"><?php echo _e('Email Id', 'cus-spin-tool');?></label></th>
				<td><input name="spinrewriter_email" id="spinrewriter_email" type="text" class="regular-text" value="<?php if (get_option('spinrewriter_email')) echo get_option('spinrewriter_email'); ?>"></td>
			</tr>

			<tr>
				<th scope="row"><label for="spinrewriter_api_key"><?php echo _e('Api Key', 'cus-spin-tool');?></label></th>
				<td><input name="spinrewriter_api_key" id="spinrewriter_api_key" type="text" class="regular-text" value="<?php if (get_option('spinrewriter_api_key')) echo get_option('spinrewriter_api_key'); ?>">
				</td>
			</tr>


			<tr>
				<th scope="row"><label for="spin_post_after"><?php echo _e('Spin post after', 'cus-spin-tool');?></label></th>
				<td>
					<select name="spin_post_after" id="spin_post_after">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('spin_post_after'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('spin_post_after'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>



			<tr>
				<th scope="row"><label for="spin_post_title"><?php echo _e('Spin post title', 'cus-spin-tool');?></label></th>
				<td>
					<select name="spin_post_title" id="spin_post_title">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('spin_post_title'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('spin_post_title'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="public_as_new_post"><?php echo _e('Public as new post', 'cus-spin-tool');?></label></th>
				<td>
					<select name="public_as_new_post" id="public_as_new_post">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('public_as_new_post'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('public_as_new_post'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="blogname"><?php echo _e('Do not spin these posts', 'cus-spin-tool');?></label></th>
				<td><input name="text" type="text" class="regular-text"></td>
			</tr>

			<tr>
				<td colspan="3">
					<h1><?php echo _e('Spinrewriter Tool Settings', 'cus-spin-tool');?></h1>
				</td>
			</tr>


			<!---->
			<tr>
				<th scope="row"><label for="auto_protected_terms"><?php echo _e('Auto Protected Terms', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_protected_terms" id="auto_protected_terms">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_protected_terms'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_protected_terms'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="confidence_level"><?php echo _e('Confidence Level', 'cus-spin-tool');?></label></th>
				<td>
					<select name="confidence_level" id="confidence_level">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('confidence_level'))?>><?php echo _e('high', 'cus-spin-tool');?></option>
						<option value="2" <?php echo selected(2,get_option('confidence_level'))?>><?php echo _e('low', 'cus-spin-tool');?></option>
						<option value="3" <?php echo selected(3,get_option('confidence_level'))?>><?php echo _e('medium', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_sentences"><?php echo _e('Auto Sentences', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_sentences" id="auto_sentences">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_sentences'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_sentences'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_paragraphs"><?php echo _e('Auto Paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_paragraphs" id="auto_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_paragraphs'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_paragraphs'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_new_paragraphs"><?php echo _e('Auto New Paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_new_paragraphs" id="auto_new_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_new_paragraphs'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_new_paragraphs'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_sentence_trees"><?php echo _e('Auto sentence trees', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_sentence_trees" id="auto_sentence_trees">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_sentence_trees'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_sentence_trees'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="use_only_synonyms"><?php echo _e('Use only synonyms', 'cus-spin-tool');?></label></th>
				<td>
					<select name="use_only_synonyms" id="use_only_synonyms">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('use_only_synonyms'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('use_only_synonyms'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="reorder_paragraphs"><?php echo _e('Reorder paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="reorder_paragraphs" id="reorder_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('reorder_paragraphs'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('reorder_paragraphs'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="nested_spintax"><?php echo _e('Nested spintax', 'cus-spin-tool');?></label></th>
				<td>
					<select name="nested_spintax" id="nested_spintax">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('nested_spintax'))?>><?php echo _e('Yes', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('nested_spintax'))?>><?php echo _e('No', 'cus-spin-tool');?></option>
					</select>
				</td>
			</tr>
			<!---->

			<tr>
				<th scope="row"><label for="blogname"><?php echo _e('Run', 'cus-spin-tool');?> 24/7 </label></th>
				<td><input name="text" type="text" class="regular-text"></td>
			</tr>

			</tbody>

		</table>


		<!---->
		<input type="hidden" name="action" value="update" />
      	<input type="hidden" name="page_options" value="spinrewriter_email,spinrewriter_api_key,auto_protected_terms,confidence_level,auto_sentences,auto_paragraphs,auto_new_paragraphs,auto_protected_terms,auto_sentence_trees,use_only_synonyms,reorder_paragraphs,nested_spintax" />
		<!---->

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

	</form>
</div>