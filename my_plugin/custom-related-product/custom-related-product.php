<?php
/*
* Plugin Name: Custom Related Product
* Description: This is the custom related product plugin which is specially designed for top class.
* Version:3.0.0 
* Author: Clag dev
*Text Domain: woorel
*Domain Path: /languages/
*/

if ( ! class_exists( 'WPcleverRel' ) ) {

define( 'WOOREL_VERSION', '1.0.0' );
define( 'WOOREL_URI', plugin_dir_url( __FILE__ ) );

class WPcleverRel {

	function __construct() {

		// Add select field on front-end
		add_action( 'woocommerce_simple_add_to_cart', array( $this,'woorel_add_to_cart_form'));
		add_action( 'woocommerce_variable_add_to_cart', array( $this,'woorel_add_to_cart_form'));

		// Add front-end ajax
		add_action( 'wp_enqueue_scripts', array( $this,'woorel_wp_enqueue_scripts'));
		add_action( 'wp_ajax_woorel_my_action', array( $this,'woorel_my_action_function'));
		add_action( 'wp_ajax_nopriv_woorel_my_action', array( $this,'woorel_my_action_function'));
	
		// Product data tabs
		add_filter( 'woocommerce_product_data_tabs', array( $this,'woorel_product_data_tabs') );

		// Product data panels
		add_action( 'woocommerce_product_data_panels', array( $this,'woorel_product_data_panels') );
		add_action( 'save_post', array( $this, 'woorel_save_option_field' ) );

		// Enqueue backend scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'woorel_admin_enqueue_scripts' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'woorel_enqueue_styles'));

		// Backend AJAX search
		add_action( 'wp_ajax_woorel_get_search_results', array( $this, 'woorel_get_search_results' ) );

		add_action( 'wp_ajax_woorel_woorel_save_changes', array( $this, 'woorel_woorel_save_changes' ) );


		//echo $key_post_id = $this->get_added_pids(); 
		//print_r($key_post_id);
		//die();
	}

	function get_added_pids(){

		global $wpdb;
		$query =  "SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='woorel_ids'";
		$results = $wpdb->get_results( $query );
			 
		foreach ($results as $key) {

			if ($key->meta_value) {
			     $key_post_id[] = $key->post_id; 
			}
		}
		return $key_post_id;
	}

	function woorel_enqueue_styles(){
		 wp_enqueue_style('woorel-frontend', WOOREL_URI.'assets/css/frontend.css', array(), WOOREL_VERSION, 'all' );
	}

	function woorel_admin_enqueue_scripts() {

		wp_enqueue_style( 'woorel-backend', WOOREL_URI.'assets/css/backend.css' );
		wp_enqueue_script( 'dragarrange-rel', WOOREL_URI.'assets/js/drag-arrange.min.js', array( 'jquery' ), WOOREL_VERSION, true );
		wp_enqueue_script( 'woorel-backend', WOOREL_URI.'assets/js/backend.js', array( 'jquery' ), WOOREL_VERSION, true );
		wp_localize_script( 'woorel-backend', 'woorel_vars', array(
					'woorel_nonce' => wp_create_nonce( 'woorel_nonce' ),
					'pid'=>get_the_ID()
				)
		);
	}

	function woorel_woorel_save_changes() {

		$post_id = $_POST['pid'];

		$woorel_titlesmain = $_POST['woorel_titlesmain'];

		$woorel_titles = explode(',', $_POST['woorel_titles']);

		if ($_POST['woorel_ids']!="") { 

			$woorel_ids = array_unique(explode(",",$post_id.",".$_POST['woorel_ids']));

			foreach ($woorel_ids as $pids) {
				update_post_meta( $pids, 'woorel_ids', self::woorel_clean_ids( implode(",", array_unique($woorel_ids)) ) );
				update_post_meta( $pids, '_woorel_titlesmain', $woorel_titlesmain);
			}

		}

		if ($_POST['get_all_ids']!="") { 

			$removed_ids = $_POST['get_all_ids'];

			foreach ($removed_ids as $pids) {
				update_post_meta( $pids, 'woorel_ids', "" );
			}

		}
		die();

	}

	function woorel_get_search_results() {

		if ( ! isset( $_POST['woorel_nonce'] ) || ! wp_verify_nonce( $_POST['woorel_nonce'], 'woorel_nonce' ) ) {
				die( 'Permissions check failed' );
			}

			//$keyword     = esc_html( $_POST['woorel_keyword'] );

			/*--search by sku start--*/
			$keyword = $_POST['woorel_keyword'];
			$get_pid_by_sku = wc_get_product_id_by_sku($keyword);
			if ($get_pid_by_sku) {
				//echo "---------";
				$product = wc_get_product( $get_pid_by_sku );
				$keyword = $product->get_name();
				//echo "---------";
			}
			/*--search by sku end--*/

			$ids         = self::woorel_clean_ids( $_POST['woorel_ids'] );
			$exclude_ids = array();
			$ids_arrs    = explode( ',', $ids );
			if ( is_array( $ids_arrs ) && count( $ids_arrs ) > 15 ) {
				echo '<ul><span>limit exceeded you can not add more than 5</span></ul>';
			} else {
				if ( is_array( $ids_arrs ) && count( $ids_arrs ) > 0 ) {
					foreach ( $ids_arrs as $ids_arr ) {
						$ids_arr_new   = explode( '/', $ids_arr );
						$exclude_ids[] = absint( $ids_arr_new[0] ? $ids_arr_new[0] : 0 );
					}
				}

				/*--validate search--*/
				$admin_pid = $_POST['woorel_admin_pid'];
				global $wpdb;
			    $query =  "SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='woorel_ids'";
			    $results = $wpdb->get_results( $query );
			 
			    foreach ($results as $key) 
			    {
			        if ($key->meta_value) {
			        	$key_post_id[] = $key->post_id; 
			        }
			    }
			    $exclude_ids_woorel = array_merge($exclude_ids,$key_post_id);
			    $exclude_ids = $exclude_ids_woorel;
				/*--validate search--*/




				$query_args = array(
					'post_status'    => 'publish',
					's'              => $keyword,
					'posts_per_page' => 5,
					'post_type'      => 'product',
					'post__not_in'   => $exclude_ids_woorel
				);
				$query      = new WP_Query( $query_args );
				if ( $query->have_posts() ) {
					echo '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						$product = wc_get_product( get_the_ID() );
						if ( ! $product || $product->is_type( 'woorel' ) ) {
							continue;
						}
						if ( $product->is_type( 'variable' ) ) {
							echo '<li ' . ( ! $product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $product->get_id() . '" data-price="' . $product->get_variation_price( 'min' ) . '" data-price-max="' . $product->get_variation_price( 'max' ) . '"><span class="move"></span><span class="name">' . $product->get_name() . '</span> (#' . $product->get_id() . ' - ' . $product->get_price_html() . ') <span class="remove">+</span></li>';
							// show all childs
							/*$childs = $product->get_children();
							if ( is_array( $childs ) && count( $childs ) > 0 ) {
								foreach ( $childs as $child ) {
									$product_child = wc_get_product( $child );
									echo '<li ' . ( ! $product_child->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $child . '" data-price="' . $product_child->get_price() . '" data-price-max="' . $product_child->get_price() . '"><span class="move"></span><span class="name">' . $product_child->get_name() . '</span> (#' . $product_child->get_id() . ' - ' . $product_child->get_price_html() . ') <span class="remove">+</span></li>';
								}
							}*/
						} else {
							echo '<li ' . ( ! $product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $product->get_id() . '" data-price="' . $product->get_price() . '" data-price-max="' . $product->get_price() . '"><span class="move"></span><span class="name">' . $product->get_name() . '</span> (#' . $product->get_id() . ' - ' . $product->get_price_html() . ') <span class="remove">+</span></li>';
						}
					}
					echo '</ul>';
					wp_reset_postdata();
				} else {
					echo '<ul><span>' . sprintf( esc_html__( 'No results found for "%s"', 'woorel' ), $keyword ) . '</span></ul>';
				}
			}
			die();

	}


	function woorel_clean_ids( $ids ) {
		$ids = preg_replace( '/[^,\/0-9]/', '', $ids );
		return $ids;
	}

	/*function woorel_add_to_cart_form(){

		global $product; 

		$product_id  = $product->get_id();

		$woorel_ids = get_post_meta( $product_id, 'woorel_ids', true );

		$woorel_titlesmain = get_post_meta( $product_id, '_woorel_titlesmain', true );
		if ($woorel_titlesmain == "") {
			$woorel_titlesmain = 'Related Product';
		}

		$woorel_ids = explode(",",$woorel_ids);

		if ($woorel_ids[0] == "") {
			// empity
		}
		else
		{
			?>
			<div id="woorel_loader2">
			  <div id="woorel_loadertext2">
			  	<div id="woorel_loadertext2_title"></div>
			  	<div id="woorel_loader_img"><img src="<?php echo WOOREL_URI; ?>assets/images/loading.gif"></div>
			  </div>
			</div>
			<?php
			echo '<table id="woorel_products" cellspacing="0" class="woorel-table woorel-products"><tbody><tr class="woorel-product"><td class="woorel-thumb">';

			echo '<label>'.$woorel_titlesmain.' : </label>';

			echo '<select id="wooppt_select_btn" class="woorel_select_box">';
			echo '<option value="">--select name--</option>';

			foreach ($woorel_ids as $data) {
				$woosb_product = wc_get_product($data);
				echo '<option '.selected($woosb_product->id,get_the_ID()).' value="'.$woosb_product->id.'">'.substr($woosb_product->name,0,60).'</option>';
			}

			echo '</select>';

			echo '</td></tr></tbody></table>';
		}

	}*/

	function woorel_add_to_cart_form(){

		global $product; 

		$product_id  = $product->get_id();

		$woorel_ids = get_post_meta( $product_id, 'woorel_ids', true );

		$woorel_titlesmain = get_post_meta( $product_id, '_woorel_titlesmain', true );
		if ($woorel_titlesmain == "") {
			$woorel_titlesmain = 'Related Product';
		}

		$woorel_ids = explode(",",$woorel_ids);

		if ($woorel_ids[0] == "") {
			// empity
		}
		else
		{
			?>
			<div id="woorel_loader2">
			  <div id="woorel_loadertext2">
			  	<div id="woorel_loadertext2_title"></div>
			  	<div id="woorel_loader_img"><img src="<?php echo WOOREL_URI; ?>assets/images/loading.gif"></div>
			  </div>
			</div>
			<?php
			echo '<table id="woorel_products" cellspacing="0" class="woorel-table woorel-products" style="border:none;"><tbody><tr class="woorel-product"><td class="woorel-thumb" style="border:none;">';

			echo '<h3><label>'.$woorel_titlesmain.' </label></h3>';

			echo '<select id="wooppt_select_btn" class="woorel_select_box">';
			echo '<option value="">--select name--</option>';

			foreach ($woorel_ids as $data) {
				$woosb_product = wc_get_product($data);
				echo '<option '.selected($woosb_product->id,get_the_ID()).' value="'.$woosb_product->id.'">'.substr($woosb_product->name,0,60).'</option>';
			}

			echo '</select>';

			echo '</td></tr></tbody></table>';
		}

	}

	function woorel_wp_enqueue_scripts(){

		wp_register_script( 'some_front_handle', WOOREL_URI.'assets/js/frontend.js'); 

		$data_front_array = array(
			'product_id' => get_the_ID(),
			'ajaxurl'=> admin_url( 'admin-ajax.php')
		);
		wp_localize_script( 'some_front_handle', 'dataobj', $data_front_array );


		wp_enqueue_script( 'some_front_handle', WOOREL_URI.'assets/js/frontend.js', array('jquery'), 1.0, 'all');

	}

	function woorel_my_action_function(){ 

		$pid = $_POST['pid'];

		$product = new WC_Product($pid);
				
		$myArr = array(
					'name'=>$product->name, 
					'price'=>$product->price,
					'sale_price'=>$product->sale_price,
					'regular_price'=>$product->regular_price,
					'product_url'=>get_permalink($pid)
					);

		$myJSON = json_encode($myArr);

		echo $myJSON;

		die();
	}


	function woorel_product_data_tabs( $tabs ) {
		$tabs['woorel'] = array(
			'label'  => esc_html__( 'Related product', 'wooppt' ),
			'target' => 'woorel_settings',
			'class'  => array( 'show_if_woorel' ),
		);
		return $tabs;
	}

	function woorel_product_data_panels() {

		global $post;
		$post_id = $post->ID;
		?>

		<div id='woorel_settings' class='panel woocommerce_options_panel woorel_table'>
			<table>
				<tr>
					<th><?php esc_html_e( 'Title', 'woorel' ); ?></th>
					<td>
						<div class="w100">
							<input type="text" name="woorel_titlesmain" id="woorel_titlesmain" value="<?php echo get_post_meta( $post_id, '_woorel_titlesmain', true ); ?>">
						</div>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Search', 'woorel' ); ?></th>
					<td>
						<div class="w100">
							<span class="loading" id="woorel_loading"><?php esc_html_e( 'searching...', 'woorel' ); ?></span>
							<input type="search" id="woorel_keyword" placeholder="<?php esc_html_e( 'Type any keyword to search', 'woorel' ); ?>"/>
							<div id="woorel_results" class="woorel_results"></div>
						</div>
					</td>
				</tr>
				<tr class="woorel_tr_space">
					<th><?php esc_html_e( 'Selected', 'woorel' ); ?></th>
					<td>
						<div class="w100">
							<input type="hidden" id="woorel_ids" class="woorel_ids" name="woorel_ids" value="<?php echo get_post_meta( $post_id, 'woorel_ids', true ); ?>"
								       readonly/>
							<div id="woorel_selected" class="woorel_selected">
								<ul>
									<?php
									$woorel_price = 0;
									if ( get_post_meta( $post_id, 'woorel_ids', true ) ) {
										$woorel_items = explode( ',', get_post_meta( $post_id, 'woorel_ids', true ) );
										if ( is_array( $woorel_items ) && count( $woorel_items ) > 0 ) {
											foreach ( $woorel_items as $woorel_item ) {
												$woorel_item_arr = explode( '/', $woorel_item );
												$woorel_item_id  = absint( $woorel_item_arr[0] ? $woorel_item_arr[0] : 0 );
												$woorel_item_qty = absint( $woorel_item_arr[1] ? $woorel_item_arr[1] : 1 );
												$woorel_product  = wc_get_product( $woorel_item_id );
											if ( ! $woorel_product ) {
													continue;
											}
											$woorel_price += $woorel_product->get_price() * $woorel_item_qty;

											if ( $woorel_product->is_type( 'variable' ) ) {
												/*echo '<li ' . ( ! $woorel_product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $woorel_item_id . '" data-price="' . $woorel_product->get_variation_price( 'min' ) . '" data-price-max="' . $woorel_product->get_variation_price( 'max' ) . '"><span class="move"></span></span><span class="name">' . $woorel_product->get_name() . '</span> (#' . $woorel_product->get_id() . ' - ' . $woorel_product->get_price_html() . ')<span class="remove">×</span></li>';*/
												/**/
												$varproduct  = wc_get_product( $woorel_item_id );

												$var_price_first = $varproduct->get_price(); 

												$available_variations = $varproduct->get_children();

												$available_variations = end($available_variations);

												$productnnn = new WC_Product_Variation($available_variations);

												$var_price_last = $productnnn->get_price();

												$var_septare_price = $currency_symbol.$var_price_first.' - '.$currency_symbol.$var_price_last;
												echo '<li ' . ( ! $woorel_product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $woorel_item_id . '" data-price="' . $woorel_product->get_variation_price( 'min' ) . '" data-price-max="' . $woorel_product->get_variation_price( 'max' ) . '"><span class="move"></span></span><span class="name">' . $woorel_product->get_name() . '</span> (#' . $woorel_product->get_id() . ' - ' . $var_septare_price . ')<span class="remove">×</span></li>';
												/**/
											} else {
												echo '<li ' . ( ! $woorel_product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $woorel_item_id . '" data-price="' . $woorel_product->get_price() . '" data-price-max="' . $woorel_product->get_price() . '"><span class="move"></span><span class="name">' . $woorel_product->get_name() . '</span> (#' . $woorel_product->get_id() . ' - ' . $woorel_product->get_price_html() . ')<span class="remove">×</span></li>';
												}
											}
										}
									}
									?>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				<tr class="woorel_tr_space">
					<td>
						<div class="w100">
							<input type="button" name="woorel_save_ajax" id="woorel_save_ajax" class="button button-primary button-large" value="Update Changes">
						</div>
					</td>
				</tr>
			</table>
			<div class="ajax_loading"></div>
		</div>

		<?php

	}

	function woorel_save_option_field( $post_id ) {  



		if ($_POST['woorel_ids']!="") {

			$woorel_titlesmain = $_POST['woorel_titlesmain'];

			$woorel_titles = explode(',', $_POST['woorel_titles']);

			$woorel_ids = array_unique(explode(",",$post_id.",".$_POST['woorel_ids']));

			foreach ($woorel_ids as $pids) {
				update_post_meta( $pids, 'woorel_ids', self::woorel_clean_ids( implode(",", array_unique($woorel_ids)) ) );
				update_post_meta( $pids, '_woorel_titlesmain', $woorel_titlesmain);
			}


			//print_r($_POST['woorel_ids']);
			//die("@@---");
		}

		if ($_POST['get_all_ids']!="") { 

			$removed_ids = $_POST['get_all_ids'];

			foreach ($removed_ids as $pids) {
				update_post_meta( $pids, 'woorel_ids', "" );
			}

			//print_r($_POST['get_all_ids']);
			//die("@@===");

		}


	}
}
new WPcleverRel();
}

