<?php                 

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
        $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
        if (!$xhr)  
            echo '<textarea>'; 
    }

    // main content of response here 

    $MAX_SIZE = 40000;

    $UPLOAD_DIR = "uploads/";

    if (isset($_FILES["file"])) {

        if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < $MAX_SIZE)) {
            if ($_FILES["file"]["error"] > 0) {        
            
                echo json_encode(array("error" => $_FILES["file"]["error"]));
            } else {

                //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                //echo "Type: " . $_FILES["file"]["type"] . "<br />";
                //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                if (file_exists($UPLOAD_DIR . $_FILES["file"]["name"])) {
                    echo json_encode(array("error" => $_FILES["file"]["name"] . " already exists."));
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $UPLOAD_DIR . $_FILES["file"]["name"]);
                    echo json_encode(array("mappath" => $UPLOAD_DIR . $_FILES["file"]["name"]));
                }
            }
        } else {
            echo json_encode(array("error" => "Invalid file"));
        }
    } else {
        echo json_encode(array("error" => "No file submitted"));
    }

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
        if (!$xhr)   
            echo '</textarea>'; 
    }

?> 
