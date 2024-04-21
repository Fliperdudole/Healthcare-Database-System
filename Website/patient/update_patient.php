<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <link rel="stylesheet" type="text/css" href="update_patient.css">
</head>
<body>
    <h1>Update Patient Information</h1>
    <form method="post">
        First Name: <input type="text" name="first_name"><br><br>
        Last Name: <input type="text" name="last_name"><br><br>
        SSN: <input type="text" name="ssn"><br><br>
        Date of Birth: <input type="date" name="bdate"><br><br>
        Gender: 
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>
        Email: <input type="email" name="email"><br><br>
        Address: <input type="text" name="address"><br><br>
        City: <input type="text" name="city"><br><br>
        State: <input type="text" name="state"><br><br>
        ZIP Code: <input type="text" name="zip_code"><br><br>
        <input type="submit" name="submit" value="Update">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "healthcare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
            $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : '';
            $ssn = isset($_POST["ssn"]) ? $_POST["ssn"] : '';
            $bdate = isset($_POST["bdate"]) ? $_POST["bdate"] : '';
            $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
            $email = isset($_POST["email"]) ? $_POST["email"] : '';
            $address = isset($_POST["address"]) ? $_POST["address"] : '';
            $city = isset($_POST["city"]) ? $_POST["city"] : '';
            $state = isset($_POST["state"]) ? $_POST["state"] : '';
            $zip_code = isset($_POST["zip_code"]) ? $_POST["zip_code"] : '';

            $sql_check = "SELECT * FROM patient WHERE Fname = '$first_name' AND Lname = '$last_name' AND Ssn = '$ssn'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                $sql = "UPDATE patient 
                        SET Fname='$first_name', 
                            Lname='$last_name', 
                            Bdate='$bdate', 
                            Sex='$gender', 
                            Email='$email', 
                            Address='$address', 
                            City='$city', 
                            State='$state', 
                            ZipCode='$zip_code' 
                        WHERE Ssn='$ssn'";

                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Invalid input";
            }

            $conn->close();
        }
    ?>
</body>
</html>
