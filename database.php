<?php

	$action = $_POST['action'];

	if($action == "add") {
		add();
	} elseif ($action == "get") {
		get();
	}

	function init() {
		$db = new PDO('sqlite:projects.db');
		$db->exec("CREATE TABLE IF NOT EXISTS projects (
                    id INTEGER PRIMARY KEY,
                    name TEXT,
                    participants TEXT,
                    description TEXT)");
	}

	function add() {
		init();
		$insert = "INSERT INTO projects (name, participants, description) 
                VALUES (:name, :participants, :description)";
	    
	    $stmt = $db->prepare($insert);
	 
	    $stmt->bindParam(':name', $name);
	    $stmt->bindParam(':participants', $participants);
	    $stmt->bindParam(':description', $description);

		$name = $_POST['name'];
		$participants = $_POST['participants'];
		$description = $_POST['description'];

		$stmt->execute();
		close_db();
		return json_encode("get_return");
	}

	function get() {
		init();
		$select = "SELECT * FROM projects";

		$stmt = $db->prepare($select);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		close_db();
		return json_encode("add_return");
	}

	function close_db() {
		$db = null; 
	}
?>