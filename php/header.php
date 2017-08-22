<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="../assets/photo_assets/favicon.png" type="image/x-icon">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src = "../js/validation.js"></script>
    <script src="../js/modalPopup.js"></script>
	<title>Spark Design</title>
</head>
<body>
	
<?php include 'query.php';?>

	<!-- please change css divyansha or Brianna? I want it look like CMS thanks~ -->
	<div id = "nav">
	<?php
		if (isset($_POST['logout']) && isset($_SESSION['logged_user'])) { 
			// If log out  user
			unset($_SESSION[ 'logged_user' ] );
			unset( $_SESSION );
			$_SESSION = array();
			session_destroy();
			echo "You are Logged Out. <a href='login.php'> Sign In?</a>";

		} else if ( isset( $_SESSION[ 'logged_user' ] )) {
			$query1 = new Query(); 
			$user1 = $query1->get_user($_SESSION['logged_user']);
			$id = $user1->get_id();
			$first_name = $user1->get_fname();
			$last_name = $user1->get_lname();
			$net_ID = $user1->get_netID();
		?>	
			<form id="nav5" name='logout' action='login.php' method='POST'>
				<?php echo "<p> Hello, ".$first_name." ".$last_name." | <a href = changepwd.php>Change password</a> | <input class='link' type='submit' name='logout' value='Log Out'></p>" ?>
			</form>	
		<?php
    	} else {
      		echo "<a class='sign_in_a' href='login.php'>Sign In</a>"; 
      		 
    	}
    ?>
	</div>

	<ul id = "nav">
		<li class="all_navs" id = "nav1"><a class="nav_text" href = "home1.php">Home</a></li>
		<li class="all_navs" id = "nav2"><a class="nav_text" href = "projects.php">Projects</a></li>
		<li class="all_navs" id = "nav3"><a class="nav_text" href = "events.php">Events</a></li>
		<li class="all_navs" id = "nav4"><a class="nav_text" href = "contact.php">Contact</a></li>
		<?php
			if ( isset( $_SESSION[ 'logged_user' ] )) {
				$query1 = new Query(); 
				$user1 = $query1->get_user($_SESSION['logged_user']);
				$id = $user1->get_id();
				$query2 = new Query(); 
				$is_admin = $query2->is_admin($id);
				if ($is_admin) {
					echo "<li class='all_navs' id = 'nav4'><a class='nav_text' href = 'manage_users.php'>Manage</a></li>";
				}
			}
		?>
	</ul>

	<div id ="header">

<!-- 	Include anything you want at the top of every page here! Example: "don't forget to sign up for the competition before friday!"
 -->	
 	</div>

		
	