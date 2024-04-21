<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="Change_Identification.css">
</head>
<body>
    <h1>Change Username and Password</h1>
    
    <form method="post">
        Date of Birth: <input type="date" name="dob"><br>
        Social Security Number: <input type="text" name="ssn"><br>
        New Username: <input type="text" name="new_user"><br>
        New Password: <input type="password" name="new_pass"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
        // Database connection
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

        if(isset($_POST['submit'])) {
            $dob = $_POST['dob'];
            $ssn = $_POST['ssn'];
            $new_user = $_POST['new_user'];
            $new_pass = $_POST['new_pass'];

            // Check if the provided Date of Birth and Social Security Number exist in the database
            $sql = "SELECT * FROM patient WHERE Bdate = '$dob' AND Ssn = '$ssn'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Update username and password
                $sql_update = "UPDATE patientlogin SET username = '$new_user', password = '$new_pass' WHERE ssn = '$ssn'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Username and password updated successfully.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Date of Birth and/or Social Security Number incorrect.";
            }
        }

        // Close connection
        $conn->close();
    ?>

    <br>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.location.href = "patient_signin.html";
        }
    </script>
</body>
</html>
