<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Access Patient Info</h1>
    <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- This is a placeholder and will need to be moved. This will be on a case by case basis i think. -->
        Enter SSN: <input type="text" name="ssn"><br><br>

        What would you like to access:<br>
        <input type="checkbox" name="patientdata[]" value="billing"> Billing<br>
        <input type="checkbox" name="patientdata[]" value="procedures"> Procedures<br>
        <input type="checkbox" name="patientdata[]" value="insurance"> Insurance Info<br>
        <input type="checkbox" name="patientdata[]" value="personal"> Personal Info<br><br>
        <input type="submit">
    </form>


    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "healthcare";

        $conn = new mysqli($server, $username, $password, $dbname);

        // Check if form data is received
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $ssn = $_POST["ssn"];

            echo "<br><br><b>Patient Wants:</b><br>";
            
            if($ssn != NULL) {
            // Evaluate based on chosen checkboxes.
            foreach ($_POST['patientdata'] as $selection) {
                if ($selection == "billing") {
                    echo "<br><br>";

                    echo "Fetching Billing Information:<br>";
                
                    // SQL query
                    $sql = "SELECT * FROM billing WHERE PatientSsn = '$ssn'";
                
                    // Run query
                    $result = mysqli_query($conn, $sql);
                
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Print out each row
                            echo "<br>-----------------------------------------------<br>";
                            echo "Billing ID: " . $row["BillingID"] . "<br>";
                            echo "Billed Amount: " . $row["BilledAmount"] . "<br>";
                            echo "Billing Description: " . $row["BillingDescription"] . "<br>";
                            echo "Insurance Payment: " . $row["InsurancePayment"] . "<br>";
                            echo "Patient Payment: " . $row["PatientPayment"] . "<br>";
                            echo "Bill Date: " . $row["BillDate"] . "<br>";
                            echo "ProcedureCode: " . $row["ProcedureCode"] . "<br>";
                            echo "Patient SSN: " . $row["PatientSsn"] . "<br>";
                            echo "Insurance Number: " . $row["InsuranceNo"] . "<br>";
                            echo "-----------------------------------------------<br>";

                        }
                    } else {
                        // If no rows are returned
                        echo "No billing info found for the provided SSN.";
                    }
                
                    // Free result set
                    mysqli_free_result($result);
                } else {
                    // Handle other cases if needed
                }
                
                if($selection == "procedures") {
                    echo "<br><br>";

                    echo "Fetching Procedure Information:<br>";

                    // SQL query
                    $sql = "SELECT P.*
                    FROM PROCEDURES P
                    JOIN BILLING B ON P.Pcode = B.ProcedureCode
                    JOIN PATIENT PT ON B.PatientSsn = PT.Ssn
                    WHERE PT.Ssn = '$ssn'";
                
                    // Run query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Print out each row
                            echo "<br>-----------------------------------------------<br>";
                            echo "Procedure Name: " . $row["Pname"] . "<br>";
                            echo "Procedure Code: " . $row["Pcode"] . "<br>";
                            echo "Procedure Location: " . $row["Plocation"] . "<br>";
                            echo "Procedure Date: " . $row["Pdate"] . "<br>";
                            echo "Procedure Description: " . $row["PDescription"] . "<br>";
                            echo "-----------------------------------------------<br>";

                        }
                    } else {
                        // If no rows are returned
                        echo "No Procedures provided for the Ssn.";
                    }
                }
                if($selection == "personal") {
                    echo "<br><br>";

                    echo "Fetching Personal Information:<br>";

                    // SQL query
                    $sql = "Select * from patient where Ssn = '$ssn'";
                
                    // Run query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Print out each row
                            echo "<br>-----------------------------------------------<br>";
                            echo "First Name: " . $row["Fname"] . "<br>";
                            echo "Middle Initial: " . $row["Minit"] . "<br>";
                            echo "Last Name: " . $row["Lname"] . "<br>";
                            echo "Ssn: " . $row["Ssn"] . "<br>";
                            echo "Birthday: " . $row["BDate"] . "<br>";
                            echo "Email: " . $row["Email"] . "<br>";
                            echo "Address: " . $row["Address"] . "<br>";
                            echo "City: " . $row["City"] . "<br>";
                            echo "State: " . $row["State"] . "<br>";
                            echo "ZipCode: " . $row["ZipCode"] . "<br>";
                            echo "Sex: " . $row["Sex"] . "<br>";
                            echo "Insurance ID: " . $row["InsuranceID"] . "<br>";
                            echo "Physician Name: " . $row["PhysicianName"] . "<br>";
                            echo "-----------------------------------------------<br>";



                        }
                    } else {
                        // If no rows are returned
                        echo "No information provided for the Ssn.";
                    }
                }
                if($selection == "insurance") {
                    echo "<br><br>";
                    echo "Fetching Insurance Information:<br>";

                    // SQL query
                    $sql = "SELECT I.*
                    FROM INSURANCE I
                    JOIN PATIENT P ON I.Inumber = P.InsuranceID
                    WHERE P.Ssn = '$ssn'";
                
                    // Run query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Print out each row
                            echo "<br>-----------------------------------------------<br>";
                            echo "Insurance Number: " . $row["Inumber"] . "<br>";
                            echo "Insurance Name: " . $row["Iname"] . "<br>";
                            echo "Coverage Start Date: " . $row["CoverageStart"] . "<br>";
                            echo "Coverage End Date: " . $row["CoverageEnd"] . "<br>";
                            echo "Policy Number: " . $row["PolicyNumber"] . "<br>";
                            echo "-----------------------------------------------<br>";

                        }
                    } else {
                        // If no rows are returned
                        echo "No insurance information provided for the Ssn.";
                    }
                }
            }
        } else{
            echo "SSN is required.";
        }
    }
           


        mysqli_close($conn);
    ?>


</body>
</html>





