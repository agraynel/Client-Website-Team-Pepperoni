<?php include 'header.php'; ?>

    <div class="heros_div" id="projects_hero">
        <img class= 'heros_img' src='../assets/photo_assets/p_1.png' alt='SparkDesign'>
    </div>
    
    <?php
        if (isset($_GET['id'])) {
            $id = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['id']);
            $pID = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['pID']);

            echo '<a href = "project.php?id='.$pID.'">Go Back</a>';

            if (!empty($id)) {
                $query0 = new Query();
                $team = $query0->get_team_by_id($id);
                $tID = $team->get_id();
                $team_name = $team->get_name();
                $team_description = $team->get_description();
                $date_added = $team->get_date_added();
                $file_path = $team->get_file_path();

                $query1 = new Query();

                $members = $query1->get_all_users_by_team($tID);

                ?>
                <div class="transbox">
                    <p><h3>Team: <?php echo $team_name ?></h3></p>
                    <p><br>Created on: <?php echo $date_added ?></p>
                    <p>Description: <?php echo $team_description ?></p>
                    <p><?php echo "<img class= '' src='../assets/team_assets/" . $file_path . "' alt='" . $team_name . "' style= 'width:400px'>";?></p>
                    <p>Members:
                    <?php
                    if (!empty($members)) {
                        echo '<ul>';
                        foreach ($members as $member) {

                            $fName = $member->get_fname();
                            $lName = $member->get_lname();
                            $netID = $member->get_netID();
                            echo '<li>'.$fName .' '. $lName .' - '. $netID.'</li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                    </p>
                </div>
                <?php
            }
        }
        ?>
    </div>
<?php include 'footer.php'; ?>