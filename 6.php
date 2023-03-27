<!-- 
    --------------- Please run below commands for running the project successfully ---------------
CREATE DATABASE loginsystem;
CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `fname` varchar(250) NOT NULL,
 `lname` varchar(250) NOT NULL,
 `email` varchar(250) NOT NULL,
 `password` varchar(250) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);
-->

<?php
require('db.php');

if (isset($_POST['submit'])) {
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['userpassword_repeat'])) {

        if ($_POST['userpassword'] != $_POST['userpassword_repeat']) {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("The password and password confirmation must match.")';  
            echo '</script>'; 
        } else {
            // removes backslashes
            $fname = stripslashes($_REQUEST['fname']);
            $lname = stripslashes($_REQUEST['lname']);
            $useremail = stripslashes($_REQUEST['useremail']);
            $userpassword = stripslashes($_REQUEST['userpassword']);

            // escapes special characters in a string
            $fname = mysqli_real_escape_string($con, $fname);
            $lname = mysqli_real_escape_string($con, $lname);
            $useremail = mysqli_real_escape_string($con, $useremail);
            $userpassword = mysqli_real_escape_string($con, $userpassword);
            $hashedPassword = md5($userpassword);

            $create_datetime = date("Y-m-d H:i:s");
            $query    = "INSERT into `users` (`fname`, `lname`, `password`, `email`, create_datetime)
                        VALUES ('$fname', '$lname', '$hashedPassword', '$useremail', '$create_datetime')";

            $result   = mysqli_query($con, $query);


            if ($result) {
                echo "<div class='form'>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='registrationForm.php'>registration</a> again.</p>
                      </div>";
            }
        }
    }
    else {
        echo "Please fill out all the fields.\n";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>Registration Form</title>
</head>
<body>

    <form action="" method="POST">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="first_name"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="first_name" required>

            <label for="last_name"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id="last_name" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="useremail" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="userpassword" id="psw" required>

            <label for="psw-repeat"><b>Confirm Password</b></label>
            <input type="password" placeholder="Repeat Password" name="userpassword_repeat" id="psw-repeat" required>
            <hr>

            <input type="submit" name="submit" value="Register">
        </div>
    
        <div class="container signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
    </form>

</body>
</html>