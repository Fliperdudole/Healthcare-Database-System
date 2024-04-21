<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" type="text/css" href="staff_service.css">
    <button onclick="window.location.href = 'add_patient.php';">Add New Patient</button><br>
    <button onclick="window.location.href = 'bill_patient.php';">Bill Patient</button><br><br>
</head>
<body>
<h1>Access Patient Info</h1>
    <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Enter SSN: <input type="text" name="ssn"><br><br>

        What would you like to access:<br>
        <input type="checkbox" name="patientdata[]" value="billing"> Billing<br>
        <input type="checkbox" name="patientdata[]" value="procedures"> Procedures<br>
        <input type="checkbox" name="patientdata[]" value="insurance"> Insurance Info<br>
        <input type="checkbox" name="patientdata[]" value="personal"> Personal Info<br><br>

        <input type="submit" name="submit" value="Find Information">
    </form>

    <?php
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

    // Check if form data is received
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $ssn = $_POST["ssn"];

        echo "<h2>Staff Information</h2>";

        // Check if SSN is provided
        if ($ssn != NULL) {
            echo "<table>";
            foreach ($_POST['patientdata'] as $selection) {
                // Evaluate based on chosen checkboxes
                if ($selection == "billing") {
                    echo "<tr><th colspan='2'>Billing Information</th></tr>";
                    // SQL query
                    $sql = "SELECT * FROM billing WHERE PatientSsn = '$ssn'";
                    // Run query
                    $result = mysqli_query($conn, $sql);
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>Billing ID</td><td>" . $row["BillingID"] . "</td></tr>";
                            echo "<tr><td>Billed Amount</td><td>" . $row["BilledAmount"] . "</td></tr>";
                            echo "<tr><td>Billing Description</td><td>" . $row["BillingDescription"] . "</td></tr>";
                            echo "<tr><td>Insurance Payment</td><td>" . $row["InsurancePayment"] . "</td></tr>";
                            echo "<tr><td>Patient Payment</td><td>" . $row["PatientPayment"] . "</td></tr>";
                            echo "<tr><td>Bill Date</td><td>" . $row["BillDate"] . "</td></tr>";
                            echo "<tr><td>Procedure Code</td><td>" . $row["ProcedureCode"] . "</td></tr>";
                            echo "<tr><td>Patient SSN</td><td>" . $row["PatientSsn"] . "</td></tr>";
                            echo "<tr><td>Insurance Number</td><td>" . $row["InsuranceNo"] . "</td></tr>";

                        }
                    } else {
                        echo "<tr><td colspan='2'>No billing info found for the provided SSN.</td></tr>";
                    }
                } elseif ($selection == "procedures") {
                    echo "<tr><th colspan='2'>Procedure Information</th></tr>";
                    // SQL query
                    $sql = "SELECT P.* FROM PROCEDURES P JOIN BILLING B ON P.Pcode = B.ProcedureCode JOIN PATIENT PT ON B.PatientSsn = PT.Ssn WHERE PT.Ssn = '$ssn'";
                    // Run query
                    $result = mysqli_query($conn, $sql);
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>Procedure Name</td><td>" . $row["Pname"] . "</td></tr>";
                            echo "<tr><td>Procedure Code</td><td>" . $row["Pcode"] . "</td></tr>";
                            echo "<tr><td>Procedure Location</td><td>" . $row["Plocation"] . "</td></tr>";
                            echo "<tr><td>Procedure Date</td><td>" . $row["Pdate"] . "</td></tr>";
                            echo "<tr><td>Procedure Description</td><td>" . $row["PDescription"] . "</td></tr>";

                        }
                    } else {
                        echo "<tr><td colspan='2'>No procedures provided for the SSN.</td></tr>";
                    }
                } elseif ($selection == "personal") {
                    echo "<tr><th colspan='2'>Personal Information</th></tr>";
                    // SQL query
                    $sql = "SELECT * FROM patient WHERE Ssn = '$ssn'";
                    // Run query
                    $result = mysqli_query($conn, $sql);
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>First Name</td><td>" . $row["Fname"] . "</td></tr>";
                            echo "<tr><td>Middle Initial</td><td>" . $row["Minit"] . "</td></tr>";
                            echo "<tr><td>Last Name</td><td>" . $row["Lname"] . "</td></tr>";
                            echo "<tr><td>SSN</td><td>" . $row["Ssn"] . "</td></tr>";
                            echo "<tr><td>Birthday</td><td>" . $row["BDate"] . "</td></tr>";
                            echo "<tr><td>Email</td><td>" . $row["Email"] . "</td></tr>";
                            echo "<tr><td>Address</td><td>" . $row["Address"] . "</td></tr>";
                            echo "<tr><td>City</td><td>" . $row["City"] . "</td></tr>";
                            echo "<tr><td>State</td><td>" . $row["State"] . "</td></tr>";
                            echo "<tr><td>ZipCode</td><td>" . $row["ZipCode"] . "</td></tr>";
                            echo "<tr><td>Sex</td><td>" . $row["Sex"] . "</td></tr>";
                            echo "<tr><td>Insurance ID</td><td>" . $row["InsuranceID"] . "</td></tr>";
                            echo "<tr><td>Physician Name</td><td>" . $row["PhysicianName"] . "</td></tr>";

                        }
                    } else {
                        echo "<tr><td colspan='2'>No personal information provided for the SSN.</td></tr>";
                    }
                } elseif ($selection == "insurance") {
                    echo "<tr><th colspan='2'>Insurance Information</th></tr>";
                    // SQL query
                    $sql = "SELECT I.* FROM INSURANCE I JOIN PATIENT P ON I.Inumber = P.InsuranceID WHERE P.Ssn = '$ssn'";
                    // Run query
                    $result = mysqli_query($conn, $sql);
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>Insurance Number</td><td>" . $row["Inumber"] . "</td></tr>";
                            echo "<tr><td>Insurance Name</td><td>" . $row["Iname"] . "</td></tr>";
                            echo "<tr><td>Coverage Start Date</td><td>" . $row["CoverageStart"] . "</td></tr>";
                            echo "<tr><td>Coverage End Date</td><td>" . $row["CoverageEnd"] . "</td></tr>";
                            echo "<tr><td>Policy Number</td><td>" . $row["PolicyNumber"] . "</td></tr>";

                        }
                    } else {
                        echo "<tr><td colspan='2'>No insurance information provided for the SSN.</td></tr>";
                    }
                }
            }
            echo "</table>";
        } else {
            echo "SSN is required.";
        }
    }

    // Close connection
    $conn->close();
    ?>

</body>
</html>
