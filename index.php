<?php

    session_start();

    include("dbCon.php");
    include("functions.php");

    $userData = check_login($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>

        <style>
            #notDefault{
                padding: 10px;
                background-color: lightblue;
            }

            #bodynotdefault{
                background-color: lightblue;
            }
        </style>
    </head>

    <body id = "bodynotdefault">
        <div id = "notDefault" align = "center">

        <a href = "logout.php">Log out</a>
        <h1>Welcome to the Home page of this site.</h1><br>

        Hello, <?php echo $userData['username']; ?>.<br>

        <br><br><br>
        <a href = "view.php">View all Users</a>

        <br><br>
        <a href = "edit.php">Edit a user</a>

        <br><br>
        <a href = "delete.php">Delete a user</a>

        <br><br>
        <p>Please note, editing the Username currently logged in will kick you out of the session.</p>
        <P>The same would apply when deleting a user.</p>

    </div>
    </body>
</html>