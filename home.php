<?php
include("session.php");
?>

<html>

<head>
    <link href="input.css" rel="stylesheet" type="text/css">
    <title> Welcome </title>
</head>

<body>
    <center>
        <?php
        $user_name = $_SESSION["login_user"];

        // don't need because we are not fetching database info from our user table here
        // $qry_first = "SELECT first_name FROM user_accounts WHERE username = '$user_name'";
        // $result_first = mysqli_query($conn, $qry_first);
        // $row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
        // $first = $row_1['first_name'];

        // $qry_last = "SELECT last_name FROM user_accounts WHERE username = '$user_name'";
        // $result_last = mysqli_query($conn, $qry_last);
        // $row_2 = mysqli_fetch_array($result_last, MYSQLI_ASSOC);
        // $last = $row_2['last_name'];

        // $qry_success_logins = "SELECT success_logins FROM user_stats WHERE username = '$user_name'";
        // $result_success_logins = mysqli_query($conn, $qry_success_logins);
        // $row_3 = mysqli_fetch_array($result_success_logins, MYSQLI_ASSOC);
        // $success = $row_3['success_logins'];

        // $qry_fail_logins = "SELECT fail_logins FROM user_stats WHERE username = '$user_name'";
        // $result_fail_logins = mysqli_query($conn, $qry_fail_logins);
        // $row_4 = mysqli_fetch_array($result_fail_logins, MYSQLI_ASSOC);
        // $fail = $row_4['fail_logins'];

        // $qry_last_login = "SELECT last_login FROM user_accounts WHERE username = '$user_name'";
        // $result_last_login = mysqli_query($conn, $qry_last_login);
        // $row_5 = mysqli_fetch_array($result_last_login, MYSQLI_ASSOC);
        // $last_login = $row_5['last_login'];

        // echo "<h1><i> Welcome,&nbsp" . $first . "&nbsp" . $last . ".</i></h1>";
        // echo "<h1>You have logged in&nbsp" . $success . "&nbsptimes.</h1>";
        // echo "<h1>There have been&nbsp" . $fail . "&nbspfailed login attempts for your account.</h1>";
        // echo "<h1>Your last login was on&nbsp" . $last_login . ".</h1>";
        ?>
        <!-- don't need to download something (from old project) -->
        <!-- <a alt="Company Confidential File" href="company_confidential_file.txt" target="_blank">Download Confidential File</a> -->
        <h2><a href="logout.php">Sign Out</a></h2>
</body>

</html>