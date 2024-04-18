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
        Enter SSN: <input type="text" name="ssn"><br>
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
            echo "hello";
           

        } else {
            // If not received through POST method, handle the case accordingly
            echo "Form data not received.";
        }

        mysqli_close($conn);
    ?>


</body>
</html>





