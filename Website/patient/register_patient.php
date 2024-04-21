<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register_patient.css">
</head>
<body>
    <h1>Register as new Patient!</h1>
    
    <form method="post">
        First Name: <input type="text" name="first_name"><br>
        Last Name: <input type="text" name="last_name"><br>
        SSN: <input type="text" name="ssn"><br>
        New Username: <input type="text" name="new_user"><br>
        New Password: <input type="password" name="new_pass"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "healthcare";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $ssn = $_POST['ssn'];
        $new_user = $_POST['new_user'];
        $new_pass = $_POST['new_pass'];

        // Check if the provided First Name, Last Name, and SSN exist in the patient table
        $sql = "SELECT * FROM patient WHERE Fname = '$first_name' AND Lname = '$last_name' AND Ssn = '$ssn'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Update username and password in the patientlogin table
            $sql_update = "INSERT INTO patientlogin (Username, Password, Ssn) VALUES ('$new_user', '$new_pass', '$ssn')";
            if ($conn->query($sql_update) === TRUE) {
                echo "Username and password updated successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "First Name, Last Name, and/or SSN incorrect.";
        }

        $conn->close();
    }
    ?>
</body>
</html>
