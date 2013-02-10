<?php

	$action = $_POST['action'];

	init();
	if($action == "add") {
		add();
	} elseif ($action == "get") {
		get();
	}
	close_db();

	function init() {
		$db = new PDO('sqlite:projects.sqlite3');
		$db->exec("CREATE TABLE IF NOT EXISTS projects (
                    id INTEGER PRIMARY KEY, 
                    name TEXT, 
                    participants TEXT, 
                    description TEXT)");
	}

	function add() {
		$insert = "INSERT INTO projects (name, participants, description) 
                VALUES (:name, :participants, :description)";
	    
	    $stmt = $db->prepare($insert);
	 
	    $stmt->bindParam(':name', $name);
	    $stmt->bindParam(':participants', $participants);
	    $stmt->bindParam(':description', $description);

		$title = $_POST['name'];
		$message = $_POST['participants'];
		$time = $_POST['description'];

		$stmt->execute();
		return json_encode(true);
	}

	function get() {
		$select = "SELECT * FROM projects";

		$stmt = $db->prepare($select);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($results);
	}

	function close_db() {
		$db = null; 
	}
?>