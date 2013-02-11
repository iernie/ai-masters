<?php

    class Project {
        public $name = "";
        public $participants = "";
        public $description = "";
    }

    $action = $_POST['action'];

    if ($action == "add") {
        add();
    } 
    if ($action == "get") {
        get();
    }

    function add() {
        $name = $_POST['name'];
        $participants = $_POST['participants'];
        $description = $_POST['description'];

        $fh = fopen("projects.txt", 'a') or die("can't open file");

        fwrite($fh, $name . ";" . $participants . ";" . $description . "\n");
        fclose($fh);

        echo json_encode(True);
    }

    function get() {
        $fh = implode('', file("projects.txt"));

        if (empty($fh)) {
            echo "No projects";
        } else {
            $projects = array();

            foreach(array($fh) as $line) {
                $split = explode(';', $line)

                $project = new Project();
                $project->name = $split[0];
                $project->participants = $split[1];
                $project->description = $split[2];

                array_push($projects, json_encode($project));
            }

            echo json_encode($projects);
        }
    }
?>