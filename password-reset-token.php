<?php

    include("dbCon.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\composer\vendor\autoload.php';

    $mail = new PHPMailer(TRUE);

    if(isset($_POST['password-reset-token']) && ($_POST['email']))
    {
        $email = $_POST['email'];

        $details = "SELECT * from users where email = '$email'";
        $resetDetails = mysqli_query($conn,$details);

        $row = mysqli_fetch_assoc($resetDetails);

        if($row)
        {
            $token = md5($email).rand(10,9999);

            $expireFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));

            $expireDate = date("Y-m-d H:i:s", $expireFormat);


            $updatePassword = "UPDATE users set reset_link_token = '$token', exp_date = '$expireDate' where email = '$email'";
            $updatingPassword = mysqli_query($conn,$updatePassword);

            $link = "<a href = 'localhost/phpLogin/reset-password.php?key=".$email." &token= ".$token."'>Click to reset password</a>";

            $mail->setFrom('phpjobtask@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'Email Password Reset';
            $mail->IsHTML(true);
            $mail->Body = "<a href = 'http://localhost/phpLogin/reset-password.php?key=$email&token=$token'>Click here to reset password</a>";

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
                echo "Mail sent \r\n";
                echo "<a href = 'login.php'>Go back to Login Page</a>";
            }else{
                echo "Invalid information, please try again!";
            }
        }
    }

?>