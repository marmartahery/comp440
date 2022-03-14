<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // check to see if username exists in database
  $sql_qry = "SELECT username FROM user WHERE username = '$username'";
  $result_id = mysqli_query($conn, $sql_qry);

  $count = mysqli_num_rows($result_id);

  if ($count == 1) {
    $_SESSION["login_user"] = $username;

    $sql_qry_pwd = "SELECT password FROM user WHERE username = '$username'";
    $result_pwd = mysqli_query($conn, $sql_qry_pwd);
    $row_1 = mysqli_fetch_array($result_pwd, MYSQLI_ASSOC);
    $password_in_database = $row_1['password'];

    if ($password == $password_in_database) {
      header("location: homepage.php");
    } else {
      $_SESSION["login_error"] = 'Invalid username or password.';
    }
  } 
  else {
    $_SESSION["login_error"] = 'Invalid username or password.';
  }
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
      <p id="login_error_p">
        <?php
          if(isset($_SESSION["login_error"])) {
            $error = $_SESSION["login_error"];
            session_unset();
          } else {
            $error = "";
          }

          echo $error;
        ?>
      </p>
      <button id="button1" type="submit">Login</button><br>
    </form>
  </div>
  <div class="forgotpsw">
    <h2>New User? <a href="signup.php">Sign Up!</a></h2>
  </div>
  </div>
</body>

</html>