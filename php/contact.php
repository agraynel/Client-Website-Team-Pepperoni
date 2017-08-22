<?php include 'header.php'; ?>

	<div class="heros_div" id="projects_hero">
		<img class= 'heros_img' src='../assets/photo_assets/c_1.png' alt='SparkDesign'>
	</div>
<h3> Contact </h3>

<?php
	  	$query0 = new Query(); 
	  	//get all the albums and display them on the gallery.php
	  	$eboards = $query0->get_all_eboards(); 

	  	if ( !empty($eboards)) {
			foreach ($eboards as $eboard){ 
			    $title = $eboard->get_title();
			    $description = $eboard->get_description();  
			    $fName = $eboard->get_fname();
			    $lName = $eboard->get_lname();  
			    $netID = $eboard->get_netID(); 
			    $file_path = $eboard->get_file_path(); 
		?>
				<div class='contact_container'>
					<div class='contact_img'>
		           		<?php echo "<img class= '' src='../assets/headshots/" . $file_path . "' alt='" . $netID . "' width= '100%' height= '100%'>";?>
		           	</div>
			  		<div class="contact_word">
			  			<div class="contact_name_email">
			  				<div class="contact_name">
					    		<h3><?php echo $fName ?> <?php echo $lName ?></h3>
					    	</div>
					    	<div class="contact_email">
					    		<h3><a href="mailto:<?php echo $netID?>@cornell.edu?Subject=Hello%20SparkDesign" target="_top"><img border="0" alt="e_mail" src="../assets/mail.png" width="40" height="40"></a></h3>
					    	</div>
					    </div>

					    <div class="contact_information">
					    	<div class="contact_title">
								<?php echo $title ?>
					    	</div>
					    	<div class="contact_description">
								<?php echo $description ?>
					    	</div>
					    </div> 
			  		</div>
			  	</div>

	<?php 
			} 	  		
	  	} else {
	  		echo "no eBoards!!";
	  	}
?>
