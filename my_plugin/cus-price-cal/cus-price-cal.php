<?php
/*
* Plugin Name: Custom Price Calculator
* Author: Clag Dev
* Text Domain: cus-price-cal
* Description: This is the custom price calculator plugin
* Version: 1.0.0
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/*
* Check if WooCommerce is active
*/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
define( 'CUSPRICECAL_VERSION', '1.0.0' );
define( 'CUSPRICECAL_URI', plugin_dir_url( __FILE__ ) );

class Cuspricecal
{
	
	function __construct()
	{

		add_action('init', array( $this,'cuspricecal_StartSession'), 1);

		//Load textdomain
		add_action( 'plugins_loaded', array( $this, 'cuspricecal_load_textdomain' ) );

		// Product data tabs
		add_filter( 'woocommerce_product_data_tabs', array( $this,'cuspricecal_product_data_tabs') );

		// Product data panels
		add_action( 'woocommerce_product_data_panels', array( $this,'cuspricecal_product_data_panels') );

		// Product data
		//add_action( 'save_post', array( $this, 'cuspricecal_save_option_field' ) );

		// Frontend Product data
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'cuspricecal_add_to_cart_form' ), 10 );

		// Enqueue backend scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'cuspricecal_admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_cuspricecal_myback_action', array( $this,'cuspricecal_myback_action_function'));
		add_action( 'wp_ajax_nopriv_cuspricecal_myback_action', array( $this,'cuspricecal_myback_action_function'));

		// Add front-end ajax
		add_action( 'wp_enqueue_scripts', array( $this,'cuspricecal_wp_enqueue_scripts'));
		add_action( 'wp_ajax_cuspricecal_my_action', array( $this,'cuspricecal_my_action_function'));
		add_action( 'wp_ajax_nopriv_cuspricecal_my_action', array( $this,'cuspricecal_my_action_function'));

		//show results
		add_action( 'woocommerce_before_add_to_cart_quantity', array( $this,'cuspricecal_result'), 10 );
		//show pricing table on frontend
		//add_action('woocommerce_single_product_summary', array( $this,'cuspricecal_price_table'), 10);


		/*
		* Start: Define cart data
		*/
		// Add to cart
		add_filter('woocommerce_add_cart_item', array($this, 'add_cart_item'), 10000, 1); 

		// Add item data to the cart or define custom variable
		add_filter( 'woocommerce_add_cart_item_data', array($this,'add_cart_item_data'),10000, 2 );
		// Display item data to the cart or show custom variable
		add_filter( 'woocommerce_get_item_data', array($this,'cus_woocommerce_get_item_data'), 10, 2 );

		// Load cart data per page load
		add_filter('woocommerce_get_cart_item_from_session', array($this, 'get_cart_item_from_session'), 10000, 2); 

		//Add meta to order - WC 2.x or save the data when the order is made
		add_action( 'woocommerce_add_order_item_meta',  array($this,'cus_woocommerce_add_order_item_meta') , 10, 2 );
		/*
		* End: Define cart data
		*/

	}

	/*
	* Initalize session
	*/
	function cuspricecal_StartSession() {
		if(!session_id()) {
		    session_start();
		   $_SESSION['cuspricecal_session_test'] = "cuspricecal_session_test";
		}
	}


	/*
	* Load  textdomain for language
	*/
	function cuspricecal_load_textdomain(){
		load_plugin_textdomain( 'cus-price-cal', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/*
	* Define backend script.
	*/
	function cuspricecal_admin_enqueue_scripts() {

		wp_enqueue_style( 'cuspricecal-backendcss', CUSPRICECAL_URI.'assets/css/cuspricecal-backend.css' );

		wp_register_script( 'cuspricecal_back_handle', CUSPRICECAL_URI.'assets/js/cuspricecal-backend.js'); 

		$data = array(
			'product_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'cuspricecal_back_handle', 'datab', $data );


		wp_enqueue_script( 'cuspricecal_back_handle', CUSPRICECAL_URI.'assets/js/cuspricecal-backend.js', array('jquery'), CUSPRICECAL_VERSION, 'all');
	}

	/*
	* Frontend scripts
	*/
	function cuspricecal_wp_enqueue_scripts(){

		wp_enqueue_style('cuspricecal-frontend_choosen', CUSPRICECAL_URI.'assets/css/chosen.css', array(), CUSPRICECAL_VERSION, 'all' );

		wp_enqueue_script( 'cuspricecal_choosen_handle', CUSPRICECAL_URI.'assets/js/chosen.jquery.js', array('jquery'), CUSPRICECAL_VERSION, 'all');

		wp_enqueue_style('cuspricecal-frontend', CUSPRICECAL_URI.'assets/css/cuspricecal-fontend.css', array(), CUSPRICECAL_VERSION, 'all' );


		wp_register_script('cuspricecal_front_handle', CUSPRICECAL_URI.'assets/js/cuspricecal-fontend.js', array('jquery'), CUSPRICECAL_VERSION, true); 

		$data = array(
			'product_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'cuspricecal_front_handle', 'data', $data );
	}


	/*
	* Defined Product Data Tab 
	*/
	function cuspricecal_product_data_tabs( $tabs ) {
		$tabs['cuspricecal'] = array(
			'label'  => esc_html__( 'CusPriceCal', 'cus-price-cal' ),
			'target' => 'cuspricecal_settings',
			'class'  => array( 'show_if_cuspricecal' ),
		);
		return $tabs;
	}

	/*
	* Define Product Data Panel
	*/
 	function cuspricecal_product_data_panels() {
		global $post;
		$post_id = $post->ID;
		$_cuspricecalPdata = get_post_meta( $post_id, '_cuspricecalPdata', true );
		$_standard_fee = $_cuspricecalPdata['standard_fee'];
		?>
		<div id='cuspricecal_settings' class='panel woocommerce_options_panel cuspricecal_options_panel'>



			<div style="width:100%;background-color: #ede7e7;">
			<table>
				<tr>
					<td>
						<strong><?php echo _e('Enable', 'cus-price-cal');?>:</strong>
					</td>
					<td>
						<input type="checkbox" name="cuspricecalStatus" id="cuspricecalStatus" <?php if ($_cuspricecalPdata['pluginStatus'] == 1){ echo "checked";}?>>
					</td>

					<td>
						<strong><?php echo _e('Screen Setup Fees', 'cus-price-cal');?>:</strong>
					</td>
					<td>
						<input type="text" name="cuspricecal_fee" id="cuspricecal_fee" value="<?php if ($_standard_fee) { echo $_standard_fee;}?>">
					</td>

					<td>
						<input type="button" name="cuspricecal_save_ajax" id="cuspricecal_save_ajax" class="button button-primary" value="Save Changes">
					</td>
				</tr>
			</table>
			</div>

		
			<div style="width:100%;">
				<div style="width:10%;float: left;background-color: #ede7e7;">
					<table>
							<tr>
								<th><?php echo _e('Quantity', 'cus-price-cal');?></th>
								<td class="emptyheight"><input type="text" name=""></td>
							</tr>

							<tr>
								<th><?php echo _e('Price', 'cus-price-cal');?></th>
								<td class="emptyheight"><input type="text" name=""></td>
							</tr>

							<?php for ($i=1; $i < 9; $i++) { ?>
							<tr>
								<th><?php echo _e($i.' Color', 'cus-price-cal');?></th>
								<td class="emptyheight"><input type="text" name=""></td>
							</tr>
							<?php } ?>
							<tr>
								<th>&nbsp;</th>
							</tr>
						</table>
				</div>
				<div style="width:90%;float: right;" id="cuspricecal_pricing_table">
		
					<table>
						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalQty[]" value="<?php echo $_cuspricecalPdata['qty_rang'][$i]?>" class="cuspricecalQty cuspricecal_admin_fields">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalPrice[]" value="<?php echo $_cuspricecalPdata['price'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalPrice<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr1[]" value="<?php echo $_cuspricecalPdata['clr1'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr1<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr2[]" value="<?php echo $_cuspricecalPdata['clr2'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr2<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr3[]" value="<?php echo $_cuspricecalPdata['clr3'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr3<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr4[]" value="<?php echo $_cuspricecalPdata['clr4'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr4<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr5[]" value="<?php echo $_cuspricecalPdata['clr5'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr5<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr6[]" value="<?php echo $_cuspricecalPdata['clr6'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr6<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr7[]" value="<?php echo $_cuspricecalPdata['clr7'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr7<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>

						<tr>
							<?php for ($i=0; $i < 8; $i++) { ?>
								<td>
									<input type="text" name="cuspricecalClr8[]" value="<?php echo $_cuspricecalPdata['clr8'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr8<?php echo $i;?>">
								</td>
							<?php } ?>
						</tr>
					</table>

				</div>
			</div>


			<!-- <table>
				<tr>
					<td>
						<strong><?php echo _e('Enable', 'cus-price-cal');?>:</strong>
					</td>
					<td>
						<input type="checkbox" name="cuspricecalStatus" id="cuspricecalStatus" <?php if ($_cuspricecalPdata['pluginStatus'] == 1){ echo "checked";}?>>
					</td>

					<td>
						<strong><?php echo _e('Screen Setup Fees', 'cus-price-cal');?>:</strong>
					</td>
					<td>
						<input type="text" name="cuspricecal_fee" id="cuspricecal_fee" value="<?php if ($_standard_fee) { echo $_standard_fee;}?>">
					</td>

					<td>
						<input type="button" name="cuspricecal_save_ajax" id="cuspricecal_save_ajax" class="button button-primary" value="Save Changes">
					</td>
				</tr>
			</table>

			<div id="cuspricecal_pricing_table">
			<table>
				<tr>
					<th><?php echo _e('qty', 'cus-price-cal');?></th>
					<th><?php echo _e('Price', 'cus-price-cal');?></th>
					<th><?php echo _e('1clr', 'cus-price-cal');?></th>
					<th><?php echo _e('2clr', 'cus-price-cal');?></th>
					<th><?php echo _e('3clr', 'cus-price-cal');?></th>
					<th><?php echo _e('4clr', 'cus-price-cal');?></th>
					<th><?php echo _e('5clr', 'cus-price-cal');?></th>
					<th><?php echo _e('6clr', 'cus-price-cal');?></th>
					<th><?php echo _e('7clr', 'cus-price-cal');?></th>
					<th><?php echo _e('8clr', 'cus-price-cal');?></th>
				</tr>

				<?php for ($i=0; $i < 8; $i++) { ?>

				<tr>
					<td>
						<input type="text" name="cuspricecalQty[]" value="<?php echo $_cuspricecalPdata['qty_rang'][$i]?>" class="cuspricecalQty cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalPrice[]" value="<?php echo $_cuspricecalPdata['price'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalPrice<?php echo $i;?>">
					</td>

					<td>
						<input type="text" name="cuspricecalClr1[]" value="<?php echo $_cuspricecalPdata['clr1'][$i];?>" class="cuspricecal_admin_fields" id="cuspricecalClr1<?php echo $i;?>">
					</td>

					<td>
						<input type="text" name="cuspricecalClr2[]" value="<?php echo $_cuspricecalPdata['clr2'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr3[]" value="<?php echo $_cuspricecalPdata['clr3'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr4[]" value="<?php echo $_cuspricecalPdata['clr4'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr5[]" value="<?php echo $_cuspricecalPdata['clr5'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr6[]" value="<?php echo $_cuspricecalPdata['clr6'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr7[]" value="<?php echo $_cuspricecalPdata['clr7'][$i];?>" class="cuspricecal_admin_fields">
					</td>

					<td>
						<input type="text" name="cuspricecalClr8[]" value="<?php echo $_cuspricecalPdata['clr8'][$i];?>" class="cuspricecal_admin_fields">
					</td>
				</tr>

				<?php } ?>
			</table>
			</div> -->
			<div class="cuspricecal_ajax_loading"></div>
		</div>
		<?php
	}

	/*
	* Save Product data Fields on Backend by post method
	*/
	function cuspricecal_save_option_field( $post_id ) { 

		$cuspricecalPdata = array(); 

		if ($_POST['cuspricecalStatus']) {
		
			$productId = $post_id;

			$cuspricecalPdata['pluginStatus'] = 1;

			$cuspricecalPdata['standard_fee'] = $_POST['cuspricecal_fee'];

			$cuspricecalPdata['qty_rang'] = $_POST['cuspricecalQty'];

			$cuspricecalPdata['price'] = $_POST['cuspricecalPrice'];

			$cuspricecalPdata['clr1'] = $_POST['cuspricecalClr1'];
			$cuspricecalPdata['clr2'] = $_POST['cuspricecalClr2'];
			$cuspricecalPdata['clr3'] = $_POST['cuspricecalClr3'];
			$cuspricecalPdata['clr4'] = $_POST['cuspricecalClr4'];
			$cuspricecalPdata['clr5'] = $_POST['cuspricecalClr5'];
			$cuspricecalPdata['clr6'] = $_POST['cuspricecalClr6'];
			$cuspricecalPdata['clr7'] = $_POST['cuspricecalClr7'];
			$cuspricecalPdata['clr8'] = $_POST['cuspricecalClr8'];

			if (!empty($cuspricecalPdata)) {
				update_post_meta( $productId, '_cuspricecalPdata', $cuspricecalPdata);
			}
		}
	}

	/*
	* Save Product data Fields on Backend by ajax method
	*/
	function cuspricecal_myback_action_function(){

		$productId = $_POST['product_id'];

		$pluginStatus = $_POST['pluginStatus'];

		$cuspricecalPdata = array();

		$cuspricecalPdata['pluginStatus'] = $_POST['pluginStatus'];

		$cuspricecalPdata['standard_fee'] = $_POST['cuspricecal_fee'];

		$cuspricecalPdata['qty_rang'] = $_POST['cuspricecalQty'];

		$cuspricecalPdata['price'] = $_POST['cuspricecalPrice'];

		$cuspricecalPdata['clr1'] = $_POST['cuspricecalClr1'];
		$cuspricecalPdata['clr2'] = $_POST['cuspricecalClr2'];
		$cuspricecalPdata['clr3'] = $_POST['cuspricecalClr3'];
		$cuspricecalPdata['clr4'] = $_POST['cuspricecalClr4'];
		$cuspricecalPdata['clr5'] = $_POST['cuspricecalClr5'];
		$cuspricecalPdata['clr6'] = $_POST['cuspricecalClr6'];
		$cuspricecalPdata['clr7'] = $_POST['cuspricecalClr7'];
		$cuspricecalPdata['clr8'] = $_POST['cuspricecalClr8'];

		if (!empty($cuspricecalPdata)) {
			update_post_meta( $productId, '_cuspricecalPdata', $cuspricecalPdata);
		}
		die();
	}


	/* 
	* Display Product Option Data on Frontend
	*/
	function cuspricecal_add_to_cart_form(){

		global $product; 

		$product_id  = $product->get_id();

		$_cuspricecalPdata = get_post_meta( $product_id, '_cuspricecalPdata', true );

		if ($_cuspricecalPdata['pluginStatus']) { 
		
		if ($_cuspricecalPdata['qty_rang'][0] && $_cuspricecalPdata['price'][0] && $_cuspricecalPdata['clr1'][0]) {

			wp_enqueue_script( 'cuspricecal_front_handle');
			
		?>
			<div class="cuspricecal-container" id="cuspricecal-container">
				<input type="hidden" name="cuspricecal_totalprice" id="cuspricecal_totalprice">
				<input type="hidden" name="cuspricecal_price_per_price_input" id="cuspricecal_price_per_price_input">

				<div class="cuspricecal-qty">
					<label><h3><?php echo _e('Enter qty', 'cus-price-cal');?></h3></label>
					<input type="text" name="cuspricecal_qty" id="cuspricecal_qty" placeholder="Enter qty">
				</div>
				
				<div class="cuspricecal-location">
					<label><h3><?php echo _e('Select locations', 'cus-price-cal');?></h3></label>
					<select name="cuspricecal_location" id="cuspricecal_location" data-placeholder="select" multiple class="chosen-select" tabindex="3">
						<option value="Print front"><?php echo _e('Print front', 'cus-price-cal');?></option>
						<option value="Print back"><?php echo _e('Print back', 'cus-price-cal');?></option>
						<option value="Print sleeve"><?php echo _e('Print sleeve', 'cus-price-cal');?></option>
					</select>
				</div> 
			</div>
		<?php
		}
	}

	}


	/*
	* Show results
	*/
	function cuspricecal_result(){

		global $product; 

		$product_id  = $product->get_id();

		?>
		<div id="cuspricecal_ajax_loader" style="display: none;">
			<img src="<?php echo CUSPRICECAL_URI.'assets/img/loading22.gif';?>">
		</div>

		<div id="cuspricecal-body" style="display: none;">

			<div>
				<?php echo _e('Price', 'cus-price-cal');?>: <span id="cuspricecal_price"></span>
			</div>

			<div>
				<?php echo _e('Impint color cost', 'cus-price-cal');?>: <span id="cuspricecal_color"></span>
			</div>

			<div>
				<?php echo _e('Locations', 'cus-price-cal');?>: <span id="cuspricecal_loc"></span>
			</div>

			<div>
				<?php echo _e('shirt Price', 'cus-price-cal');?>: <span id="cuspricecal_total"></span>
			</div>

			<div class="cuspricecal_standard_fee" style="display: none;"><?php echo _e('Screen Setup Fees', 'cus-price-cal');?>: <span id="cuspricecal_standard_fee"></span>
			</div>

			<div><?php echo _e('Price per piece', 'cus-price-cal');?>: <span id="cuspricecal_price_per_price"></span>
			</div>
					
			<div class="cusprice-addon" style="display: none;"><?php echo _e('Options total', 'cus-price-cal');?>: <span id="cuspricecal_opt_total"></span>
			</div>

			<div><?php echo _e('Grand total', 'cus-price-cal');?>: <span id="cuspricecal_grand_total"></span>
			</div>

		</div>

		<div id="cuspricecal-body2" style="display: none;">
			<?php echo _e('No combination found for qty ', 'cus-price-cal');?>
			<snap id="mtchqty"></snap>
			<?php echo _e('and number of color selected.', 'cus-price-cal');?>
		</div>
		<?php
	}

	/*
	* Show pricing table
	*/
	function cuspricecal_price_table(){
		global $product; 
		$product_id  = $product->get_id();
		$_cuspricecalPdata = get_post_meta( $product_id, '_cuspricecalPdata', true );
		if ($_cuspricecalPdata['pluginStatus']) {
			?>
			<div>
				<h3><?php echo _e('Priceing Table', 'cus-price-cal');?></h3>
				<table>
					<tr>
						<th><?php echo _e('Qty', 'cus-price-cal');?>: </th>
						<?php 
							foreach ($_cuspricecalPdata['qty_rang'] as $pqty) {
								if (!empty($pqty)) {
									echo '<th>'.$pqty.'</th>';
								}
								
							}
						?>
					</tr>

					<tr>
						<th><?php echo _e('Price', 'cus-price-cal');?>: </th>
						<?php 
						foreach ($_cuspricecalPdata['price'] as $pqtyprice) {
							if (!empty($pqtyprice)) {
							echo '<th>'.$pqtyprice.'</th>';
							}
						}
						?>
					</tr>
				</table>
			</div>
			<?php
		}
	}


	/*
	* Frontend ajax calculate shirt price
	*/

	function cuspricecal_my_action_function(){

		$productId = $_POST['productId'];

		$enterd_qty = $_POST['enterd_qty'];

		$ammountofcolor = $_POST['ammountofcolor'];

		$locationsides = $_POST['locationsides'];

		$addonoptiontotal = $_POST['addonoptiontotal'];

		$price_per_price = '';
		$_standard_fee = '';
		$addon_opt_total = '';

		
		$_cuspricecalPdata = get_post_meta( $productId, '_cuspricecalPdata', true );

		/**/
		if (is_array($ammountofcolor)) {
			$_SESSION['cuspricecal_session_colorseprate_name'] = $ammountofcolor;
			//$ammountofcolor = count($ammountofcolor);
			foreach ($ammountofcolor as $keyc) {
				
				$keycount += count($keyc);
			}
			$ammountofcolor = $keycount;
		}
		if (is_array($locationsides)) {
			$locationsides = count($locationsides);
		}
		if (is_array($addonoptiontotal)) {
			$addon_opt_total = array_sum($addonoptiontotal); 
		}
		if ($_cuspricecalPdata['standard_fee']) {
			$_standard_fee = ($ammountofcolor*$locationsides)*$_cuspricecalPdata['standard_fee'];
		}
		/**/

		foreach ($_cuspricecalPdata['qty_rang'] as $key => $value) 
		{

			$qty_rang = explode('-', $_cuspricecalPdata['qty_rang'][$key]);

					
			if ($enterd_qty >= $qty_rang[0] && $enterd_qty <= $qty_rang[1] && $ammountofcolor) 
			{
				$price = $_cuspricecalPdata['price'][$key];

				$clrPrice = $_cuspricecalPdata['clr'.$ammountofcolor][$key];

				//Formula
				if ($addon_opt_total) {

					$calPricetotal = $price+$clrPrice*$locationsides;


					/*--calculating price per price--*/
					$_calPricetotal = $calPricetotal * $enterd_qty;

					$_addon_opt_total = $addon_opt_total * $enterd_qty;

					$total = $_calPricetotal+$_addon_opt_total+$_standard_fee;

					$per_price = ($total / $enterd_qty);

					$price_per_price = number_format($per_price,4);
					/*--calculating price per price--*/

				}
				else{

					$calPricetotal = $price+$clrPrice*$locationsides;

					/*--calculating price per price--*/
					$_calPricetotal = $calPricetotal * $enterd_qty;

					$total = $_calPricetotal+$_standard_fee;

					$per_price = ($total / $enterd_qty);

					$price_per_price = number_format($per_price,4);
					/*--calculating price per price--*/
				}
				
			}
			else
			{
				//echo "<h1>False</h1>";
			}


		}

		$myArr = array(
					'price'=>$price,
					'ammountOfcolor'=>$clrPrice,
					'locationside'=>$locationsides,
					'totalprice'=>$calPricetotal,
					'standard_fee'=>$_standard_fee,
					'price_per_price'=> $price_per_price,
					'addon_opt_total'=> $_addon_opt_total,
					'grand_total'=> $total
					);

		$myJSON = json_encode($myArr); 

		echo $myJSON;
		die();
	}


	function add_cart_item($cart_item) { 

		if ( isset( $cart_item['cuspricecal'] ) ) {

	    	foreach ( $cart_item['cuspricecal'] as $cuspricecal ) {
  
				$price = $cuspricecal['price'];  
			}

			$cart_item['data']->set_price($price);
	    }
		return $cart_item;
	}

	function add_cart_item_data( $cart_item_data, $productId, $variationId ) {

		/**/
		if ($_POST['cuspricecal_price_per_price_input']) {
			$pricePerprice = $_POST['cuspricecal_price_per_price_input'];
		}
		else{
			$pricePerprice = $_POST['cuspricecal_totalprice'];
		}
		/**/
		
		$_pluginStatus = get_post_meta( $productId, '_pluginStatus', true );

		if ($_pluginStatus && $_POST['cuspricecal_totalprice']) {

			/*seprate colors*/
			if($cart_item_data['_product_options']){
			$cart_item_data['_product_options'] = array();
			foreach ($_SESSION['cuspricecal_session_colorseprate_name'] as $key => $value) {
				
				$datac[] = array(
						'name'  => $key,
						'value' => implode(',', $value),
						);

			}
			$cart_item_data['_product_options'] = array_merge( $cart_item_data['_product_options'], $datac);
			unset($_SESSION['cuspricecal_session_colorseprate_name']);
			}
			/*seprate colors*/

			if ( empty( $cart_item_data['cuspricecal'] ) ) {
				$cart_item_data['cuspricecal'] = array();
			}

			$data[] = array(
					'name'  => 'Shirt Price: ',
					'value' => $_POST['cuspricecal_totalprice'],
					'price' => $pricePerprice
					);
				
			$cart_item_data['cuspricecal'] = array_merge( $cart_item_data['cuspricecal'], $data);
		}

		return $cart_item_data;
	}

	function cus_woocommerce_get_item_data( $data, $cartItem ) {

	    if ( isset( $cartItem['cuspricecal'] ) ) {

	    	foreach ( $cartItem['cuspricecal'] as $cuspricecal ) {

				$name = $cuspricecal['name'];  

				$value = $cuspricecal['value'];  

				$price = $cuspricecal['price']; 

			}

	        $data[] = array(
	            'name' => $name,
	            'value' => $value,
	            'display' => 0
	        );
	    }

	    return $data;
	}



	function get_cart_item_from_session($cart_item, $values) {
		
		$cart_item = $this->add_cart_item($cart_item);
		if (!empty($cart_item)) {
			return $cart_item;
		}
		return $cart_item;
	}

	function cus_woocommerce_add_order_item_meta( $item_id, $values ) {
	 
	    if ( ! empty( $values['cuspricecal'] ) ) {
			foreach ( $values['cuspricecal'] as $cuspricecal ) {

				$name = $cuspricecal['name'];
				woocommerce_add_order_item_meta( $item_id, $name, $cuspricecal['value'] );
			}
		}

	}
}
new Cuspricecal();
}
