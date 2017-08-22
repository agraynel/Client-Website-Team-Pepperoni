<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src = "js/validation.js"></script>
    <script src="js/modalPopup.js"></script>
	<title>Spark Design</title>
</head>

<body class="landingBody">
	
<?php include 'php/query.php';?>

	<div class="big">

		<div class="wrapper">
			<img id="sparkLogo" src="assets/SparkLogo.png" alt="SparkDesign">
			<h1 id="landSub"> <i>Product and Industrial Design</i> </h1>
			<button onclick="location.href = 'php/login.php';" class="landingButton">Log In</button>
			<button onclick="location.href = 'php/home1.php';" class="landingButton">Enter As A Guest</button>
		</div> 
	</div>
</body>
</html>