<?php
/*
* Plugin Name: Custom Remove Country
* Description: This is the c Custom Remove Country plugin which is specially designed for venezuelanfoodmarket.com
* Version:1.0.0 
* Author: Clag dev
*/

if ( ! class_exists( 'Venezula_class' ) ) {

class Venezula_class {

	function __construct() {

		// Add hokks
		add_action( 'init', array( $this,'venezula_init_function'));

		add_filter( 'woocommerce_countries', array( $this, 'venezula_remove_specific_country' ), 10, 1 );
	

	}

	function venezula_init_function(){

		//die("Custom Remove Country == venezula_init_function");
		
	}

	function venezula_remove_specific_country($country){

	   unset($country["IN"]);
	   unset($country["BY"]);
	   unset($country["BI"]);
	   unset($country["CF"]);
	   unset($country["CG"]);
	   unset($country["CD"]);
	   unset($country["CU"]);
	   unset($country["IR"]);
	   unset($country["IQ"]);
	   unset($country["LB"]);
	   unset($country["KP"]);
	   unset($country["SO"]);
	   unset($country["SD"]);
	   unset($country["SS"]);
	   unset($country["SY"]);
	   unset($country["UA"]);
	   unset($country["VE"]);
	   unset($country["YE"]);
	   unset($country["ZW"]);
	   return $country; 
		
	}

}
new Venezula_class();
}

