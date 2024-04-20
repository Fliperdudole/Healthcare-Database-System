<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
</head>
<body>
    <h1>Add New Patient (Basic Information)</h1>
    <form id="form" method="post" action="add_patient.php">
        <!-- Input fields for patient information -->
        First Name: <input type="text" name="fname"><br><br>
        Middle Initial: <input type="text" name="minit"><br><br>
        Last Name: <input type="text" name="lname"><br><br>
        SSN: <input type="text" name="ssn"><br><br>
        Birthday: <input type="date" name="bdate"><br><br>
        Email: <input type="email" name="email"><br><br>
        Address: <input type="text" name="address"><br><br>
        City: <input type="text" name="city"><br><br>
        State: <input type="text" name="state"><br><br>
        Zip Code: <input type="text" name="zipcode"><br><br>
        Sex: <input type="text" name="sex"><br><br>
        Insurance ID (Number): <input type="text" name="insurance_id"><br><br>
        Insurance Name: <input type="text" name="insurance_name"><br><br>
        Coverage Start: <input type="date" name="coverage_start"><br><br>
        Coverage End: <input type="date" name="coverage_end"><br><br>
        Policy Number: <input type="text" name="policy_number"><br><br>
        Physician Name: <input type="text" name="physician_name"><br><br>

        <input type="submit" name="submit" value="Add Patient">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "healthcare";

        // Create connection
        $conn = new mysqli($server, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $fname = $_POST["fname"];
        $minit = $_POST["minit"];
        $lname = $_POST["lname"];
        $ssn = $_POST["ssn"];
        $bdate = $_POST["bdate"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $zipcode = $_POST["zipcode"];
        $sex = $_POST["sex"];
        $insurance_id = $_POST["insurance_id"];
        $physician_name = $_POST["physician_name"];
        $insurance_name = $_POST["insurance_name"];
        $coverage_start = $_POST["coverage_start"];
        $coverage_end = $_POST["coverage_end"];
        $policy_number = $_POST["policy_number"];

        // SQL statement to insert insurance information into the INSURANCE table
        $sql_insurance = "INSERT INTO INSURANCE (Inumber, Iname, CoverageStart, CoverageEnd, PolicyNumber) VALUES ('$insurance_id', '$insurance_name', '$coverage_start', '$coverage_end', '$policy_number')";

        if ($conn->query($sql_insurance) === TRUE) {
            // SQL statement to insert patient information into the PATIENT table
            $sql_patient = "INSERT INTO PATIENT (Fname, Minit, Lname, Ssn, BDate, Email, Address, City, State, ZipCode, Sex, InsuranceID, PhysicianName) 
                            VALUES ('$fname', '$minit', '$lname', '$ssn', '$bdate', '$email', '$address', '$city', '$state', '$zipcode', '$sex', '$insurance_id', '$physician_name')";

            if ($conn->query($sql_patient) === TRUE) {
                echo "New patient record created successfully";
            } else {
                echo "Error: " . $sql_patient . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_insurance . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
