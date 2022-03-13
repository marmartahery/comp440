<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="front_validation.js"></script>
</head>

<body>
  <h1>
    Create an Account
  </h1>
  <div>
    <?php
    include("config.php");
    $conn or die(mysqli_error($conn));
    if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
      // Verify data
      $email = mysqli_escape_string($conn, $_GET['email']); // Set email variable
      $hash = mysqli_escape_string($conn, $_GET['hash']); // Set hash variable
      $search = mysqli_query($conn, "SELECT email, hash, active FROM user_accounts WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysqli_error($conn));
      $match  = mysqli_num_rows($search);
      // echo $match; // Display how many matches have been found -> remove this wh
      if ($match > 0) {
        // We have a match, activate the account
        mysqli_query($conn, "UPDATE user_accounts SET active='1' WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysqli_error($conn));
        echo '<div class="statusmsg"><h2>Your account has been activated! You can now login.</h2></div>';
      } else {
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg"><h2>The url is either invalid or you already have activated your account.</h2></div>';
      }
    } else {
      // Invalid approach
      echo '<div class="statusmsg"><h2>Invalid approach, please use the link that has been send to your email.</h2></div>';
    }
    ?>
  </div>
  <div class="forgotpsw">
    <a href="index.php">Log In</a>
  </div>
</body>

</html>