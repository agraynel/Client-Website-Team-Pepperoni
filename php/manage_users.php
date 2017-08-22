<?php include 'header.php'; ?>

	<div class="heros_div" id="projects_hero">
		<img class= 'heros_img' src='../assets/photo_assets/c_1.png' alt='SparkDesign'>
	</div>
	<h3> Manage Users </h3>


	<div class = 'transbox'>
<?php
    if ( isset( $_SESSION[ 'logged_user' ] )) {
        $query1 = new Query(); 
        $user1 = $query1->get_user($_SESSION['logged_user']);
        $id = $user1->get_id();
        $query2 = new Query(); 
        $is_admin = $query2->is_admin($id);
        if ($is_admin) {

?>
            <button class='link' onclick='show_add_user()'>Add User</button>
            <div id='divider1'></div>
            <!-- Add user part-->
            <div id='add_user_popup' class='modal'>
                <div class='modal_content'>
                    <button class='close' onclick='close_add_user()'>×</button>
                    <div class='popup_message_container'>
                        <h6>Add user</h6>
                        <form class='form' name='add_user_form' action='manage_users.php' method='POST' onsubmit='return validateUser();'>
                            <div class="form_item">
                                <h6>Last Name:</h6>
                                <input placeholder="Last name" type="text" name="last_name" id = "last_name">
                            </div>
                            <div class="form_item">
                                <h6>First Name:</h6>
                                <input placeholder="First name" type="text" name="first_name" id = "first_name">
                            </div>
                            <div class="form_item">
                                <h6>Net ID:</h6>
                                <input placeholder="Net ID" type="text" name="net_id" id = "net_id">
                            </div>
                            <div class="form_item">
                                <h6>Password:</h6>
                                <input type="password" name="user_password" id = "user_password1">
                            </div>
                            <div class="form_item">
                                <h6>Enter password again:</h6>
                                <input type="password" name="user_password" id = "user_password2">
                            </div>
                            <div class="form_item">
                                <input class = "button" type="submit" value="ADD" name="add_user" id = "add_admin">
                            </div>   
                        </form>
                         <h3 id='add_user_error' class='error_message'>
                    </div>
                </div>
            </div>  

<?php                    
    	  	$query0 = new Query(); 
    	  	//get all the albums and display them on the gallery.php
    	  	$users = $query0->get_all_users(); 

    	  	if ( !empty($users)) {
    			foreach ($users as $user){ 
    			    $fName = $user->get_fname();
    			    $lName = $user->get_lname();  
    			    $netID = $user->get_netID(); 
    			    $id = $user->get_id(); 

    	?>
    				
    				<p><?php echo $netID ?><br><?php echo $fName ?> <?php echo $lName ?></p>
    		
    				<button class='link' onclick='show_delete_user(<?php echo $id ?>)'>Delete the user</button><br>
    			<?php
    				$query666 = new Query();
        			$is_admin = $query666->is_admin($id); 

        			if ($is_admin) {
        				echo "already e-board!";
        			} else {
        				echo "<button class='link' onclick='show_add_admin(".$id .")'>Add to e-Board</button>";
        				echo " <h3 id='admin_error_message2' class='error_message'></h3>";
        			}

    			?>
    				

                    <!-- Delete user part-->
                    <div id='delete_user_popup' class='modal'>
                      	<div class='modal_content'>
                          	<button class='close' onclick='close_delete_user()'>×</button>
                          	<div class='popup_message_container'>
                            	<h6><strong>WARNING:</strong> YOU ARE GOING TO DELETE THIS USER!</h6>
                            	<form class='form' name='delete_user_form' action='manage_users.php' method='POST'>
                              		<input type='hidden' id='delete_user_id' name='delete_user_id' value='0'><br>
                              		<input type='submit' name='delete_user' value='DELETE'>
                            	</form>
                          	</div>
                      	</div>
                    </div>       

                    <!-- Add admin part-->
                    <div id='add_admin_popup' class='modal'>
                      	<div class='modal_content'>
                          	<button class='close' onclick='close_add_admin()'>×</button>
                          	<div class='popup_message_container'>
                            <h6><strong>WARNING:</strong> YOU ARE GOING TO ADD THIS USER TO E-BOARD!</h6>
                            <form class='form' name='add_admin_form' id='add_admin_form' enctype='multipart/form-data' action='manage_users.php' onsubmit='return validateAdmin();' method='POST'>

                              	<input type='hidden' id='add_admin_id' name='add_admin_id' value='0'><br>
                            	<h6>Upload admin photograph: </h6>
                                <div class="form_item">
                                    <h6>Title:</h6>
                                	<input placeholder="Admin title" type="text" name="admin_title" id = "admin_title">
                                </div>
                                <div class="form_item">

                                    <h6>Browse: </h6>
                                    <input type="file" name="admin_file_upload" id = "admin_file_upload" accept="image/*" onchange="loadFile(event)">         
                                    <img id="output" class = "thumbnail" style="width:250px" src = "../assets/thumbnails.png" alt = "preview"/>
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
                                    <h6>Introduction:</h6>
                                	<input placeholder="Describe admin" type="text" name="admin_intro" id = "admin_intro">
                                </div>
                                <div class="form_item">
                                    <input class = "button" type="submit" value="ADD" name="add_admin" id = "add_admin">
                                </div>

                            	<!-- This is the place to sign the error!-->
                             	<h3 id="admin_error_message" class="error_message"></h3>
                            </form>

                          </div>
                      </div>
                    </div> 

    				<div id='divider1'></div>
    	<?php 
    			} 	  		
    	  	} else {
    	  		echo "No members!!";
    	  	}
        } else {
            echo "You are not an admin to to manage the users!";
        }
    } else {
        echo "You don't have the authority to manage the users!";
    }


if (isset($_POST['delete_user'])) {
    $id = $_POST['delete_user_id'];
    echo '<pre>'.print_r($id, true).'</pre>';
    $query = new Query();
    $query->delete_user($id); 
}

if (isset($_POST['add_admin'])) {
	$id = $_POST['add_admin_id'];
	$title = htmlentities($_POST['admin_title']);
	$intro = htmlentities($_POST['admin_intro']);
	$file = $_FILES['admin_file_upload']; 
	$filename = $file['name'];
	
	//this is the file path to be added to the server
    $path = '../assets/headshots/'.$filename;
    //echo '<pre>'.print_r($path, true).'</pre>';
    //check if this file path has already exists! File paths do not allow duplicates.
    if (file_exists($path)) {
        echo '<script language="javascript">';
        //report file path exist error
        echo 'file_exist_error_admin();';
        echo '</script>';
    } else {
        $eboard = new Eboards(0, $title, $intro, $filename, 0, 0, 0);
        //echo '<pre>'.print_r($eboard, true).'</pre>';
        move_uploaded_file($file['tmp_name'], "../assets/headshots/".$filename);
        $query = new Query();  
        $query->add_admin($id, $eboard);
        echo '<script language="javascript">';
        echo 'photo_upload_text_admin();';
        echo '</script>';
    }
}

if (isset($_POST['add_user'])) {
    $first_name = htmlentities($_POST['first_name']);
    $last_name = htmlentities($_POST['last_name']);
    $net_id = htmlentities($_POST['net_id']);
    $user_password1 = filter_input(INPUT_POST, 'user_password1', FILTER_SANITIZE_STRING);
    echo '<pre>'.print_r($user_password1, true).'</pre>';
    $password = password_hash($user_password1, PASSWORD_DEFAULT);
    $user = new Users(0, $password, $first_name, $last_name, $net_id);
    $query = new Query();  
    $query->add_user($user);
     
}

?>

	</div>


<?php include 'footer.php'; ?>