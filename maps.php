<?php

    session_start();

    $m = new Mongo();
    $db = $m->pokegame;

    if (isset($_GET["new_map"])) {

        // collection is really a table...
        $collection = $db->maps;

        //$obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
        //$collection->insert($obj);

        // thank you schema-less-ness

        //$obj = array( "title" => "XKCD", "online" => true );
        //$collection->insert($obj);

        $map_name = (string)$_GET["new_map"];
        $cursor = $collection->find(array("mapID" => $map_name));
        echo json_encode(iterator_to_array($cursor));

        // iterate through the results
        //foreach ($cursor as $obj) {
        //    echo $obj["title"] . "<br />\n";
        //}
    } elseif (isset($_POST["map_path"])) {

        $collection = $db->maps;
        $map_path = (string)$_POST["map_path"];
        $map_name = (string)$_POST["map_name"];

        $obj = array(
            
            "" => "",
        )

        $cursor = $collection->find(array("mapID" => $map_name));
    }


    /*
        Here I define my "schema",

        mapID: 


    */
?>
