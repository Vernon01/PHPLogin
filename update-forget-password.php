<?php

    include("dbCon.php");

    if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
    {
        $email = $_POST['email'];
        $token = $_POST['reset_link_token'];
        $password = $_POST['password'];

        $getUser = "select * from users where email = '$email' and reset_link_token = '$token'";
        $gettingUser = mysqli_query($conn,$getUser);

        $row = mysqli_num_rows($gettingUser);

        if($row)
        {
            $updatePass = "update users set password = '$password', reset_link_token = '.NULL', exp_date = '.NULL.' where email = '$email'";
            $updatingPass = mysqli_query($conn,$updatePass);

            echo "<p>Your password has been changed, you may go login!</p>";
            echo "<a href = 'Login.php'>Login Page</a>";
        }else{
            echo "<p>Oops, something went wrong, please try again.</p>";
        }
    }

?>