<?php header('Location: http://localhost:3000/get_login_link.php'); ?>
<!DOCTYPE html>
<html>

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
        $birth_date = $_REQUEST['birth_date'];
        $password = $_REQUEST['password'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $answer_one = strtoupper($_REQUEST['answer_one']);
        $answer_two = strtoupper($_REQUEST['answer_two']);
        $hash = md5(rand(0, 1000));

        $options = [
            'cost' => 10,
        ];

        $sql = "INSERT INTO user_accounts(user_id, first_name, last_name, birth_date, email, username, password, last_login, active, hash) VALUES (
            null, 
            '" . mysqli_real_escape_string($conn, $first_name) . "', 
            '" . mysqli_real_escape_string($conn, $last_name) . "', 
            '" . mysqli_real_escape_string($conn, $birth_date) . "', 
            '" . mysqli_real_escape_string($conn, $email) . "', 
            '" . mysqli_real_escape_string($conn, $username) . "', 
            '" . mysqli_real_escape_string($conn, password_hash($password, PASSWORD_BCRYPT, $options)) . "', 
            null, 0, 
            '" . mysqli_real_escape_string($conn, $hash) . "')";

        $to = $email;
        $subject = 'Signup | Verification';
        $message = '
        Thanks for signing up! Your account has been created.
        Please click this link to activate your account:
        http://localhost:3000/verify.php?email=' . $email . '&hash=' . $hash . ''; // Our message above including the link

        $headers = 'From:noreply@comp424kbbq.duckdns.org' . "\r\n";  // Set from headers
        mail($to, $subject, $message, $headers); // Send our email

        if (mysqli_query($conn, $sql)) {
            mysqli_query($conn, "INSERT INTO user_stats(username, success_logins, fail_logins) VALUES (
                '" . mysqli_real_escape_string($conn, $username) . "', 0, 0
            )");
            mysqli_query($conn, "INSERT INTO user_questions(username, answer_one, answer_two) VALUES (
                '" . mysqli_real_escape_string($conn, $username) . "',
                '" . mysqli_real_escape_string($conn, $answer_one) . "',
                '" . mysqli_real_escape_string($conn, $answer_two) . "'
            )");
            echo "<h3>data stored in a database successfully.";

            echo nl2br("\n$first_name\n $last_name\n "
                . "$birth_date\n $username\n $email");
        } else {
            echo "ERROR: $sql. "
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>

</html>