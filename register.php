<?php

    session_start();
    
    include("dbCon.php");
    include("functions.php");  

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\composer\vendor\autoload.php';

    $mail = new PHPMailer(TRUE);
    

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(!empty($username) && !empty($password)  && !empty($email))
        {

            if($statement = $conn->prepare('SELECT id password FROM users where username = ?'))
            {
                $statement->bind_param('s',$_POST['username']);
                $statement->execute();
                $statement->store_result();
        
                if($statement->num_rows > 0)
                {
                    echo 'Username already exists. Try Again';
                }else{
            
            $query = "INSERT into users (username,password,email) values ('$username','$password','$email')";

            $insertQuery = mysqli_query($conn, $query);
            

            if($insertQuery)
            {
                /*$to = $email;
                $subject = "Email Registration Success";
                $message = "You have successfully registered your account on the test website and Welcome!";
                $headers = "From: phpjobtask@yahoo.com \r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to,$subject,$message,$headers);*/

                $mail->setFrom('phpjobtask@gmail.com');
                $mail->addAddress($email);
                $mail->Subject = 'Email Registration Success';
                $mail->Body = 'You have successfully registered your account on the test website and Welcome!';

                $mail->isSMTP();

                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'phpjobtask@gmail.com';
                $mail->Password = 'tzgltvaeaukbcnsc';
                $mail->Port = 587;

                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                 );

                $mailSent = $mail->send();

                if($mailSent)
                {
                    header("Location: login.php");
                    die;
                }
            }
            }
        }else{
            echo "Please enter valid information!";
        }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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

                <div style = "font-size: 20px;margin: 10px; color: black;">Registration form</div><br>

                <label for = "username">Username:</label><br>
                <input type = "text" name = "username"><br><br>

                <label for = "password">Password:</label><br>
                <input type = "password" name = "password"><br><br>

                <label for = "email">Email:</label><br>
                <input type = "text" name = "email"><br><br>

                <input id = "button" type = "submit" value = "Register"><br><br>

                <a href = "login.php">Click here to Login</a><br><br>
            </form>
        </div>

    </body>
</html>