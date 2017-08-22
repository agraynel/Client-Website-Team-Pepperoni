<?php include('header.php'); ?>

<div class="heros_div" id="projects_hero">
	<img class= 'heros_img' src='../assets/photo_assets/l_1.png' alt='SparkDesign'>
</div>

<!-- Body -->
<?php 

	if (isset($_SESSION['logged_user'])) { 
		$netID = $_SESSION['logged_user'];
		$old_pwd = filter_input(INPUT_POST, 'old_pwd', FILTER_SANITIZE_STRING); 
		$new_pwd1 = filter_input(INPUT_POST, 'new_pwd1', FILTER_SANITIZE_STRING);
		$new_pwd2 = filter_input(INPUT_POST, 'new_pwd2', FILTER_SANITIZE_STRING);
		if ( !isset($_POST['change_pwd']) || empty($old_pwd) || empty($new_pwd1) || empty($new_pwd2)) {
		//change password table
?>
			<div class="form_container">
		    <h1>Change password</h1>
		    	<form id = "change_pwd_form" name = "change_pwd_form" class = "form" method = "POST" action = "changepwd.php" onsubmit = "return validChange_pwd()">
				 	<div class="form_item">
		            	<h6>Please enter your old password: </h6>
						<input id='old_pwd' type='password' placeholder='Old password' name='old_pwd' >
					</div>
					<div class="form_item">
		            	<h6>Please enter your new password: </h6>
						<input id='new_pwd1' type='password' placeholder='New password' name='new_pwd1'><br>
					</div>
					<div class="form_item">
		            	<h6>Please re-enter your new password: </h6>
						<input id='new_pwd2' type='password' placeholder='Re-enter new password' name='new_pwd2'><br>
					</div>
					<div class="form_item">
						<input type='submit' class="button" name='change_pwd' value='SUBMIT'>
					</div>
					<h3 id="change_password_error" class="error_message"></h3>
				</form>
			</div>
<?php 
		} else {
			$query0 = new Query(); 
			$user = $query0->get_user($netID);
		    $db_hash_password  = $user->get_pwd();
			
		    if ( password_verify( $old_pwd, $db_hash_password ) ) {
		    	$newhashpassword = password_hash($new_pwd1, PASSWORD_DEFAULT);
				$query = new Query(); 

				$query->change_pwd($netID, $newhashpassword);

				unset($_SESSION[ 'logged_user' ] );
				unset( $_SESSION );
				$_SESSION = array();
				session_destroy();

				echo ("Successfully changed password!<br><a href='login.php'>Sign in</a> again.");
		    } else {
		    	echo "Old password does not match! Back to <a href = 'changepwd.php'>change password</a>.";
		    }
		}
	} else {
	// not log in, remind log in 
?>
		<div class = "display_information">
			<h1>Please <a href='login.php'>log in</a> first in order to change password!!</h1>
		</div>
<?php	

	}
	
?>

</body>
</html>