<?php
/*
* Plugin Name: Gs Users
* Author: Gaurav Sharma
* Text Domain: gs-users
* Description: This is the gs magenages users  plugin
* Version: 1.0.0
*/


if (!class_exists('GScustomLogin')) {

define( 'GSUSERS_VERSION', '1.0.0' );
define( 'GSUSERS_URI', plugin_dir_url( __FILE__ ) );
	
	class GScustomLogin {
			
		function __construct(){

			add_action('init', array( $this,'myStartSession'), 1);

			/*
			*Load textdomain
			*/
			add_action( 'plugins_loaded', array( $this, 'gs_users_load_textdomain' ) );
            
            /*
            *Define back end hooks
            */
			add_action('admin_menu', array($this, 'gscustom_admin_menu'));

			add_action( 'show_user_profile', array($this, 'crf_show_extra_profile_fields' ), 10);
			add_action( 'edit_user_profile', array($this, 'crf_show_extra_profile_fields' ), 10);
			//add_action( 'user_profile_update_errors', array($this,'crf_user_profile_update_errors'), 10, 3 );
			add_action( 'personal_options_update', array($this,'crf_update_profile_fields' ));
			add_action( 'edit_user_profile_update', array($this,'crf_update_profile_fields' ));


			/*
			*Define front end hooks
			*/
			add_shortcode( 'gs-user-login', array($this,'gsuserlogin_shortcode_function' ));
			add_shortcode( 'gs-user-reg', array($this,'gsuserreg_shortcode_function' ));

			add_action('admin_post_gs_user_login_action', array($this,'gspre_user_login'));
			add_action('admin_post_nopriv_gs_user_login_action', array($this,'gspre_user_login'));

			add_action('admin_post_gs_user_reg_action', array($this,'gspre_user_reg'));
			add_action('admin_post_nopriv_gs_user_reg_action', array($this,'gspre_user_reg'));

			add_action('wp_logout', array($this,'logout_redirect'));
	
			add_action('wp_footer', array($this,'gs_footer_script'));

		}

		function myStartSession() {
		    if(!session_id()) {
		        session_start();
		        $_SESSION['session_test'] = "session_test";
		    }
		}


		function gs_users_load_textdomain(){
			load_plugin_textdomain( 'gs-users', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		function gs_footer_script(){

			if (!is_user_logged_in()) {
			
			?>
			<!--custom: get current page url-->
			  <script>
			    jQuery(document).ready(function() {

			    var StaticLoginPageUrl="";
			    var currentURL="";
			    var getcurrentURL="";
			    var data = jQuery('#currentUrl').val();

			    if (data!= undefined) {  
			    	StaticLoginPageUrl = data;
			    }

			    currentURL  =  window.location.href;  

			    if (StaticLoginPageUrl == currentURL) {  
			        getcurrentURL = localStorage.getItem("url_crr");  
			        jQuery("#redirect_to").val(getcurrentURL);
			    }
			    else{
			        localStorage.setItem("url_crr", currentURL);
			    }

			    });
			  </script>
			  <!--custom: get current page url-->
			<?php

			}

		}

		function crf_show_extra_profile_fields( $user ) {
			$gs_block_status_val = get_the_author_meta( 'gs_block_status', $user->ID );

			?>
			<h3><?php esc_html_e( 'Personal Information', 'gs-users' ); ?></h3>

			<table class="form-table">
				<tr>
					<th><label for="gs_block_status"><?php esc_html_e( 'User Block Status', 'gs-users' ); ?></label></th>
					<td>
						<select name="gs_block_status" id="gs_block_status">
							<option value="" selected="selected">--select--</option>
							<option value="1" <?php echo selected($gs_block_status_val,1);?> >Block</option>
							<option value="0" <?php echo selected($gs_block_status_val,0);?> >Unblock</option>
						</select>
						<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Update User"></p>
					</td>
				</tr>
			</table>
			<?php
		}

		function crf_user_profile_update_errors( $errors, $update, $user ) {
			if ( empty( $_POST['gs_block_status'] ) ) {
				$errors->add( 'gs_block_status_error', __( '<strong>ERROR</strong>: Please enter your gs_block_status_val of birth.', 'crf' ) );
			}

			if ( ! empty( $_POST['gs_block_status'] ) && intval( $_POST['gs_block_status'] ) < 1900 ) {
				$errors->add( 'gs_block_status_error', __( '<strong>ERROR</strong>: You must be born after 1900.', 'crf' ) );
			}
		}

		function crf_update_profile_fields( $user_id ) {
			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				return false;
			}

			//if ( ! empty( $_POST['gs_block_status'] )) {
				update_user_meta( $user_id, 'gs_block_status', intval( $_POST['gs_block_status'] ) );
			//}
		}

		/*
		*Define front end hooked function
		*/

		function gsuserlogin_shortcode_function(){

			include 'templates/login-ar.php';
		}

		function gsuserreg_shortcode_function(){

			include 'templates/reg-ar.php';
		}

		function gspre_user_login(){

			$creds = array();
			$username = $creds['user_login'] = $_POST['gs_user_login'];
			$creds['user_password'] = $_POST['gs_user_pass'];
			$currenturl = $_POST['currentUrl'];

			if (isset($_POST['gs_user_rememberme'])) {
				$remember = 'true';
			}
			else{
				$remember = 'false';
			}
			$creds['remember'] = $remember;


			$userbyname = get_user_by('login',$username);
			if ($userbyname) {
				$user = $userbyname;
			}

			$userbyemail = get_user_by('email',$username);
			if ($userbyemail) {
				$user = $userbyemail;
			}

			if ($user) {

				$user_roles = implode(', ', $user->roles);

				$block_status = get_the_author_meta( 'gs_block_status', $user->ID );

				if ($block_status == 1) { //echo "blocked<br>"; 

					unset($_SESSION['gs_login']);
					$_SESSION['gs_login'] = "Your account has been blocked by some reasone please contact to admin";

					wp_redirect( $currenturl.'?ref=blocked');
					exit;
				}
				else{ //echo "unblocked<br>"; 
					$user = wp_signon( $creds, true );
					if ( is_wp_error($user) ){
						echo $user->get_error_message();

						unset($_SESSION['gs_login']);
						$_SESSION['gs_login'] = "Invalide username and password";

						wp_redirect($currenturl.'?ref=error');
						exit();
					}else{

						wp_set_current_user( $user->ID );
						wp_set_auth_cookie( $user->ID );
			      		if ($user_roles == "administrator" || $user_roles =="shop_manager" || $user_roles =="contributor" || $user_roles =="author" || $user_roles =="editor" || $user_roles =="editor") 
			      		{
			      			$admin_url  = home_url('wp-admin/');
							wp_safe_redirect($admin_url);
							exit;
			      		} 
			      		else 
			      		{
			      			wp_redirect($_POST['redirect_to']);
							exit();
			      		}
					}
				} 
			}
			else{

				unset($_SESSION['gs_login']);
				$_SESSION['gs_login'] = "Invalide username and password";

				wp_redirect( $currenturl.'?ref=incorrectusername');
				exit();
			}
		}


		function logout_redirect() {

			$user_id = get_current_user_id(); 

			$user_info = get_userdata($user_id);
      	
      		$user_roles = implode(', ', $user_info->roles);

      		if ($user_roles == "administrator" || $user_roles =="shop_manager" || $user_roles =="contributor" || $user_roles =="author" || $user_roles =="editor" || $user_roles =="editor") 
      		{
      			$login_page  = home_url('wp-login.php');
				wp_redirect($login_page);
				exit;
      		} 
      		else 
      		{
      			$login_page  = home_url('index.php/test/');
				wp_redirect($login_page . "?login=false");
				exit;
      		}
		}

		/*
		* Register User
		*/
		function gspre_user_reg(){

			$user_name = $_POST['user_login'];
			$user_email = $_POST['email'];
			$userid = username_exists( $user_name );

			$currenturl = $_POST['currentUrl'];

			if ( !$userid and email_exists($user_email) == false ) 
			{
				/*$creds = array();
				$creds['user_login'] = $_POST['user_login'];
				$creds['user_password'] = $_POST['password'];
				$creds['remember'] = true;
				$user = wp_signon($creds,false);*/

				$userdata = array(
		          			'user_login'  =>  $_POST['user_login'],
		    				'user_pass'   =>  $_POST['password'],
		    				'user_email'  =>  $_POST['email'],
		    				'display_name'=>  empty($_POST['last_name']) ? $_POST['salutation']." ".$_POST['first_name'] : $_POST['salutation']." ".$_POST['last_name'],
		    				'first_name'  =>  $_POST['first_name'],
		                    'last_name'   =>  $_POST['last_name']
						);

				$user_id = wp_insert_user($userdata);
				wp_update_user( array ('ID' => $user_id, 'role' => 'freelancer') );


				

/**/
if($_POST){
	if (!function_exists('wp_generate_attachment_metadata')){
	    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	}

	/*echo "<pre>";
	print_r($_FILES);
	echo "</pre>";*/

	if($_FILES)
	{
	    foreach ($_FILES as $file => $array)
	    {
	    	
	    	if ($file == 'left_image') {

	    		if (!empty($array['name'])) { 
		    	 	//if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
			        $attach_id = media_handle_upload($file,$new_post);
			        update_user_meta( $user_id, $file, $attach_id );

			        //echo "==>".$attach_id; echo "<br>";
		    	}
	    		
	    	}

	    	if ($file == 'front_image') {

	    		if (!empty($array['name'])) { 
		    	 	//if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
			        $attach_id = media_handle_upload($file,$new_post);
			        update_user_meta( $user_id, $file, $attach_id );

			        //echo "==>".$attach_id; echo "<br>";
		    	}
	    		
	    	}

	    	if ($file == 'right_image') {

	    		if (!empty($array['name'])) { 
		    	 	//if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}
			        $attach_id = media_handle_upload($file,$new_post);
			        update_user_meta( $user_id, $file, $attach_id );

			        //echo "==>".$attach_id; echo "<br>";
		    	}
	    		
	    	}
	    }
	}


	
}
//die();
/**/

		        if(is_wp_error($user_id)){

		        	echo $user->get_error_message();
		        }
		        else
		        {
		            wp_redirect( $currenturl.'?reg=succ');
					exit();
		        }
			} 
			else 
			{
				wp_redirect( $currenturl.'?reg=notsucc');
				exit();
			}
		}



		/*
		*Define back end hooked functuon
		*/

		function gscustom_admin_menu(){

			add_menu_page(
				'Gs Dashboard', 
				'Gs Dashboard', 
				'manage_options', 
				'gs-users', 
				function(){
                   include 'admin/dashboard.php';
				},
				GSUSERS_URI.'img/gs-users.png'
			);

			$main_menu_slug = 'gs-users';

			add_submenu_page( 
				$main_menu_slug, 
				'Gs Login', 
				'Gs Login', 
				'manage_options', 
				'gs-login',
				function(){
                   echo "string";
				}
			);

			add_submenu_page( 
				$main_menu_slug, 
				'Gs Register', 
				'Gs Register', 
				'manage_options', 
				'gs-reg',
				function(){
                   echo "string";
				}
			);

			add_submenu_page( 
				$main_menu_slug, 
				'Gs Settiongs', 
				'Gs Settiongs', 
				'manage_options', 
				'gs-settings',
				function(){
                   echo "string";
				}
			);
		}
	}
new GScustomLogin();
}



add_action( 'wp_authenticate' , 'check_custom_authentication' );

function check_custom_authentication ( $username ) {
        
    $userinfo = get_user_by( 'login', $username );

	if($userinfo)
	{
	   echo $userinfo->ID;

	   wp_redirect(home_url());

	}

    die();
       
}