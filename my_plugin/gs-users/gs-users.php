<?php
/*
* Plugin Name: Gs Users
* Author: Gaurav Sharma
* Text Domain: gs-users
* Description:  [gs-user-login], [gs-user-reg] shortcode This is the gs magenages users  plugin
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


			add_action( 'admin_enqueue_scripts', array($this, 'gs_users_admin_enqueue_scripts'));
			add_action( 'wp_enqueue_scripts', array($this, 'gs_users_enqueue_styles'));

		}

		function gs_users_admin_enqueue_scripts(){

			wp_enqueue_style('back-gs-users', GSUSERS_URI.'/assets/css/back-gs-users.css', array(), '1.0', 'all' );

		}

		function gs_users_enqueue_styles(){

			wp_enqueue_style('front-gs-users', GSUSERS_URI.'/assets/css/front-gs-users.css', array(), '1.0', 'all' );

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

			<div class="gs-user-edit-dev">
			<h3><?php esc_html_e( 'Gs User Permission Information', 'gs-users' ); ?></h3>

			<table class="form-table">
				<tr>
					<th><label for="gs_block_status"><?php esc_html_e( 'User Block Status', 'gs-users' ); ?></label></th>
					<td>
						<select name="gs_block_status" id="gs_block_status">
							<option value="0" <?php echo selected($gs_block_status_val,0);?> >Active</option>
							<option value="1" <?php echo selected($gs_block_status_val,1);?> >Block</option>
						</select>
						<p class="submit">
							<input type="submit" name="submit" id="submit" class="button button-primary" value="Update User">
						</p>
					</td>
				</tr>
			</table>
			</div>
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

				//Upload image
				if($_POST){
					if($_FILES)
					{
					    foreach ($_FILES as $file => $array)
					    {
					    	
					    	if ($file == 'left_image') {

					    		if (!empty($array['name'])) { 
							        $attach_id = media_handle_upload($file,$new_post);
							        update_user_meta( $user_id, $file, $attach_id );
						    	}
					    		
					    	}

					    	/*if ($file == 'front_image') {

					    		if (!empty($array['name'])) { 
							        $attach_id = media_handle_upload($file,$new_post);
							        update_user_meta( $user_id, $file, $attach_id );
						    	}
					    		
					    	}

					    	if ($file == 'right_image') {

					    		if (!empty($array['name'])) { 
							        $attach_id = media_handle_upload($file,$new_post);
							        update_user_meta( $user_id, $file, $attach_id );
						    	}
					    		
					    	}*/
					    }
					}
				}
				

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

			$page_title = $menu_title = "Gs User Settings";
			$capability = "manage_options";
			$menu_slug = "gs-user-options";
			add_options_page( $page_title, $menu_title, $capability, $menu_slug, function(){
                   include 'admin/dashboard.php';
			});
		}
	}
new GScustomLogin();
}



function cus_init_block_message(){

   	$block_user = $_GET['block_user'];

   	$block_status = get_block_status($block_user);

   	if ($block_status) {
   		?>
   		<style type="text/css">
   			#block_message{
   				text-align: -webkit-center;
			    padding: 48px;
			    background-color: #d86161;
   			}
   			#block_message h4, #block_message a{
   				color: black;
   			}
   		</style>

   		<div id="block_message">
   			<h4 >Your user id <i>'<?php echo $block_user;?>'</i> has been blocked Please contact to your Administrator</h4>
   			<a href="<?php echo home_url();?>">Close Message</a>
   		</div>

   		<?php
   	}

}
add_action('init', 'cus_init_block_message');

function check_custom_authentication ( $username ) {
        
	$block_status = get_block_status($username);

   	if ($block_status) {
   		wp_redirect(home_url().'/?block_user='.$username);
	   	die();
   	}  
}
add_action( 'wp_authenticate' , 'check_custom_authentication' );


function get_block_status($username){

	$userinfo = get_user_by( 'login', $username );

	if($userinfo)
	{
	   	$user_id = $userinfo->ID; 

	   	$gs_block_status = get_user_meta( $user_id, 'gs_block_status', true );

		if ($gs_block_status!="") {  
	   		if ($gs_block_status == 1) { //blocked
	   			return 1;
	   		}else{ //Unblocked
	   			return 0;
	   		}
	   	}
	}   

}


function new_modify_user_table( $column ) {
    $column['gs_block_status'] = 'Status';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'gs_block_status' :
        	$block_status = get_the_author_meta( 'gs_block_status', $user_id );

        	if ($block_status  == 0) {
        		
        		$block_status_value = '<span class="block-status-col-active">Active</span>';

        	} else {

        		$block_status_value = '<span class="block-status-col-inactive">blocked</span>';
        		
        	}
            return $block_status_value;
            break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );