<?php

	namespace App\Activate;

	use App\App;
	use App\Pages\PageGenerator;

	if ( ! class_exists( 'Activate' ) ) {

		/**
		 * Class Activate
		 * @package App\Activate
		 */
		class Activate {

			public static function activate() {

				//$this->add_page_check = get_page_by_title( $post_title );

				//if ( ! isset( $this->add_page_check->ID ) ) {


				echo plugin_dir_path( dirname( __FILE__, 2 ) );

				wp_insert_post( array(
					'post_title'    => 'Demo Page', //$post_title,
					'post_content'  => 'Deme Page', //$this->add_page_content,
					'post_status'   => 'publish',
					'post_type'     => 'page',
					//'page_template' => plugin_dir_path( dirname( __FILE__, 2 ) ).'template/UserFields.php', //$template_path,
				), true );
				//}


				/*$pages = new PageGenerator();
				$pages->register();

				flush_rewrite_rules();

				$default = [];*/


			}

		}

	}