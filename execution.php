<?php
session_start();
include("config.php");

$user_name = $_SESSION["login_user"];
$_SESSION["blogId"] = 0;

$qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
$result_first = mysqli_query($conn, $qry_first);
$row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
$first = $row_1['first_name'];

echo "<h1><i> Welcome,&nbsp" . $first . ".</i></h1>";
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>First Query</title>
    <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
    <h2><a href="part3.php">Back to Part 3 Queries Page</a></h2>
    <?php
        if(isset($_POST['button1'])){
            echo 'button 1 worked!';
        }
        if(isset($_POST['button2'])){
            echo 'button 2 worked!';
        }
        if(isset($_POST['button3'])){
            echo 'button 3 worked!';
        }
        if(isset($_POST['button4'])){
            echo 'button 4 worked!';
        }
        if(isset($_POST['button5'])){
            echo 'button 5 worked!';
        }
        if(isset($_POST['button6'])){
            echo 'button 6 worked!';
        }
        if(isset($_POST['button7'])){
            echo 'button 7 worked!';
        }
        if(isset($_POST['button8'])){
            echo 'button 8 worked!';
        }
        if(isset($_POST['button9'])){
            echo 'button 9 worked!';
        }
    ?>
</body>

</html>