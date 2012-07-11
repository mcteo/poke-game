<?php                 

    $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
    if (!$xhr)  
        echo '<textarea>'; 

    // main content of response here 

    $MAX_SIZE = 40000;

    $UPLOAD_DIR = "uploads/";

    if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < $MAX_SIZE)) {
        if ($_FILES["file"]["error"] > 0) {        
        
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {

            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            if (file_exists($UPLOAD_DIR . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $UPLOAD_DIR . $_FILES["file"]["name"]);
                echo "Stored in: " . $UPLOAD_DIR . $_FILES["file"]["name"];
            }
        }
    } else {
        echo "Invalid file";
    }

    if (!$xhr)   
        echo '</textarea>'; 

?> 
