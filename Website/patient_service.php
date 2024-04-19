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
            echo "<br><br><b>Patient Wants:</b><br>";
            // Evaluate based on chosen checkboxes.
            foreach ($_POST['patientdata'] as $selection) {
                if($selection == "billing") {
                    echo "fetch billing info based on Ssn<br>";
                }
                if($selection == "procedures") {
                    echo "fetch proceudres based on Pcode<br>";
                }
                if($selection == "personal") {
                    echo "fetch personal info based on ssn<br>";
                }
                if($selection == "insurance") {
                    echo "fetch insurance info based on Inumber<br>";
                }
            }
           

        }

        mysqli_close($conn);
    ?>


</body>
</html>





