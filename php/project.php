<?php include 'header.php'; ?>
    <div class="heros_div" id="projects_hero">
        <img class= 'heros_img' src='../assets/photo_assets/p_1.png' alt='SparkDesign'>
    </div>

    <h2>PROJECT</h2>
<div>
    Back to <a href = "projects.php">projects</a>.

    <?php

    if (isset($_GET['id'])) {
        $id = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['id']);
        if (!empty($id)) {
            $query1 = new Query();
            $project = $query1->get_project_by_id($id);
            $project_name = $project->get_name();
            $project_description = $project->get_description();
            $project_tid = $project->get_tid();
            $project_date = $project->get_date();
            $project_team = $query1->get_team_by_id($project_tid);
            $project_team_name = $project_team->get_name();
            ?>

            <!-- upload photo modal pop up part-->
            <div id='upload_photo_popup' class='modal'>
                <div class = modal_content>
                    <button class='close' onclick='close_upload_photo_popup()'>×</button>
                    <div class = popup_message_container>
                        <h1>Upload photos</h1>
                        <form method="post" id = "upload_photo" class = "form" enctype="multipart/form-data" onsubmit = "return validatePhoto();">
                            <div class="form_item">
                                <h6>Photo name: </h6>
                                <input placeholder="Name your photo" type="text" name="photo_name" id = "photo_name">
                            </div>
                            <div class="form_item">
                                <h6>Upload photos: </h6>
                                <input type="file" name="photo_file_upload" id = "photo_file_upload" accept="image/*" onchange="loadFile(event)">         
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
                            <input placeholder="Describe your photo" type="text" name="photo_intro" id = "photo_intro">
                            </div>
                            <input type='hidden' id='upload_photo_id' name='upload_photo_id' value='0'>
                            <div class="form_item">
                                <input class = "button" type="submit" value="UPLOAD" name="upload" id = "upload">
                            </div>

                            <!-- This is the place to sign the error!-->
                             <h3 id="upload_error_message" class="error_message"></h3>
                        </form>
                    </div>
              </div>
            </div>

            <!-- Edit project part-->
            <div id='edit_project_popup' class='modal'>
                <div class='modal_content'>
                    <button class='close' onclick='close_edit_project()'>×</button>
                    <div class='popup_message_container'>
                        <h6>Edit Project:</h6>
                        <form class='form' name='edit_project_form' action='project.php?id=<?php echo $id ?>' onsubmit='return validEditProject();' method='POST'>
                            <input type='hidden' id='edit_project_id' name='edit_project_id' value='0'><br>
                            <h6>Input your new project name:</h6>
                            <input id='edit_project_name' type='text' placeholder='Project Name' name='edit_project_name' maxlength='100'><br>
                            <h6>Input your new project introduction:</h6>
                            <input id='edit_project_intro' type='text' placeholder='Project introduction' name='edit_project_intro' maxlength='1000'><br>
                            <input type='submit' name='edit_project' value='EDIT'>
                        </form>
                    </div>
                    <h3 id="edit_project_error" class="error_message"></h3>
                </div>
            </div> 

            <div class="transbox">
                <?php echo '<h3>Project:'. $project_name.'</h3>'; ?>
                <h4><br>Date Started: <?php echo $project_date ?></h4>
                <h4>Description: <?php echo $project_description ?></h4>
                
                <h4>Team: <?php echo '<a href = "team.php?id='.$project_tid.'&pID='.$id.'">'. $project_team_name.'</a>'?></h4>
            <?php
                if (isset($_SESSION['logged_user'])) {
            ?>
                    <div class='edit_item'>
                        <?php echo "<button class='link' onclick='show_upload_photo_popup(" . $id.")'><h7>Upload Photos</h7></button>" ?> | <?php echo "<button class='link' onclick='show_edit_project(" . $id.")'><h7 id='edit_project_".$id."'>Edit Project</h7></button>" ?>
                    </div>
                    <h3 id="upload_error_message2" class="error_message"></h3>
            <?php
                }
            ?>
            </div>
            <div class='photo_display'>
            <?php
            echo "<h4>Photos in Project: " . $project_name . "</h4><br>";
            $json0 = array($project_name);
            $jsons0 = $json0;
            $query2 = new Query();

            $photos = $query2->get_photos_by_project_id($id);
            $jsons = array();

            if (!empty($photos)) {
                echo "<div class='project_photo_display'>";
                foreach ($photos as $photo) {
                    $pID = $photo->get_id();
                    $pName = $photo->get_name();
                    $pURL = $photo->get_file_path();
                    $pDescription = $photo->get_description();

                    $json = array($pName, $pURL, $pDescription);
                    $jsons = $json;
                    ?>
                    <div class='gallery_thumbnail'>
                        <div class='photo_item'>
                            <?php
                            echo "<a href = 'project.php?id=". $id ."&photo_id=".$pID."'><img class= 'image_container' id ='".$pID."' src = '../assets/photo_assets/" . $pURL . "' alt='" . $pName . "'></a>";
                            ?>
                        </div>
                    </div>
                    <br>
            <?php
                }
            } else {
                echo "No photos in this project!";
            }

            echo "</div>";
        }
        echo "</div>";
        echo "<div id='divider1'></div>";

        if (isset($_GET['photo_id'])) {

            //echo '<pre>'.print_r($_GET['photo_id'], true).'</pre>';
            $jsons = array();
            $query2 = new Query();
            $pID = $_GET['photo_id'];
            $photo = $query2->get_photo_by_pid($pID);
            $pName = $photo->get_name(); 
            $pURL = $photo->get_file_path();  
            $pIntro = $photo->get_description();
    ?>

            <!-- for display descriptions-->
            <div>
                <h3 class='name'>Photo name: <?php echo $pName ?></h3>
                <h5 class='description'>Description: <?php echo $pIntro ?></h5>
            </div>
    <?php 
            echo "<img class= 'image_origin' src='../assets/photo_assets/" . $pURL . "' alt='" . $pName . "'>";
            if (isset($_SESSION['logged_user'])) {
                //echo '<pre>'.print_r($_SESSION['logged_user'], true).'</pre>'; 
?>
                <div class='edit_container'>
                    <div class='edit_item'>
                        <?php echo "<button class='link' onclick='show_edit_photo(" . $pID.")'><h7 id='edit_photo_".$pID."'>Edit Photo</h7></button>" ?> | <?php echo "<button class='link' onclick='show_delete_photo(".$pID.")'><h7 id='##".$pID."'>Delete Photo</h7></button>" ?>
                    </div>
                </div>

                <!-- Edit photo part-->
                <div id='edit_photo_popup' class='modal'>
                    <div class='modal_content'>
                        <button class='close' onclick='close_edit_photo()'>×</button>
                        <div class='popup_message_container'>
                            <h6>Edit Photo:</h6>
                            <form class='form' name='edit_photo_form' action='project.php?id=<?php echo $id ?>&photo_id=<?php echo $pID ?>' onsubmit='return validEditPhoto();' method='POST'>
                                <input type='hidden' id='edit_photo_id' name='edit_photo_id' value='0'><br>
                                <h6>Input your new photo name:</h6>
                                <input id='edit_photo_name' type='text' placeholder='Photo Name' name='edit_photo_name' maxlength='100'><br>
                                <h6>Input your new photo introduction:</h6>
                                <input id='edit_photo_intro' type='text' placeholder='Photo introduction' name='edit_photo_intro' maxlength='1000'><br>
                                <input type='submit' name='edit_photo' value='EDIT'>
                            </form>
                        </div>
                        <h3 id="edit_photo_error" class="error_message"></h3>
                    </div>
                </div>  

                <!-- Delete photo part-->
                <div id='delete_photo_popup' class='modal'>
                  <div class='modal_content'>
                      <button class='close' onclick='close_delete_photo()'>×</button>
                      <div class='popup_message_container'>
                        <h6>WARNING: YOU ARE GOING TO DELETE THIS PHOTO!</h6>
                        <form class='form' name='delete_photo_form' action='project.php?id=<?php echo $id ?>' method='POST'>
                          <input type='hidden' id='delete_photo_id' name='delete_photo_id' value='0'><br>
                          <input type='submit' name='delete_photo' value='DELETE'>
                        </form>
                      </div>
                  </div>
                </div>        

<?php           
            }
        } else {
            echo "No project photo selected!";
        }
    }
?>

</div>

<?php
    //upload the photo
    if (isset($_POST['upload'])) {
        // filter: htmlentities 
        $project_id = $_POST['upload_photo_id'];
        $name = htmlentities($_POST['photo_name']);
        $intro = htmlentities($_POST['photo_intro']);
        $file = $_FILES['photo_file_upload']; 
        $filename = $file['name'];
        //this is the file path to be added to the server
        $path = '../assets/photo_assets/'.$filename;
        //echo '<pre>'.print_r($path, true).'</pre>';
        //check if this file path has already exists! File paths do not allow duplicates.
        if (file_exists($path)) {
            echo '<script language="javascript">';
            //report file path exist error
            echo 'file_exist_error();';
            echo '</script>';
        } else {
            $photo = new Photos(0, $project_id, $name, $intro, $filename);
            move_uploaded_file($file['tmp_name'], "../assets/photo_assets/".$filename);
            //echo '<pre>'.print_r($photo, true).'</pre>';
            $query3 = new Query();  
            $query3->upload($photo);
            echo '<script language="javascript">';
            echo 'photo_upload_text();';
            echo '</script>';
        }
    }

    // Edit photo when Edit Photo Form submitted
    if (isset($_POST['edit_photo'])) {
        $pID = $_POST['edit_photo_id'];
        $pName = htmlentities($_POST['edit_photo_name']);
        $pIntro = htmlentities($_POST['edit_photo_intro']);
        $query = new Query();
        $query->edit_photo($pID, $pName, $pIntro);
    }

    // Delete photo
    if (isset($_POST['delete_photo'])) {
        $pID = $_POST['delete_photo_id'];
        $query = new Query();
        $query->delete_photo($pID); 
    }

    //edit project
    if (isset($_POST['edit_project'])) {
        $pID = $_POST['edit_project_id'];
        $pName = htmlentities($_POST['edit_project_name']);
        $pIntro = htmlentities($_POST['edit_project_intro']);
        $query = new Query();
        $query->edit_project($pID, $pName, $pIntro);
    }


?>


<?php include 'footer.php'; ?>