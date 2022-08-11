<?php

    include("dbCon.php");
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
    </head>
    <body>

        Reset Password 

        <?php

            if($_GET['key'] && $_GET['token'])
            {
                $email = $_GET['key'];
                $token = $_GET['token'];

                $passwordData = "SELECT * from users where reset_link_token = '$token' and email = '$email'";
                $getPasswordData = mysqli_query($conn,$passwordData);

                $currentDate = date("Y-m-d H:i:s");

                if($getPasswordData->num_rows > 0)
                {
                    $row = mysqli_fetch_assoc($getPasswordData);

                    if($row['exp_date']>=$currentDate)
                    { ?>

                        <form action = "update-forget-password.php" method = "post">

                            <input type = "hidden" name = "email" value = "<?php echo $email; ?>">
                            <input type = "hidden" name = "reset_link_token" value = "<?php echo $token; ?>"><br><br>

                            <lable for = "password">Enter new password:</label>
                            <input type = "password" name = "password"><br><br>

                            <input type = "submit" name = "newPass">

                        </form>

                 <?php }else{
                    ?> <h3>This link has expired</h3>
                    <?php
                 }
                }
            }

        ?>

    </body>
</html>