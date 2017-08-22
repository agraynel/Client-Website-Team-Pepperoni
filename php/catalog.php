<?php
	//table: Users
	class Users { 
		public $uID;
		public $uPassword;
		public $fName;
		public $lName;
		public $netID;

		function __construct($uID = 0, $uPassword = "", $fName = "", $lName = "", $netID = "") { 
			$this->uID = $uID;
			$this->uPassword = $uPassword; 
			$this->fName = $fName; 
			$this->lName = $lName; 
			$this->netID = $netID; 
		}

		function get_id(){
    		return $this->uID;
    	}

    	function get_pwd(){
    		return $this->uPassword;
    	}

    	function get_fname(){
    		return $this->fName;
    	}

    	function get_lname(){
    		return $this->lName;
    	}

    	function get_netID(){
    		return $this->netID;
    	}
	}

	//table: Eboard combine with users
	class Eboards { 
		public $eboard_id;
		public $title;
		public $description;
		public $file_path;
		public $fName;
		public $lName;
		public $netID;

		function __construct($eboard_id = 0, $title = "", $description = "",  $file_path = "", $fName = "", $lName = "", $netID = "") { 
			$this->eboard_id = $eboard_id;
			$this->title = $title; 
			$this->description = $description; 
			$this->file_path = $file_path; 
			$this->fName = $fName; 
			$this->lName = $lName; 
			$this->netID = $netID; 
		}

		function get_eid(){
    		return $this->eboard_id;
    	}


    	function get_title(){
    		return $this->title;
    	}

    	function get_description(){
    		return $this->description;
    	}

    	function get_fname(){
    		return $this->fName;
    	}

    	function get_lname(){
    		return $this->lName;
    	}

    	function get_netID(){
    		return $this->netID;
    	}

    	function get_file_path(){
    		return $this->file_path;
    	}

	}

	//table: Projects(project_id,  name, description, date_added, date_modified, team_id)
	class Projects { 
		public $project_id;
		public $name;
		public $description;
		public $date_added;
		public $date_modified;
		public $team_id;

		function __construct($project_id = 0, $name = "", $description = "", $date_added = "", $date_modified = "", $team_id = "") { 
			$this->project_id = $project_id;
			$this->name = $name;
			$this->description = $description; 
			$this->date_added = $date_added; 
			$this->date_modified = $date_modified;
			$this->team_id = $team_id;
		}

		function get_id(){
    		return $this->project_id;
    	}

    	function get_name(){
    		return $this->name;
    	}

    	function get_description(){
    		return $this->description;
    	}

    	function get_date(){
    		return $this->date_added;
    	}

    	function get_dateModified(){
    		return $this->date_modified;
    	}

    	function get_tid(){
    		return $this->team_id;
    	}
	}

	//Photos(photo_id, project_id, name, description, file_path, date_added)
	class Photos { 
		public $photo_id;
		public $project_id;
        public $name;
		public $description;
		public $file_path;

		function __construct($photo_id = 0, $project_id = "", $name = "", $description = "", $file_path = "") {
			$this->photo_id = $photo_id;
			$this->project_id = $project_id;
            $this->name = $name;
			$this->description = $description;
			$this->file_path = $file_path;
		}

		function get_id(){
    		return $this->photo_id;
    	}

    	function get_project_id(){
    		return $this->project_id;
    	}

    	function get_name(){
    		return $this->name;
    	}

    	function get_description(){
    		return $this->description;
    	}

    	function get_file_path(){
    		return $this->file_path;
    	}
	}

	//table: user_team(uID, tID) relationship
	class user_team { 
		public $uID;
		public $tID;

		function __construct($uID = 0, $tID = 0) {
			$this->uID = $uID; 
			$this->tID = $tID;
		}

		function get_uid(){
    		return $this->uID;
    	}

    	function get_tid(){
    		return $this->tID;
    	}
	}

	//table: Teams(tID, team_name, team_description, date_added, file_path)
	class Teams { 
		public $tID;
		public $team_name; 
		public $team_description;
		public $date_added;
		public $file_path;

		function __construct($tID = 0, $team_name = "", $team_description = "", $date_added = "", $file_path = "") { 
			$this->tID = $tID;
			$this->team_name = $team_name;
			$this->team_description = $team_description; 
			$this->date_added = $date_added;
			$this->file_path = $file_path;
		}

		function get_id(){
    		return $this->tID;
    	}

    	function get_name(){
    		return $this->team_name;
    	}

    	function get_description(){
    		return $this->team_description;
    	}

    	function get_date_added(){
    		return $this->date_added;
    	}

    	function get_file_path(){
    		return $this->file_path;
    	}
	}

	//table: Events(eID, event_name, description, date_added, event_date, file_path, location, background_image)
	class Events { 
		public $eID;
		public $event_name; 
		public $description;
		public $date_added;
		public $event_date;
		public $location;
		public $background_image;

		function __construct($eID = 0, $event_name = "", $description = "", $date_added = "", $event_date = "", $location = "", $background_image = "") {
			$this->eID = $eID;
			$this->event_name = $event_name;
			$this->description = $description; 
			$this->date_added = $date_added;
			$this->event_date = $event_date;
			$this->location = $location;
			$this->background_image = $background_image;
		}

		function get_id(){
    		return $this->eID;
    	}

    	function get_name(){
    		return $this->event_name;
    	}

    	function get_description(){
    		return $this->description;
    	}

    	function get_date_added(){
    		return $this->date_added;
    	}

    	function get_date_event(){
    		return $this->event_date;
    	}

    	function get_location(){
    		return $this->location;
    	}
    	function get_bgImage(){
    		return $this->background_image;
    	}
	}

?>