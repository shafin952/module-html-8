<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <div class="form">
        <h1>Hey, <?php echo $_SESSION['fname']; ?>!</h1>
        <h2>You are now user dashboard page.</h2>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>