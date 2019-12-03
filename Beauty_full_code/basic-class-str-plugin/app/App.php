<?php

namespace App;

if ( ! class_exists( 'App' ) ) {

	/**
	 * Class App
	 * @package App
	 */
	final class App {
		/**
		 * Store all the classes inside an array
		 * @return array Full list of classes
		 */
		public static function getServices() {
			return [
				BackEnd\BackEndClass::class,
				FrontEnd\FrontEndClass::class,
			];
		}

		/**
		 * Loop through the classes, initialize them,
		 * and call the register() method if it exists
		 * @return void
		 */
		public static function registerServices() {
			foreach ( self::getServices() as $class ) {
				$service = self::instantiate( $class );
				if ( method_exists( $service, 'register' ) ) {
					$service->register();
				}
			}
		}

		/**
		 * Initialize the class
		 *
		 * @param $class $class from the services array
		 *
		 * @return mixed new instance of the class
		 */
		private static function instantiate( $class ) {
			$service = new $class();

			return $service;
		}
	}

}