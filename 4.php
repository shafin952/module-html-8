<?php
require('db.php');
session_start();

if (isset($_POST['submit'])) {

    if (isset($_POST['useremail']) && isset($_POST['userpassword'])) {

            // removes backslashes
            $useremail = stripslashes($_REQUEST['useremail']);
            $userpassword = stripslashes($_REQUEST['userpassword']);

            // escapes special characters in a string
            $useremail = mysqli_real_escape_string($con, $useremail);
            $userpassword = mysqli_real_escape_string($con, $userpassword);
            $hashedPassword = md5($userpassword);

            $query = "SELECT `fname` FROM `users` WHERE `email` = '$useremail' AND `password` = '$hashedPassword'";
            $result = mysqli_query($con, $query);

            $row = mysqli_fetch_array($result);
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $_SESSION['fname'] = $row['fname'];

                // Redirect to user dashboard page
                header("Location: welcome.php");
            } else {
                echo "<div class='form'>
                    <h3>Incorrect Username/password.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                    </div>";
            }

    }
    else {
        echo "Please fill out all the fields for login.\n";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>Login Form</title>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <h1>Login</h1>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="useremail" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="userpassword" id="psw" required>
            <hr>
            <input type="submit" name="submit" value="Login">
        </div>
    </form>
</body>
</html>