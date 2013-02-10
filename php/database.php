<?php

    try {
        $dbh = new PDO('sqlite:../projects.sqlite');
        $dbh->exec("CREATE TABLE IF NOT EXISTS projects (
                    id INTEGER PRIMARY KEY,
                    name TEXT,
                    participants TEXT,
                    description TEXT)");
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(PDOException $e) {  
        echo "I'm sorry, Dave. I'm afraid I can't do that: " . $e->getMessage();  
    }

    $action = $_POST['action'];

    if($action == "add") {
        add();
    } 
    if($action == "get") {
        get();
    }

    function add() {
        global $dbh;

        $name = $_POST['name'];
        $participants = $_POST['participants'];
        $description = $_POST['description'];

        $stmt = $dbh->prepare("INSERT INTO projects (name, participants, description) VALUES (:pname, :ppart, :pdesc)");

        $stmt->bindParam(':pname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':ppart', $participants, PDO::PARAM_STR);
        $stmt->bindParam(':pdesc', $description, PDO::PARAM_STR);
        try {
            $stmt->execute(); 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        echo json_encode(True);
    }

    function get() {
        global $dbh;

        $stmt = $dbh->prepare("SELECT * FROM projects");

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    }

    $dbh = null; 
?>