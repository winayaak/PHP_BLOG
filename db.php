<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        echo("Not connected");
    }
    else {
        echo("");
    }

    session_start();
        
    
    ?>