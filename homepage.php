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
<html>
<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="input.css" rel="stylesheet" type="text/css">
  <!-- <script type="text/javascript" src='front_validation.js'> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script> -->
  <!-- this was for the password strength meter -->
</head>

<body>
  <h1>
    You're signed in!
  </h1>

  <!-- need the functionality to initialize database -->
  <button type="submit">Initialize Database</button><br>

  <h2><a href="logout.php">Sign Out</a></h2>


</body>
</html>