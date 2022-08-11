<?php

session_start();
    
include("dbCon.php");
include("functions.php");   

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password))
    {
        $query = "SELECT * from users where username = '$username' limit 1";

        $result = mysqli_query($conn, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {  
                $userData = mysqli_fetch_assoc($result);

                if($userData['password'] === $password)
                {
                    $_SESSION['username'] = $userData['username'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "Wrong Username or password! Ensure that you are registered with us before loggin in!";
    }else{
        echo "Please enter valid information!";
    }
}
    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>

    <body>
        <style type = "text/css">
            #text{
                height: 25px;
                border-radius: 5px;
                padding: 5px;
                border: solid thin;
                width: 100px;
            }

            #button{
                padding: 10px;
                width: 100px;
                color: white;
                background-color: blue;
                border: none;
            }

            #box{
                background-color: lightgrey;
                margin: auto;
                width: 300px;
                padding: 20px;
            }
        </style>

        <div id = "box">
            <form method = "POST">

                <div style = "font-size: 20px;margin: 10px; color: black;">Login</div><br>

                <label for = "username">Username:</label><br>
                <input type = "text" name = "username"><br><br>

                <label for = "password">Password:</label><br>
                <input type = "password" name = "password"><br><br>

                <input id = "button" type = "submit" value = "Login"><br><br>

                <a href = "register.php">Click here to Register</a><br><br>

                <a href = "forgotPassword.php">Forgot Password?</a>
            </form>
        </div>

    </body>
</html>