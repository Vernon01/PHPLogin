<?php

    session_start();

    include("dbCon.php");
    include("functions.php");

    $userData = check_login($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete</title>
    </head>
    <body style = "background-color:lightblue;">

        <form action = "delete.php" method = "get" enctype = "multipart/form-data">

        <h1>Search by email to delete a user</h1>
        <a href = "index.php">Home Page</a><br><br>

        <label for = "search">Search</label>
        <input type = "text" name = "searchEmail" style = "width:300px;"/>
        <input type = "submit" name = "getData" value = "GET"/>

        <br><br>

        </form>

        <?php

            if(isset($_GET['getData']))
            {
                $searchEmail = $_GET['searchEmail'];

                $getUser = "SELECT * from users where email = '$searchEmail' limit 1";
                $deleteResult = mysqli_query($conn,$getUser);

                if($deleteResult->num_rows != 0)
                {?>
                    </form>
                    <form method = "post" enctype = "multipart/form-data">
                        
                <table style = "width:auto;border: solid;">
                    <thead>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </thead>


                <?php    while($rowEmails = $deleteResult->fetch_assoc())
                    { ?>
                        
                        <tr>
                        <?php echo '<td><input type = "text" name = "idValue" value = "'.$rowEmails['id'].'" style = "width:20px;" readonly></td>';?>
                        <?php echo '<td><input type = "text" name = "username" value = "'.$rowEmails['username'].'"  style = "width:300px;"></td>';?>
                        <?php echo '<td><input type = "text" name = "email" value = "'.$rowEmails['email'].'"  style = "width:300px;"></td>';?>
                        </tr>

                    <?php
                    } 
                    ?></table>

                    <input type = "submit" value = "Delete" name = "DeleteNow"/>

                    <?php
                }else{
                    echo "No result for the email, please try again";
                }
            }

            if(isset($_POST['DeleteNow']))
            {
                $idValue = $_POST['idValue'];
                $username = $_POST['username'];
                $email = $_POST['email'];

                $deleteValue = "DELETE from users where id = '$idValue' and username = '$username' and email = '$email'";
                $deleteValues = mysqli_query($conn,$deleteValue);

                if($deleteValues)
                {
                    header("Location: index.php");
                    die;
                }

            }
        ?>

    </body>
</html>