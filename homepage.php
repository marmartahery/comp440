<?php
session_start();
include("config.php");

$user_name = $_SESSION["login_user"];

$qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
$result_first = mysqli_query($conn, $qry_first);
$row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
$first = $row_1['first_name'];

// on first-ever login or db tables all dropped, check if tables exist 
// will be true if data exists
$qry_tables = "SELECT count(*) AS numTables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'comp440'";
$result_tables = mysqli_query($conn_comp440, $qry_tables);
$row_tables = mysqli_fetch_array($result_tables, MYSQLI_ASSOC);
$num_tables = $row_tables['numTables'];

if($num_tables > 1) {
  $_SESSION["first_load"] = 0;
}

if ($_SESSION["first_load"] == 0) {
  // check for hobbies set
  $sql_check = "SELECT * FROM user_hobbies WHERE user='$user_name'";
  $result_check = mysqli_query($conn_comp440, $sql_check);
  $num_hobbies = mysqli_num_rows($result_check);
  if ($num_hobbies == 0) {
    echo ("<script LANGUAGE='JavaScript'>
          window.alert('Please select your hobbies.');
          window.location.href='http://localhost:3000/hobbies.php';
          </script>");
  }
} else {
  echo ('Press Initialize Database to begin!');
}
echo "<h1><i> Welcome,&nbsp" . $first . ".</i></h1>";
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h1>
    You're signed in!
  </h1>

  <form action="homepage.php" method="POST">
    <button type="submit" name=initialize onclick="onClickInit()">Initialize Database</button>
  </form>
  <?php
  if (isset($_POST['initialize'])) {
    $conn_comp440->multi_query(file_get_contents('initialize.sql'));
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('Database initialized!');
            </script>");
    echo ("<script LANGUAGE='Javascript'>window.location.href = window.location.href;</script>");
  }
  ?>
  <br>
  <button type="submit"><a href="profile.php">View Your Profile</a></button><br><br>
  <button type="submit"><a href="newblog.php">New Blog Post</a></button><br><br>
  <button type="submit"><a href="viewblogs.php">View Blogs</a></button>

  <br>
  <h2><a href="logout.php">Sign Out</a></h2>

</body>

</html>