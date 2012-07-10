<!doctype html>
<html>
    <head>
        <title>
            Pokemon Game
        </title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="js/PxLoader.js"></script>
        <script type="text/javascript" src="js/PxLoaderImage.js"></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/jqtransform.css" />
    </head>
    <body>
        <div id="loader"></div>

        <div id="page">
            This is the main page...
        </div>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="rowElem">
                <label >Username:</label>
                <input type="text" value="username" name="user" id="user" />
            </div>
            <div class="rowElem">
                <label>Password:</label>
                <input type="password" value="12345678" name="pass" id="pass" />
            </div>
            <div class="rowElem">
                <input type="submit" value="Login!" />
            </div>
        </form>

    </body>
</html>
