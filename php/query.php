	<!--
	CREDITS: All photos courtesy of Brianna Singer and Conrad McCarthy.

    This is the query class page
    -->

<?php 
	Include("catalog.php");

	//Initialize the databse
	require_once 'config.php';
	
	class Query{
		private $connection;

		//query class CREDIT: lecture notes
		function __construct(){
			$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			//if Various fields in the mysqli object mysqli contain errors
			if ($this->connection->errno){
				echo "SQL connection error!";
				exit();
			}
		}

		/**=========================================================================
									User log in part
			========================================================================**/
		//return all users whose name is matched
		function get_user($netID) {
			//echo '<pre>'.print_r("$uName", true).'</pre>';
			$query = "SELECT * FROM Users WHERE (netID LIKE '".$netID."');";
			$result = $this->connection->query($query);
			$row = $result->fetch_row();
			$user = new Users($row[0], $row[1], $row[2], $row[3], $row[4]);
			return $user;
        }

        //delete user
		function delete_user($id){
    		$query = new Query();
			$sql = "DELETE FROM Users WHERE uID = ".$id.";";
			//echo '<pre>'.print_r($sql, true).'</pre>';

			$result = $this->connection->query($sql);
			return true;
		}

        //change user password
		function change_pwd($netID, $password) {
			$query = "UPDATE Users SET uPassword = '" . $password . "' WHERE (netID LIKE '".$netID."');";
			$result = $this->connection->query($query);
			return true;
        }

        // return all users in db
		function get_all_users(){
			$users = array();
			$sql = "SELECT * FROM Users;";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$user = new Users($row[0], $row[1], $row[2], $row[3], $row[4]);
					$users[] = $user;
				}
				return $users;
			} else {
				return false;
			}	
		}

        // return all users by team in db
        function get_all_users_by_team($tID){
            $users = array();
            $sql = "SELECT * FROM Users as u JOIN user_team as ut ON ut.uID = u.uID WHERE ut.tID = $tID;";
            $result = $this->connection->query($sql);
            if (!empty($result)) {
                while ( $row = $result->fetch_row() ){
                    $user = new Users($row[0], $row[1], $row[2], $row[3], $row[4]);
                    $users[] = $user;
                }
                return $users;
            } else {
                return false;
            }
        }

		// return all eboards in db
		function get_all_eboards(){
			$eboards = array();
			$sql = "SELECT e.*, u.fname, u.lname, u.netID FROM Eboard e INNER JOIN eboard_user eu ON e.eboard_id = eu.eboard_id INNER JOIN Users u ON u.uID = eu.uID";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$eboard = new Eboards($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
					$eboards[] = $eboard;
				}
				return $eboards;
			} else {
				return false;
			}	
		}

		function add_admin($id, $eboard){
            $stmt = $this->connection->prepare("INSERT INTO Eboard(title, description, file_path) VALUES (?,?,?)");
            if ($stmt){
                //insert the admin in its table
                $stmt->bind_param('sss', $eboard->get_title(), $eboard->get_description(), $eboard->get_file_path());
                $stmt->execute();
                $eboard_id = $stmt->insert_id;
                //echo '<pre>'.print_r($eboard_id, true).'</pre>';
                $stmt->close();
            }
            $sql = "INSERT INTO eboard_user(eboard_id, uID) VALUES ('".$eboard_id."','".$id."')";
            //echo '<pre>'.print_r($sql, true).'</pre>';
            $result = $this->connection->query($sql);
            $this->connection->close();
            return true;  
        }

        //return true if it is admin
		function is_admin($id) {
			$query = "SELECT * FROM eboard_user WHERE uID = ".$id.";";
			$result = $this->connection->query($query);
			//echo '<pre>'.print_r($query, true).'</pre>';
			$row = $result->fetch_row();
			//echo '<pre>'.print_r($row, true).'</pre>';

			if (empty($row)) {
				return false;
			} else {
				return true;
			}
        }

        //add new user <3
        function add_user($user){
            $stmt = $this->connection->prepare("INSERT INTO Users(uPassword, fName, lName, netID) VALUES (?,?,?,?)");
            if ($stmt){
                //insert the admin in its table
                $stmt->bind_param('ssss', $user->get_pwd(), $user->get_fname(), $user->get_lname(), $user->get_netID());
                $stmt->execute();
                $uID = $stmt->insert_id;
                $stmt->close();
                $this->connection->close();
                return true;
            }else{
                return false;
            }
        }
        
        /**=========================================================================
								Teams, Projects and Photos part
			========================================================================**/

		// return all teams in db
		function get_all_teams(){
			$teams = array();
			$sql = "SELECT * FROM Teams;";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$team = new Teams($row[0], $row[1], $row[2], $row[3], $row[4]);
					$teams[] = $team;
				}
				return $teams;
			} else {
				return false;
			}	
		}

		// return all projects in db
		function get_all_projects(){
			$projects = array();
			$sql = "SELECT * FROM Projects;";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$project = new Projects($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
					$projects[] = $project;
				}
				return $projects;
			} else {
				return false;
			}	
		}

		// return team by team id
		function get_team_by_id($tID){
			$sql = "SELECT * FROM Teams WHERE tID = ".$tID.";";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				$row = $result->fetch_row();
				$team = new Teams($row[0], $row[1], $row[2], $row[3], $row[4]);
				return $team;
			} else {
				return false;
			}	
		}

		// return project by project id
		function get_project_by_id($project_id){
			$sql = "SELECT * FROM Projects WHERE project_id = ".$project_id.";";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				$row = $result->fetch_row();
				$project = new Projects($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
				return $project;
			} else {
				return false;
			}	
		}

		// return all photos in a specific album
		function get_photos_by_project_id($project_id){
			$photos = array();
			$sql = "SELECT * FROM Photos WHERE project_id = ".$project_id.";";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$photo = new Photos($row[0], $row[1], $row[2], $row[3], $row[4]);
					$photos[] = $photo;
				}
				return $photos;
			} else {
				return false;
			}	
		}

		// return photo by photo id
		function get_photo_by_pid($photo_id){
			$sql = "SELECT * FROM Photos WHERE photo_id = ".$photo_id.";";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				$row = $result->fetch_row();
				$photo = new Photos($row[0], $row[1], $row[2], $row[3], $row[4]);
				return $photo;
			} else {
				return false;
			}
		}

		//add new project <3
        function add_project($pName, $pIntro, $tID){

            $stmt = $this->connection->prepare("INSERT INTO Projects(name, description, date_added, date_modified, tID) VALUES (?,?,?,?,?)");
            $timestamp = date('Y-m-d H:i:s');
            if ($stmt){
                //insert the admin in its table
                $stmt->bind_param('ssssi', $pName, $pIntro, $timestamp, $timestamp, $tID);
                $stmt->execute();
                $project_id = $stmt->insert_id;
                $stmt->close();
                $this->connection->close();
                return true;
            }else{
                return false;
            }
        }

		/**=========================================================================
								    	Events part
			========================================================================**/

		// return past events, sort by data (the most recent event is on the top)
		function get_past_events(){
			$timestamp = date('Y-m-d H:i:s');
			//echo '<pre>'.print_r($timestamp, true).'</pre>';
			$sql = "SELECT * FROM Events WHERE event_date < '".$timestamp."' ORDER BY event_date DESC;";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$event = new Events($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
					$events[] = $event;
				}
				//echo '<pre>'.print_r($events, true).'</pre>';

				return $events;
			} else {
				return false;
			}
		}

		// return past events, sort by data (the most recent event is on the top)
		function get_upcoming_events(){
			$timestamp = date('Y-m-d H:i:s');
			//echo '<pre>'.print_r($timestamp, true).'</pre>';
			$sql = "SELECT * FROM Events WHERE event_date >= '".$timestamp."' ORDER BY event_date ASC;";
			$result = $this->connection->query($sql);
			if (!empty($result)) {
				while ( $row = $result->fetch_row() ){
					$event = new Events($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
					$events[] = $event;
				}
				return $events;
			} else {
				return false;
			}
		}

		function add_event($eName, $eIntro, $eLocation, $eDate, $filename){
            $stmt = $this->connection->prepare("INSERT INTO Events(event_name, description, date_added, event_date, location, background_image) VALUES (?,?,?,?,?,?)");
            $date = date('Y-m-d H:i:s');
            if ($stmt){
                $stmt->bind_param('ssssss', $eName, $eIntro, $date, $eDate, $eLocation, $filename);
                $stmt->execute();
                $eID = $stmt->insert_id;
                $stmt->close();
                $this->connection->close();
                return true;
            }else{
                return false;
            }
        }

		/**=========================================================================
								    	Upload and edit part
			========================================================================**/
		function upload($photo){
			//echo '<pre>'.print_r($photo, true).'</pre>';
            $stmt = $this->connection->prepare("INSERT INTO Photos(project_id, name, description, file_path) VALUES (?,?,?,?)");
            if ($stmt){
                $stmt->bind_param('isss', $photo->get_project_id(), $photo->get_name(), $photo->get_description(), $photo->get_file_path());
                //echo '<pre>'.print_r($stmt, true).'</pre>';
                $stmt->execute();
                //echo '<pre>'.print_r($stmt, true).'</pre>';
                $photo_id = $stmt->insert_id;
                $stmt->close();
                $this->connection->close();
                return true;
            }else{
                return false;
            }
        }

        //delete project
		function delete_project($pID){
			//echo '<pre>'.print_r($pID, true).'</pre>';
    		$query = new Query();
			$sql = "DELETE FROM Projects WHERE project_id = ".$pID.";";
			$result = $this->connection->query($sql);
			return true;
		}

        //delete photo
		function delete_photo($pID){
    		$query = new Query();
			$delete_photo = "DELETE FROM Photos WHERE photo_id = ".$pID.";";
			$result = $this->connection->query($delete_photo);
			return true;
		}

		//edit project
		function edit_project($pID, $pName, $pIntro){
    		$query = new Query();
			$sql = "UPDATE Projects SET name = '" . $pName . "', description = '" . $pIntro . "' WHERE project_id = " . $pID .";";
			$result = $this->connection->query($sql);
			return true;
		}

		//edit project
		function edit_photo($pID, $pName, $pIntro){
    		$query = new Query();
			$sql = "UPDATE Photos SET name = '" . $pName . "', description = '" . $pIntro . "' WHERE photo_id = " . $pID .";";
			$result = $this->connection->query($sql);
			return true;
		}




		// return all photos by search
		function get_photos_by_search($searchName, $searchIntro, $album_id_array) {
			//CREDIT: http://stackoverflow.com/questions/5295714/array-in-sql-query
			$album_id = implode(", ", $album_id_array); //makes format
			if (empty($searchName)) {
				$searchName = "%";
			}
			if (empty($searchIntro)) {
				$searchIntro = "%";
			}
			if (empty($album_id_array)) {
				$album_id = 1;
			}
			
			$pID = array();
			$photos = array();
			$sql = "SELECT DISTINCT p.pID FROM ap a LEFT OUTER JOIN photos p ON a.pID = p.pID WHERE ((p.pName LIKE '%".$searchName."%') && (p.pIntro LIKE '%".$searchIntro."%') && (a.aID in ('$album_id')));";
			//get pID
			$result = $this->connection->query($sql);
			while ( $row = $result->fetch_row() ){
				$pID[] = $row[0];
			}
			$newpID = implode(", ", $pID); //makes format

			$sql1 = "SELECT * FROM photos WHERE pID IN ($newpID);";

			$result = $this->connection->query($sql1);
			while ( $row = $result->fetch_row() ){
				$photo = new Photos($row[0], $row[1], $row[2], $row[3], $row[4]);
				$photos[] = $photo;
			}
			//echo '<pre>'.print_r($photos, true).'</pre>';
			return $photos;
		}


		//Close connection to DB
		function close(){
			$this->connection->close();
		}
	}
?>