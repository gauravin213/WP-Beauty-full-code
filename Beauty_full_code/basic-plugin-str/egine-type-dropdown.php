<?php
/*
*  Custom Woocommerce Brand Select Box On Shop page
*/

//egine_type

function egine_type_add_query_vars_filter( $vars ){
    $vars[] = 'myEngin';
    return $vars;
}
add_action( 'query_vars', 'egine_type_add_query_vars_filter' );


function egine_type_filter_pre_get_posts( $wp_query ) {

	global $wpdb;

    if (!is_archive() || !$wp_query->is_main_query() ) {
        return;
    }

    $myEngin = get_query_var('myEngin');

    if (isSet($myEngin ) && !empty($myEngin )) {

    	//echo "myEngin: ".$myEngin;

		$results_engine = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."ebay_compats WHERE engine='".$myEngin."' ", ARRAY_A );

		$results_product_ids = array_column($results_engine, 'product_id');
		
		//echo '<pre>'; print_r($results_product_ids); echo "</pre>";

        $wp_query->set('post__in', $results_product_ids);
    }


}
add_action('pre_get_posts', 'egine_type_filter_pre_get_posts' );


add_action( 'woocommerce_before_shop_loop', 'egine_type_ps_selectbox', 25 );
function egine_type_ps_selectbox() {

	global $wpdb;

	$results_engine = $wpdb->get_results("SELECT DISTINCT engine FROM wp_ebay_compats WHERE engine !='--' AND product_id IN (SELECT ID FROM wp_posts)");

	$results_engine_col_arr = array_column($results_engine, 'engine');
	
	//echo '<pre>'; print_r($results_engine_col_arr); echo "</pre>";

    $per_page = filter_input(INPUT_GET, 'myEngin'); 

    echo '<div class="woocommerce-myEngin">';
	    echo '<select id="myEngin" name="myEngin">'; 
	    echo "<option ".selected( $per_page, $value )." value=''>Select egine type</option>";
		foreach($results_engine_col_arr as $results_engine_col_arr){
		    echo "<option ".selected( $per_page, $results_engine_col_arr )." value='$results_engine_col_arr'>$results_engine_col_arr</option>";
		}
	    echo '</select>';
    echo '</div>';


    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function(){

    		jQuery(document).on('change', '#myEngin', function(e){

    			e.preventDefault();

    			var target = jQuery(this);

    			var myEngin_val = target.find(':selected').val();

    			var currentUrl = location.href;

				var url = new URL(currentUrl);

				url.searchParams.set("myEngin", myEngin_val); 

				var newUrl = url.href; 

				window.location.href=newUrl;

    		});
    });
    </script>
    <?php
}