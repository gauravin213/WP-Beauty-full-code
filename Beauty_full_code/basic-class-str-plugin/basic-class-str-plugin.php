<?php
/*
Plugin Name: Basic class str plugin
Description: This is the machine test plugin 
Author: Gaurav Sharma
*/

//BasicClassStrPlugin
require_once 'vendor/autoload.php';

use App\App;
use App\Activate\Activate;
use App\Deactivate\Deactivate;


if ( ! class_exists( 'BasicClassStrPlugin' ) ) {

    /**
     * Class BasicClassStrPlugin
     */
    final class BasicClassStrPlugin {

        public function activate() {
            Activate::activate();
        }

        public function deactivate() {
            Deactivate::deactivate();
        }

    }

}

if ( class_exists( 'BasicClassStrPlugin' ) ) {

    $auction = new BasicClassStrPlugin();
    register_activation_hook( __FILE__, [ $auction, 'activate' ] );
    register_deactivation_hook( __FILE__, [ $auction, 'deactivate' ] );

}


if ( class_exists( 'App\\App' ) ) {

    App::registerServices();

}
?>