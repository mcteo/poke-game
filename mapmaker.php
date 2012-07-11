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
        <script type="text/javascript" src="js/mapmaker.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript">
            $(document).ready(function() {

                $("#uploader").hide();
                $("#map_area").hide();
            
                setTimeout(function() {
                    $("#loader").fadeOut();
                }, 1000);

                $("#mapSwitchButton").click(function(e) {

                    var new_map_name = $("#mapSwitchName").val();

                    $.get("maps.php",
                                {
                                    "new_map": new_map_name,
                                    "rand": Math.random().toString()
                                },
                                function(data) {
                                    // success
                                    var res = $.parseJSON(data);

                                    if (res.length == 0) {

                                        $("#upload_msg").css("color", "#ff0000");
                                        $("#upload_msg").text("That map ID doesn't exist, you would to upload it?");
                                        console.log($("#upload_msg"));
                                        $("#uploader").fadeIn();

                                    } else if (res.length == 1) {

                                        // yey, its there
                                        $("#uploader").fadeOut();
                                        $("#map_area").fadeIn();
                                        $("#right_bar").animate({"width": "30%"});
                                    }
                                }
                    );
                });

                $("#uploadForm").ajaxForm({
                    dataType: "json",
                    beforeSubmit: function(a,f,o) {
                        //o.dataType = $("#uploadResponseType")[0].value;
                        $('#upload_msg').html("Uploading...");
                    },
                    success: function(data) {

                                if (data["error"]) {
                                    $("#upload_msg").text("Error: " + data["error"]);
                                } else {
                                    $("#upload_msg").text("Uploaded!");
                                    var path = data["mappath"];

                                    $.post("maps.php",
                                            {
                                                "map_name": $("#mapSwitchName").val(),
                                                "map_path": path,
                                                "rand": Math.random().toString()
                                            },
                                            function(data) {
                                                    console.log(data);
                                            }
                                    ); 

                                }
                            }
                });

            });

            function img_to_canvas(canvas, image_path) {

                //var canvas = document.getElementById(canvas_tag);
                var context = canvas.getContext("2d");
                var img = new Image();
                img.src = image_path;
                img.onload = function() {
                    context.drawImage(img, 0, 0);
                };
            }

            function populate_sidebar(newparent, obj) {
                // iterate through $obj
                // making new (relevent to type) children for $parent
                // assigning known values to newly created children
                // and add a save button
             
                // img_to_canvas($("#map_canvas")[0], path);
            }

        </script>
    </head>
    <body>
        <div id="loader"></div>

        <h1>Map Editor Page</h1>

        <input type="text" id="mapSwitchName" value="Map_PalletTown" />
        <input type="button" id="mapSwitchButton" value="Change Map!" />

        <br /> 
        <br /> 
        <br /> 
        <br /> 
    

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

        <div id="uploader">
            <div id="upload_msg"></div>
            <form id="uploadForm" action="upload_map.php" method="post">
                <label>Map file:</label>
                    <input type="file" value="" name="file" id="file" />
                    <br />
                <input type="submit" value="Upload!" />
            </form>
        </div>

        <div id="map_area">

            <canvas id="map_canvas" style="border: 1px dashed black;" width="640px" height="480px">
                Yo man! yo browser's like prehistoric brah
            </canvas>

        </div>

        <div id="right_bar" style="position: fixed; right: 0; top: 0; height: 100%; width: 0%; background-color: #aaaaaa;">

            

        </div>

    </body>
</html>
<?php
    else:

        print_r($_SERVER);
        // header("Location:");
    endif;
?>
