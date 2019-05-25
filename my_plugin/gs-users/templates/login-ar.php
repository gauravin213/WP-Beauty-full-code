<?php 
global $wp;
$currentUrl = home_url( $wp->request );

if (is_user_logged_in()) { ?>
	
	<div>
		<h1><?php _e('You have loged in', 'gs-users'); ?></h1>
		<a href="<?php echo wp_logout_url(); ?>"><?php _e('Log Out', 'gs-users'); ?></a>
	</div>

<?php } else { ?>
	
<div>
	<h1><?php echo _e('Login', 'gs-users'); ?></h1>

	<?php

	if (isset($_SESSION['gs_login'])) {
		echo $_SESSION['gs_login'];
		unset($_SESSION['gs_login']);
	}
	
	/*if (isset($_GET['ref']) == "blocked") {
		echo "Your account has been blocked by some reasone please contact to admin";
		echo '<a href="'.$currentUrl.'/">X</a>';
	}
	if (isset($_GET['ref']) == "error") {
		echo "Invalide username and password";
		echo '<a href="'.$currentUrl.'/">X</a>';
	}
	if (isset($_GET['ref']) == "login") {
		echo "Your have loged in sucessfull";
		echo '<a href="'.$currentUrl.'/">X</a>';
	}
	if (isset($_GET['ref']) == "incorrectusername") {
		echo "incorrect username";
		echo '<a href="'.$currentUrl.'/">X</a>';
	}*/
	?>
	
	<form name="loginform" id="loginform" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">

		<div>
			<label for="gs_user_login"><?php echo _e('Username or Email', 'gs-users'); ?></label>
				<input type="text" name="gs_user_login" id="gs_user_login" class="input" value="" size="20">
		</div>
		<div>
			<label for="gs_user_pass"><?php echo _e('Password', 'gs-users'); ?></label>
				<input type="password" name="gs_user_pass" id="gs_user_pass" class="input" value="" size="20">
		</div>

		<div>
			<label><input name="gs_user_rememberme" type="checkbox" id="gs_user_rememberme" value="true"> <?php echo _e('Remember Me', 'gs-users'); ?></label>
		</div>

		<input type="hidden" name="action" value="gs_user_login_action">

		<input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo home_url().'/';?>">

		<input type="hidden" name="currentUrl" id="currentUrl" value="<?php echo $currentUrl.'/';?>">

        <input type="submit" value="Send My Message">

	</form> 
</div> 

<?php } ?>