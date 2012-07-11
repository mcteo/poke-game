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
            "mapID" => $map_name,
            "imagePath" => $map_path,
            "noWalkArea" => array(),
            "eventList" => array(),
        );

        $cursor = $collection->insert($obj);

        echo json_encode("insert", $obj);
    }


    /*
        Here I define my "schema",

        mapID: (string) a unique identifer for map
        imagePath: (string) relative path to the image file
        noWalkArea: (Array of TRect) list of rectangles thare are not walkable
        eventList: (Array of TEvent) list of anything that triggers interaction
    
        A TRect being 4 float array (e.g. x1, y1, x2, y2)
        A TEvent is an basically an associative array/object:
            type: (string) sign, border, portal, etc (cant think of others)
            position: (TRect) the events position
            data: (TVarient) any addition info, (differs by type)
                    so like a sign would have contents of sign here
                    and a portal would have mapID of linking portal here


        border is a passive threshold, like  between routes,
        portal is like a door, requiring interation
        (should i do it this way, or leave everything like portals)

    */
?>
