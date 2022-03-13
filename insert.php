<?php header('Location: http://localhost:3000/done_registering.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Insert Page</title>
</head>

<body>
    <center>
        <?php
        include("config.php");
        // include("signup.php");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // echo "$passwords_match";
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        // $birth_date = $_REQUEST['birth_date'];
        $password = $_REQUEST['password'];
        $password2 = $_REQUEST['password2'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        // $answer_one = strtoupper($_REQUEST['answer_one']);
        // $answer_two = strtoupper($_REQUEST['answer_two']);
        // refer to old project for password hashing
        // $hash = md5(rand(0, 1000));

        // $options = [
        //     'cost' => 10,
        // ];

        $sql = "INSERT INTO user(username, password, email, first_name, last_name) VALUES (
            '" . mysqli_real_escape_string($conn, $username) . "', 
            '" . mysqli_real_escape_string($conn, $password) . "',
            '" . mysqli_real_escape_string($conn, $email) . "',
            '" . mysqli_real_escape_string($conn, $first_name) . "', 
            '" . mysqli_real_escape_string($conn, $last_name) . "')"; 

        // don't need because we aren't sending verification email
        // $to = $email;
        // $subject = 'Signup | Verification';
        // $message = '
        // Thanks for signing up! Your account has been created.
        // Please click this link to activate your account:
        // http://localhost:3000/verify.php?email=' . $email . '&hash=' . $hash . ''; // Our message above including the link

        // $headers = 'From:noreply@comp424kbbq.duckdns.org' . "\r\n";  // Set from headers
        // mail($to, $subject, $message, $headers); // Send our email

        // don't need because we aren't using additional tables
        // if (mysqli_query($conn, $sql)) {
        //     mysqli_query($conn, "INSERT INTO user_stats(username, success_logins, fail_logins) VALUES (
        //         '" . mysqli_real_escape_string($conn, $username) . "', 0, 0
        //     )");
        //     mysqli_query($conn, "INSERT INTO user_questions(username, answer_one, answer_two) VALUES (
        //         '" . mysqli_real_escape_string($conn, $username) . "',
        //         '" . mysqli_real_escape_string($conn, $answer_one) . "',
        //         '" . mysqli_real_escape_string($conn, $answer_two) . "'
        //     )");
        //     echo "<h3>data stored in a database successfully.";

        //     echo nl2br("\n$first_name\n $last_name\n "
        //         . "$birth_date\n $username\n $email");
        // } else {
        //     echo "ERROR: $sql. "
        //         . mysqli_error($conn);
        // }          
        if($password == $password2){
            mysqli_query($conn, $sql);
            echo "blah";
        } else {
            echo "ERROR: $sql. "
                . mysqli_error($conn);
            $error = "Passwords do not match";
            header("location: signup.php");
        } 



        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>

</html>