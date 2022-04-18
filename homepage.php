<?php
session_start();
include("config.php");

$user_name = $_SESSION["login_user"];

$qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
$result_first = mysqli_query($conn, $qry_first);
$row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
$first = $row_1['first_name'];

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
          if(isset($_POST['initialize'])){
            $conn_comp440->multi_query(file_get_contents('initialize.sql'));
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Database initialized!');
            </script>");
          }
        ?>
    <br>

      <button type="submit"><a href="newblog.php">New Blog Post</a></button><br><br>
      <button type="submit"><a href="viewblogs.php">View Blogs</a></button>

    <br>
    <h2><a href="logout.php">Sign Out</a></h2>

  </body>

</html>