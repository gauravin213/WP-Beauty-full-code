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
				<td colspan="3">
					<h1><?php echo _e('Spin Rewriter API settings - authentication', 'cus-spin-tool');?></h1>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					Get short code : [spin_rewritertool_shortcode]
				</td>
			</tr>

			

			<tr>
				<th scope="row">
					<label for="spinrewriter_email"><?php echo _e('Email Id', 'cus-spin-tool');?></label>
				</th>

				<td>
					<input name="spinrewriter_email" id="spinrewriter_email" type="text" class="regular-text" value="<?php if (get_option('spinrewriter_email')) echo get_option('spinrewriter_email'); ?>">

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Note', 'cus-spin-tool');?>:</strong>
						<?php echo _e('included with every request', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('The email address that youre using with Spin Rewriter.', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="spinrewriter_api_key"><?php echo _e('Api Key', 'cus-spin-tool');?></label>
				</th>
				<td>
					<input name="spinrewriter_api_key" id="spinrewriter_api_key" type="text" class="regular-text" value="<?php if (get_option('spinrewriter_api_key')) echo get_option('spinrewriter_api_key'); ?>">

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Note', 'cus-spin-tool');?>:</strong>
						<?php echo _e('included with every request', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Your unique API key. It can be found on this page..', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>


			<tr>
				<td colspan="3">
					<h1><?php echo _e('Spin Rewriter API settings - request details', 'cus-spin-tool');?></h1>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_protected_terms"><?php echo _e('Auto Protected Terms', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_protected_terms" id="auto_protected_terms">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_protected_terms'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_protected_terms'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>

					<p class="description" id="tagline-description">
						<?php echo _e(' false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter automatically protect all Capitalized Words except for those in the title of your original text?', 'cus-spin-tool');
						?>	
					</p>

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

					<p class="description" id="tagline-description">
						<?php echo _e('medium   (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('The confidence level of the One-Click Rewrite process.', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('low', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('largest number of synonyms for various words and phrases, least readable unique variations of text', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('medium', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('relatively reliable synonyms, usually well readable unique variations of text (default setting)', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('high', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('only the most reliable synonyms, perfectly readable unique variations of text', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_sentences"><?php echo _e('Auto Sentences', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_sentences" id="auto_sentences">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_sentences'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_sentences'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter spin entire paragraphs?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", some paragraphs will be replaced with a (shorter) spun variation.', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_paragraphs"><?php echo _e('Auto Paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_paragraphs" id="auto_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_paragraphs'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_paragraphs'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter spin entire paragraphs?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", some paragraphs will be replaced with a (shorter) spun variation.', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_new_paragraphs"><?php echo _e('Auto New Paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_new_paragraphs" id="auto_new_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_new_paragraphs'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_new_paragraphs'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter automatically write additional paragraphs on its own?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", the returned spun text will contain additional paragraphs.', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="auto_sentence_trees"><?php echo _e('Auto sentence trees', 'cus-spin-tool');?></label></th>
				<td>
					<select name="auto_sentence_trees" id="auto_sentence_trees">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('auto_sentence_trees'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('auto_sentence_trees'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					

					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter automatically change the entire structure of phrases and sentences?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", Spin Rewriter will change "If he is hungry, John eats." to "John eats if he is hungry." and "John eats and drinks." to "John drinks and eats."', 'cus-spin-tool');
						?>	
					</p>


				</td>
			</tr>

			<tr>
				<th scope="row"><label for="use_only_synonyms"><?php echo _e('Use only synonyms', 'cus-spin-tool');?></label></th>
				<td>
					<select name="use_only_synonyms" id="use_only_synonyms">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('use_only_synonyms'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('use_only_synonyms'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter use only synonyms of the original words instead of the original words themselves?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", Spin Rewriter will never use any of the original words of phrases if there is a synonym available. This significantly improves the uniqueness of generated spun content.', 'cus-spin-tool');
						?>	
					</p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="reorder_paragraphs"><?php echo _e('Reorder paragraphs', 'cus-spin-tool');?></label></th>
				<td>
					<select name="reorder_paragraphs" id="reorder_paragraphs">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('reorder_paragraphs'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('reorder_paragraphs'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter intelligently randomize the order of paragraphs and unordered lists when generating spun text?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", Spin Rewriter will randomize the order of paragraphs and lists where possible while preserving the readability of the text. This significantly improves the uniqueness of generated spun content.', 'cus-spin-tool');
						?>	
					</p>


				</td>
			</tr>

			<tr>
				<th scope="row"><label for="nested_spintax"><?php echo _e('Nested spintax', 'cus-spin-tool');?></label></th>
				<td>
					<select name="nested_spintax" id="nested_spintax">
						<option value="">--<?php echo _e('select', 'cus-spin-tool');?>--</option>
						<option value="1" <?php echo selected(1,get_option('nested_spintax'))?>><?php echo _e('True', 'cus-spin-tool');?></option>
						<option value="0" <?php echo selected(0,get_option('nested_spintax'))?>><?php echo _e('False', 'cus-spin-tool');?></option>
					</select>
					
					<p class="description" id="tagline-description">
						<?php echo _e('false (default)', 'cus-spin-tool');?>	
					</p>

					<p class="description" id="tagline-description">
						<strong><?php echo _e('Description', 'cus-spin-tool');?>:</strong>
						<?php 
						echo _e('Should Spin Rewriter also spin single words inside already spun phrases?', 'cus-spin-tool');
						?>	
					</p>

					<p class="description" id="tagline-description">
						<?php 
						echo _e('If set to "true", the returned spun text might contain 2 levels of nested spinning syntax.', 'cus-spin-tool');
						?>	
					</p>

				</td>
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