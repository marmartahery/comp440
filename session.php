<?php header('Location: http://localhost:3000/homepage.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Insert Page</title>
</head>

<body>
   <center>
      <?php
      include('config.php');
   
   $user_check = $_SESSION["login_user"];
   
   $ses_sql = mysqli_query($conn, "SELECT username FROM user WHERE username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
//    if(!isset($_SESSION['login_user'])){
//       header("location: index.php");
//       die();
//    }
