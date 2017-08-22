<?php include 'header.php'; ?>


	<div class="heros_div" id="projects_hero">
		<img class= 'heros_img' src='../assets/photo_assets/p_1.png' alt='SparkDesign'>
	</div>


  	<h2>PROJECTS</h2>

<?php
    if (isset($_SESSION['logged_user'])) {
?>
        <div class='edit_item'>
        <h4><?php echo "<button class='link' onclick='show_add_project_popup()'>Add project</button>" ?></h4>
        </div>
<?php
    }
?>
    
    <!-- delete project part-->
    <div id='delete_project_popup' class='modal'>
        <div class='modal_content'>
            <button class='close' onclick='close_delete_project()'>×</button>
            <div class='popup_message_container'>
                <h6>WARNING: YOU ARE GOING TO DELETE THIS PROJECT!</h6>
                <form class='form' name='delete_project_form' action='projects.php' method='POST'>
                    <input type = 'hidden' id='delete_project_id' name='delete_project_id' value='0'><br>
                    <input type='submit' name='delete_project' value='DELETE'>
                </form>    
            </div>
        </div>
    </div> 

  	<div class = "album_display">

  		 <!-- add project modal pop up part-->
        <div id='add_project_popup' class='modal'>
            <div class = modal_content>
                <button class='close' onclick='close_project_popup()'>×</button>
                <div class = popup_message_container>
                    <h1>Add projects</h1>
                    <form method="post" id = "add_project_form" class = "form" enctype="multipart/form-data" onsubmit = "return validateProject();">
                        <h6>Input your new project name:</h6>
                        <input id='add_project_name' type='text' placeholder='Project name' name='add_project_name' maxlength='100'><br>
                        <h6>Input your new project introduction:</h6>
                        <input id='add_project_intro' type='text' placeholder='Project introduction' name='add_project_intro' maxlength='1000'><br>
                        <h6>Select the team</h6><select name="add_project_team">
                            <?php
                                $query = new Query();
                                //get all the albums and display them on the gallery.php
                                $teams = $query->get_all_teams();
                                if ( !empty( $teams)) {
                                    foreach ($teams as $team) {
                                        $n = $team->get_name();
                                        $i = $team->get_id();
                                        echo '<option value="'.$i.'">'.$n.'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <input type='submit' name='add_project' value='ADD'>
                    </form>
                    <!-- This is the place to sign the error!-->
                    <h3 id="add_project_message" class="error_message"></h3>
                </div>
          </div>
        </div>

    <div id ="project_container">
    <?php
      	$query0 = new Query(); 
      	//get all the albums and display them on the gallery.php
      	$projects = $query0->get_all_projects(); 

      	if ( !empty( $projects)){
	      	foreach ($projects as $project){ 
		        $project_id = $project->get_id();
		        $project_name = $project->get_name(); 
		        $project_date = $project->get_date();
		        $project_description = $project->get_description();
		        $project_tid = $project->get_tid(); 

		        $project_team = $query0->get_team_by_id($project_tid); 
		        $project_team_name = $project_team->get_name();

                // format date
                $formatDate = strtotime($project_date);
                $newFormatDate = date('M d, Y',$formatDate);       
                $project_date = $newFormatDate;
	?>

    		      	<div class="project_transbox">
                            <div class="inner_project_transbox">
            				    <?php echo '<h3><a class="project_title" href = "project.php?id='.$project_id.'">'. $project_name.'</a></h3>'; ?>
            			        <h4 class="project_text">Started: <?php echo $project_date ?></h4>
            			        <h4 class="project_text"><?php echo $project_description ?></h4>
            			        <h4 class="project_text">By <?php echo $project_team_name ?></h4>
                                <?php
                                        if (isset($_SESSION['logged_user'])) {
                                    ?>
                                <?php echo "<button class='link' onclick='show_delete_project(".$project_id.")'><h7 id=".$project_id."'>Delete Project</h7></button>" ?>
                                <?php
                                    }
                                ?>  
                            </div>
        			</div>

                <?php
	    	}
		} else {
			echo "<h6>No projects available!!!<h6>";
		}


    //add project
    if (isset($_POST['add_project'])) {
        $pName = htmlentities($_POST['add_project_name']);
        $pIntro = htmlentities($_POST['add_project_intro']);
        $pTeam = htmlentities($_POST['add_project_team']);
        $query = new Query();
        $query->add_project($pName, $pIntro, $pTeam);
    }


    // Delete project
    if (isset($_POST['delete_project'])) {
        $id = $_POST['delete_project_id'];
        //echo '<pre>'.print_r($id, true).'</pre>';
        $query = new Query();
        $query->delete_project($id); 
    }

	?>
	</div>

</div>