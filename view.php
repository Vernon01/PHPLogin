<?php

    session_start();

    include("dbCon.php");
    include("functions.php");

    $userData = check_login($conn);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>View</title>
    </head>

    <body style = "background-color:lightblue;">
I am assuming you want to see a return of all the users added.<br><br>

<a href = "index.php">Home Page</a><br><br>

<?php

    $userList = "SELECT * from users";
    $resultUsers = mysqli_query($conn,$userList);

    if($resultUsers->num_rows != 0)
    { ?>
        <table style = "width:400px;border:solid 3px;background-color:lightgrey;">
        <thead>
            <th align = "left">Username</th>
            <th align = "right">Email</th>
        </thead>

        <?php
        while($rowResult = $resultUsers->fetch_assoc())
        {?>

            <tr>
                <td align = "left" style = "width:400px;border:solid 1px;"><?php echo $rowResult['username']; ?></td>
                <td align = "right" style = "width:400px;border:solid 1px;"><?php echo $rowResult['email']; ?></td>
            </tr>

      <?php }
        ?>

      </table>

    <?php
    }

?>
</body>
</html>