<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Procedure and Billing Information</title>
    <link rel="stylesheet" type="text/css" href="bill_patient.css">
</head>
<body>
    <h1>Add Procedure and Billing Information</h1>
    <form method="post">
        <!-- Input fields for procedure information -->
        Procedure Name: <input type="text" name="procedure_name" required><br><br>
        Procedure Code: <input type="text" name="procedure_code" required><br><br>
        Procedure Location: <input type="text" name="procedure_location" required><br><br>
        Procedure Date: <input type="date" name="procedure_date" required><br><br>
        Procedure Description: <input type="text" name="procedure_description" required><br><br>

        <!-- Input fields for billing information -->
        Billed Amount: $<input type="text" name="billed_amount" required><br><br>
        Billing Description: <input type="text" name="billing_description" required><br><br>
        Insurance Payment: $<input type="text" name="insurance_payment" required><br><br>
        Patient Payment: $<input type="text" name="patient_payment" required><br><br>
        Bill Date: <input type="date" name="bill_date" required><br><br>
        Patient SSN: <input type="text" name="patient_ssn" required><br><br>

        <input type="submit" name="submit" value="Add Procedure and Billing Information">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

        // Retrieve form data for procedure information
        $procedure_name = $_POST["procedure_name"];
        $procedure_code = $_POST["procedure_code"];
        $procedure_location = $_POST["procedure_location"];
        $procedure_date = $_POST["procedure_date"];
        $procedure_description = $_POST["procedure_description"];

        // Retrieve form data for billing information
        $billed_amount = $_POST["billed_amount"];
        $billing_description = $_POST["billing_description"];
        $insurance_payment = $_POST["insurance_payment"];
        $patient_payment = $_POST["patient_payment"];
        $bill_date = $_POST["bill_date"];
        $patient_ssn = $_POST["patient_ssn"];

        // Validate if all fields are filled
        if (!empty($procedure_name) && !empty($procedure_code) && !empty($procedure_location) && !empty($procedure_date) &&
            !empty($procedure_description) && !empty($billed_amount) && !empty($billing_description) && !empty($insurance_payment) &&
            !empty($patient_payment) && !empty($bill_date) && !empty($patient_ssn)) {

            // Check if the procedure code already exists
            $sql_check_procedure = "SELECT * FROM PROCEDURES WHERE Pcode = '$procedure_code'";
            $result_check_procedure = $conn->query($sql_check_procedure);
            if ($result_check_procedure->num_rows > 0) {
                echo "Error: Procedure code already in use";
            } else {
                // SQL statement to retrieve InsuranceID from the PATIENT table based on SSN
                $sql_insurance_id = "SELECT InsuranceID FROM PATIENT WHERE Ssn='$patient_ssn'";
                $result = $conn->query($sql_insurance_id);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $insurance_id = $row["InsuranceID"];
                    }
                } else {
                    echo "No insurance information found for the provided SSN.";
                    exit();
                }

                // Check for unique BillingID
                $billing_id = uniqid();

                // SQL statement to insert procedure information into the PROCEDURES table
                $sql_procedure = "INSERT INTO PROCEDURES (Pname, Pcode, Plocation, Pdate, PDescription) 
                                VALUES ('$procedure_name', '$procedure_code', '$procedure_location', '$procedure_date', '$procedure_description')";

                // SQL statement to insert billing information into the BILLING table
                $sql_billing = "INSERT INTO BILLING (BillingID, BilledAmount, BillingDescription, InsurancePayment, PatientPayment, BillDate, ProcedureCode, PatientSsn, InsuranceNo) 
                                VALUES ('$billing_id', '$billed_amount', '$billing_description', '$insurance_payment', '$patient_payment', '$bill_date', '$procedure_code', '$patient_ssn', '$insurance_id')";

                if ($conn->query($sql_procedure) === TRUE && $conn->query($sql_billing) === TRUE) {
                    echo "Procedure and billing information added successfully";
                } else {
                    echo "Error: " . $sql_procedure . "<br>" . $conn->error;
                    echo "Error: " . $sql_billing . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Please fill in all the fields";
        }

        $conn->close();
    }
    ?>
</body>
</html>
