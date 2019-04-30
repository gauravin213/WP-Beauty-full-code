<?php
/*
* Plugin Name: Basic Plugin Str
* Author: Clag Dev
* Text Domain: basic-plugin-str
* Description: This is the custom price calculator plugin
* Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}



// Contact form 7
include 'contact-F7-addon/get-country.php';
include 'contact-F7-addon/get-country-extend.php';
include 'contact-F7-addon/text2.php';


// basic-plugin-str
include 'basic-plugin-str/basic-plugin-str.php';



?>