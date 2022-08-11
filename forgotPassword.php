<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password</title>
    </head>
    <body>

    <div class = "container" style = "align:center;">

    <h2>Enter username and email to reset your password.</h2>

    <form action = "password-reset-token.php" method = "post">

    <a href = "login.php">Click here to go Back to Login Page</a><br><br>


    <label> Email</label>
    <input type = "text" name = "email"><br><br>

    <input type = "submit" name = "password-reset-token" value = "Reset Password">

    </form>

    </div>

    </body>
</html>