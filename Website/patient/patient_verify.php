<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "healthcare";

    $conn = new mysqli($server, $username, $password, $dbname);

    // Check if form data is received
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data based on name keys
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        
        // Do whatever processing you need with $user and $pass

        // Initialize query
        $sql = "SELECT * 
            FROM patientlogin 
            WHERE username = '$user' AND password = '$pass'";

        // Run query
        $result = mysqli_query($conn, $sql);

        // Check for valid patient login (something was returned from query)
        // Echo back a response, this will be stored in xhr.responseText (in onload in Patient.js file)
        if (mysqli_num_rows($result) > 0) {
            echo "valid";            
        }
        else {
            echo "invalid";
        }

    } else {
        // If not received through POST method, handle the case accordingly
        echo "Form data not received.";
    }

    mysqli_close($conn);

?>