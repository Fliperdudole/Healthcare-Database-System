<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "healthcare";

    $conn = new mysqli($server, $username, $password, $dbname);

    // Check if form data is received
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
    } else {
        // If not received through POST method, handle the case accordingly
        echo "Form data not received.";
    }

    mysqli_close($conn);
?>