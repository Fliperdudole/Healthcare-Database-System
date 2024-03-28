<?php
// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data based on name keys
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $type = $_POST['additional_info'];

    // Do whatever processing you need with $user and $pass

    // Echo back a response, this will be stored in xhr.responseText (in onload in Patient.js file)
    echo "Username: $user<br>Password: $pass<br>User Type: ";
    if($type == 'patient') {
        echo "Patient";
    }
    else if($type == 'staff') {
        echo "Staff";
    }

} else {
    // If not received through POST method, handle the case accordingly
    echo "Form data not received.";
}
?>