<?php 
// session_start();
// header('Location: http://localhost:3000/done_registering.php'); 
header('Location: http://localhost:3000/done_registering.php');
?> 

<!DOCTYPE html>
<html>
<!-- header used to be done_registering.php -->
<!-- might change this to only php so page doesnt render? -->
<head>
    <title>Insert Page</title>
</head>

<body>
    <center>
        <?php
        include("config.php");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $password = $_REQUEST['password'];
        $password2 = $_REQUEST['password2'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        // refer to old project for password hashing

        $sql = "INSERT INTO user(username, password, email, first_name, last_name) VALUES (
            '" . mysqli_real_escape_string($conn, $username) . "', 
            '" . mysqli_real_escape_string($conn, $password) . "',
            '" . mysqli_real_escape_string($conn, $email) . "',
            '" . mysqli_real_escape_string($conn, $first_name) . "', 
            '" . mysqli_real_escape_string($conn, $last_name) . "')"; 

        if($password == $password2){
            mysqli_query($conn, $sql);
            // $_SESSION["register_success"] = "Registered Successfully! You may now log in.";
            // echo "blah";
        } else {
            // echo "ERROR: $sql. "
            //     . mysqli_error($conn);
            // $error = "Passwords do not match";
            // header("location: signup.php");
        } 

        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>

</html>