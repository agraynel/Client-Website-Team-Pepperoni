<?php include 'header.php'; ?>


	<div class="heros_div" id="projects_hero">
		<img class= 'heros_img' src='../assets/photo_assets/l_1.png' alt='SparkDesign'>
	</div>

	<?php 

	if (isset($_POST['logout']) && isset($_SESSION['logged_user'])) { 
	// If log out normal user
		//echo '<pre>'.print_r($_SESSION['logged_user'], true).'</pre>';

		unset($_SESSION[ 'logged_user' ] );
		unset( $_SESSION );
		$_SESSION = array();
		session_destroy();

		print("Successfully signed out!<br><a href='login.php'>Sign in.</a>");
		//echo '<pre>'.print_r($_SESSION['logged_user'], true).'</pre>';
	} else {
		$netID = filter_input(INPUT_POST, 'netID', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); 

		if (!isset($_SESSION['logged_user']) && (empty($netID) || empty($password))) {?>

		<form id = "login_form" action ="login.php" method="post" onsubmit = "return validLogin()">
			<p>Net ID: <br><input id='username' type="text" name="netID"><br></p>
			<p>Password: <br><input id='password' type="password" name="password"><br></p>

			<p><input type = "submit" value="Sign in"></p>
			<h3 id="login_error_message" class="error_message"></h3>
		</form>

		<?php 
		} else {
		// Check for logged in user
			$query0 = new Query(); 

			$user = $query0->get_user($netID);
		    $db_hash_password  = $user->get_pwd();
			//echo '<pre>'.print_r($user, true).'</pre>';
		    //echo '<pre>'.print_r($db_hash_password, true).'</pre>';
		    if ( password_verify( $password, $db_hash_password ) ) {
				$_SESSION['logged_user'] = $user->get_netID();
				//echo '<pre>'.print_r($_SESSION['logged_user'], true).'</pre>';
			} 
			if (isset($_SESSION['logged_user'])) {
				$query1 = new Query(); 
				$user1 = $query1->get_user($_SESSION['logged_user']);
				$first_name = $user1->get_fname();
				$last_name = $user1->get_lname();
				$net_ID = $user1->get_netID();
				echo "<p> Welcome! ".$first_name." ".$last_name." (".$net_ID.")!</p>";
				echo '<p><a href ="changepwd.php">Change password</a></p>';
		?>
				<form name='logout' action='login.php' method='POST'>
					<p><input class='button' type='submit' name='logout' value='logout'></p>
				</form>	


<?php
			} else {
				echo '<p>Your NetID and password do not match.<br><a href ="login.php">Sign in</a></p>';
			}
		}
	}

?>
	


	<br>
<?php include 'footer.php'; ?>