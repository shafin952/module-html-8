<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "loginSystem";
    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>