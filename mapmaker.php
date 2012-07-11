<?php
    session_start();

    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == True):
?>
<!doctype html>
<html>
    <head>
        <title>
            Pokemon Game
        </title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="js/PxLoader.js"></script>
        <script type="text/javascript" src="js/PxLoaderImage.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <div id="loader"></div>
        <div id="page">
            This is the main page...
        </div>

<?php

    // heres a little idea about workflow
    // the page opens here, if $_SESSION["logged_in"]
    // submit mapID ayncly
    // if mapID doesnt exist in mongo,
    //     open the form upload part
    //     if valid:
    //         make new entry in mongo for mapID
    // so now we have a valid image, and valid mongodb entry
    // load all existing content for mapID
    // now allow user to edit it to their hearts content
    // save changes back to mongo

?>

        <form id="uploadForm" action="upload_map.php" method="post">
            <label>Map file:</label>
                <input type="file" value="" name="file" id="file" />
                <br />
            <input type="submit" value="Upload!" />
        </form>



    </body>
</html>
<?php
    else:

        print_r($_SERVER);
        // header("Location:");
    endif;
?>
