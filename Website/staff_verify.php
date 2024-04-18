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

        // Echo back a response, this will be stored in xhr.responseText (in onload in Patient.js file)
        // echo "Username: $user<br>Password: $pass<br>User Type: ";

        // Initialize query
        $sql = "SELECT * 
        FROM stafflogin 
        WHERE username = '$user' AND password = '$pass'";

        // Run Query
        $result = mysqli_query($conn, $sql);

        // Check for valid patient login (something was returned)
        if (mysqli_num_rows($result) > 0) {
            header("Location: staff_service.php");
            exit; 
        }
        else {
            echo "Invalid Username or Password";
        }

    } else {
        // If not received through POST method, handle the case accordingly
        echo "Form data not received.";
    }

    mysqli_close($conn);
?>