<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // don't need this because we know username will be unique
  // $sql_qry = "SELECT user_id FROM user_accounts WHERE username = '$username'";
  // $result_id = mysqli_query($conn, $sql_qry);
  // $row_1 = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
  // $uid = $row_1['user_id'];

  // $count = mysqli_num_rows($result_id);

  // if ($count == 1) {
    $_SESSION["login_user"] = $username;

    $sql_qry_pwd = "SELECT password FROM user WHERE username = '$username'";
    $result_pwd = mysqli_query($conn, $sql_qry_pwd);
    $row_1 = mysqli_fetch_array($result_pwd, MYSQLI_ASSOC);
    $password_in_database = $row_1['password'];

    // don't need this check if user account is active(old project)
    // $qry_active = "SELECT active FROM user_accounts WHERE username = '$username'";
    // $result_active = mysqli_query($conn, $qry_active);
    // $row_3 = mysqli_fetch_array($result_active, MYSQLI_ASSOC);
    // $active = $row_3['active'];

    if ($password == $password_in_database) {
      // don't need, not tracking # successful logins or timestamp of last login
      // mysqli_query($conn, "UPDATE user_stats SET success_logins = success_logins + 1 WHERE username = '" . $username . "'");
      // mysqli_query($conn, "UPDATE user_accounts SET last_login = CURRENT_TIMESTAMP WHERE username = '" . $username . "'");
      header("location: home.php");
    } else {
      // don't need, not tracking # failed logins
      // mysqli_query($conn, "UPDATE user_stats SET fail_logins = fail_logins + 1 WHERE username = '" . $username . "'");
      $error = "Your Username or Password is invalid";
    }
  // } 
  // else {
  //   $error = "Your Username or Password is invalid";
  // }
}

?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="input.css" rel="stylesheet" type="text/css">

</head>

<body>
  <h1>Welcome to ANM!</h1>
  <h2>Please Login Below</h2><br>
  <!-- <form action="session.php" method="post"> -->
  <div class="container">
    <form action="" method="post">
      <!-- <h2><label for="uname" class="myForm" >Username</label></h2> -->
      <input type="text" class="myForm" name="username" placeholder="Enter Username" required><br>
      <!-- <h2><label for="pwd">Password</label><br></h2> -->
      <input type="password" class="myForm" name="password" placeholder="Enter Password" required><br><br>
      <button id="button1" type="submit">Login</button><br>
    </form>
  </div>
  <div class="forgotpsw">
    <h2>New User? <a href="signup.php">Sign Up!</a></h2>
  </div>
  </div>
</body>

</html>