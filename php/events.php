 <?php include 'header.php'; ?>


	<div class="heros_div" id="projects_hero">
		<img class= 'heros_img' src='../assets/photo_assets/e_1.png' alt='SparkDesign'>
	</div>


	<h3> Events </h3>
<?php
	if ( isset( $_SESSION[ 'logged_user' ] )) {
?>
<!-- Add event part-->
    <div id='add_event_popup' class='modal'>
      	<div class='modal_content'>
      		<button class='close' onclick='close_add_event()'>×</button>
      		<div class='popup_message_container'>
            	<h6>Add a new event:</h6>
            	<form class='form' name='add_event_form' action='events.php' method='POST' onsubmit = 'return validateEvent();' enctype='multipart/form-data'>
            		<div class="form_item">
                        <h6>Event name: </h6>
                        <input placeholder="Event name" type="text" name="event_name" id = "event_name">
                    </div>
                    <div class="form_item">
                        <h6>Event date and time: </h6>
                        <input type="datetime-local" name="event_time" id = "event_time">
                    </div>
                    <div class="form_item">
                        <h6>Event location: </h6>
                        <input placeholder="Event location" type="text" name="event_loc" id = "event_loc">
                    </div>
                    <div class="form_item">
                        <h6>Upload photos: </h6>
                        <input type="file" name="photo_file_upload" id = "photo_file_upload" accept="image/*" onchange="loadFile(event)">         
                        <img id="output" class = "thumbnail" style="width:200px" src = "../assets/thumbnails.png" alt = "preview"/>
                        <script>
                            var loadFile = function(event) {
                                var reader = new FileReader();
                                reader.onload = function(){
                                    var output = document.getElementById('output');
                                    output.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            };
                        </script>
                    </div>
                    <div class="form_item">
                        <h6>Event description: </h6>
                        <input placeholder="Event description" type="text" name="event_intro" id = "event_intro">
                    </div>
              		<input type='submit' name='add_event' value='ADD'>
            	</form>

            	<!-- This is the place to sign the error!-->
              <h3 id="event_error_message" class="error_message"></h3>
          	</div>
      	</div>
    </div> 


		<div class='edit_item'>
        <h4><?php echo "<button class='link' onclick='show_add_event()'>Add new event</button>" ?></h4>
        <h3 id="event_error_message2" class="error_message"></h3>
    </div>
<?php
	}
?>




<!-- //////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->







<div class = "contain_events">
  <h2>Future Events</h2>
<?php
	$newEventsQuery0 = new Query(); 
  	//get all the albums and display them on the gallery.php
  	$events = $newEventsQuery0->get_upcoming_events(); 
  	if ( !empty($events)) {
		  foreach ($events as $event){ 
		    $eID = $event->get_id();
		    $event_name = $event->get_name(); 
		    $event_description = $event->get_description();
        $event_loc = $event->get_location();
		    $date_added = $event->get_date_added();  
		    $event_date = $event->get_date_event();  
		    $bg_image = $event-> get_bgImage();
        ?>
          
            <div class="events_transbox" style="background: red url('../assets/photo_assets/<?php echo $bg_image ?>'); background-size: 100%; background-position: right;">

                <div class="inner_events_transbox">
                    <h4 class="event_title"><?php echo $event_name ?></h4>
                    <p class="event_date">When: <?php echo $event_date ?></p>
                    <p class="event_loc">Where: <?php echo $event_loc ?></p>
                    <p class="event_desc"><?php echo $event_description ?></p>

                </div>
           </div><br>
	<?php 
		  } 	  		
  	} else {
  		echo "There are currently no upcoming events.";
  	}
	?>
</div>


   <div class = "contain_events">

  <h2>Past Events</h2>
	<?php
	$oldEventsQuery0 = new Query(); 
  	//get all the albums and display them on the gallery.php
  	$events = $oldEventsQuery0->get_past_events(); 
  	if ( !empty($events)) {
		foreach ($events as $event){ 
		    $eID = $event->get_id();
		    $event_name = $event->get_name(); 
		    $event_description = $event->get_description();
		    $date_added = $event->get_date_added();  
		    $event_date = $event->get_date_event();  
        $event_loc = $event->get_location();
        $bg_image = $event-> get_bgImage();

        // change the format of the date

        $formatDate = strtotime($event_date);
        $newFormatDate = date('M d, Y',$formatDate);       
        $event_date = $newFormatDate;

	?>
         




            <div class="events_transbox" style="background: red url('../assets/photo_assets/<?php echo $bg_image ?>'); background-size: 100%; background-position: right;">

                <div class="inner_events_transbox">
                    <h4 class="event_title"><?php echo $event_name ?></h4>
                    <p class="event_date">When: <?php echo $event_date ?></p>
                    <p class="event_loc">Where: <?php echo $event_loc ?></p>
                    <p class="event_desc"><?php echo $event_description ?></p>

                </div>
           </div><br>
          
	
    <?php

		} 	  		
  	} else {
  		echo "There are no past events to display.";
  	}
  ?>

  </div>





<!-- //////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->





<?php 

    // add events
    if (isset($_POST['add_event'])) {
        $eName = htmlentities($_POST['event_name']);
        $eIntro = htmlentities($_POST['event_intro']);
        $eLocation = htmlentities($_POST['event_loc']);
        $eDate = $_POST['event_time'];

        $file = $_FILES['photo_file_upload']; 
        $filename = $file['name'];
        //this is the file path to be added to the server
        $path = '../assets/photo_assets/'.$filename;
        //echo '<pre>'.print_r($path, true).'</pre>';
        //check if this file path has already exists! File paths do not allow duplicates.
        if (file_exists($path)) {
            echo '<script language="javascript">';
            //report file path exist error
            echo 'file_exist_error_event();';
            echo '</script>';
        } else {
            move_uploaded_file($file['tmp_name'], "../assets/photo_assets/".$filename);
            //echo '<pre>'.print_r($photo, true).'</pre>';
            
            $query = new Query();
            $query->add_event($eName, $eIntro, $eLocation, $eDate, $filename);
            echo '<script language="javascript">';
            echo 'photo_upload_text_event();';
            echo '</script>';
        }
    }

?>




	
<?php include 'footer.php'; ?>