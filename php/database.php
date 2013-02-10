<?php

    try {
        $db = new PDO('sqlite:projects.db');
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $db->exec("CREATE TABLE IF NOT EXISTS projects (
                    id INTEGER PRIMARY KEY,
                    name TEXT,
                    participants TEXT,
                    description TEXT)");
    } catch(PDOException $e) {  
        echo "I'm sorry, Dave. I'm afraid I can't do that.";  
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
    }

    $action = $_POST['action'];

    if($action == "add") {
        add();
    } 
    if($action == "get") {
        get();
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

    $db = null; 
?>