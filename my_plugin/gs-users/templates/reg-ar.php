<?php 
global $wp;
$currentUrl = home_url( $wp->request );


/*$str = 'This is an encoded string';
echo $str1 = base64_encode($str);

echo "<br><br><br><br>";

echo base64_decode($str1);*/

/*echo "_____".$_SESSION['session_test'];

unset($_SESSION['session_test']);  echo "<br><br><br><br>";

echo "_____".$_SESSION['session_test'];*/


 
?>

<div>
	<h1><?php _e('Registration', 'gs-users'); ?></h1>
	

	<?php
	if ($_GET['reg'] == "succ") {
		echo "You have register successsfully";
	}
	if ($_GET['reg'] == "notsucc") {
		echo "User already exists";
	}
	?>

	<form name="regform" id="regform" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">

		<div>
			<label for="first_name"><?php echo _e('first_name', 'gs-users'); ?></label>
			<input type="text" name="first_name" id="first_name">
		</div>

		<div>
			<label for="salutation"><?php echo _e('salutation', 'gs-users'); ?></label>
			<input type="text" name="salutation" id="salutation">
		</div>

		<div>
			<label for="last_name"><?php echo _e('last_name', 'gs-users'); ?></label>
			<input type="text" name="last_name" id="last_name">
		</div>

		<div>
			<label for="user_login"><?php echo _e('user_login', 'gs-users'); ?></label>
			<input type="text" name="user_login" id="user_login">
		</div>

		<div>
			<label for="email"><?php echo _e('email', 'gs-users'); ?></label>
			<input type="text" name="email" id="email">
		</div>

		<div>
			<label for="password"><?php echo _e('password', 'gs-users'); ?></label>
			<input type="password" name="password" id="password">
		</div>


		<input type="hidden" name="currentUrl" id="currentUrl" value="<?php echo $currentUrl.'/';?>">

		<input type="hidden" name="action" value="gs_user_reg_action">

       
		<!---->
		<div>
			<div>
				<input type="file" name="left_image" accept="image/*" onchange="loadFile_left(event)"/>
				<img id="output_left" style="width: 20%;" />
			</div>
			
			<div>
				<input type="file" name="front_image" accept="image/*" onchange="loadFile_front(event)"/>
				<img id="output_front" style="width: 20%;" />
			</div>
			
			<div>
				<input type="file" name="right_image" accept="image/*" onchange="loadFile_right(event)"/>
				<img id="output_right" style="width: 20%;" />
			</div>
	
			<script>
			  var loadFile_left = function(event) {
			    var output_left = document.getElementById('output_left');
			    output_left.src = URL.createObjectURL(event.target.files[0]);
			  };
			  var loadFile_front = function(event) {
			    var output_front = document.getElementById('output_front');
			    output_front.src = URL.createObjectURL(event.target.files[0]);
			  };
			  var loadFile_right = function(event) {
			    var output_right= document.getElementById('output_right');
			    output_right.src = URL.createObjectURL(event.target.files[0]);
			  };
			</script>
			<!-- <input type="file" id="i_file" value=""> 
			<img src="" width="200" style="display:none;" />

			<script type="text/javascript">
			$('#i_file').change( function(event) {

				var file_url =  URL.createObjectURL(event.target.files[0]);

				console.log(file_url);

			    $("img").fadeIn("fast").attr('src',file_url );
			});
			</script> -->
		</div>
		<!---->


		 <input type="submit" value="Send My Message">


	</form>

</div>


