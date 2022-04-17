<?php
  session_start();
  include("config.php");

  $user_name = $_SESSION["login_user"];

  $qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
  $result_first = mysqli_query($conn, $qry_first);
  $row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
  $first = $row_1['first_name'];

  echo "<h1><i> Welcome,&nbsp" . $first .".</i></h1>";
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Current Blog Post</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Current Blog Posts</h1>
<h2>You can only give at most 3 comments per day, at most one comment for each blog,</h2>
<h2>and cannot comment on your own blog post</h2><br>
<br><button type="submit"><a href="newblog.php">New Blog Post</a></button><br>

<br>
<h2><a href="homepage.php">Back to Homepage</a></h2> 

</body>
</html>