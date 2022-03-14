<?php 
// include("config.php");
// session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $username = mysqli_real_escape_string($conn, $_POST['username']);
//   $email = mysqli_real_escape_string($conn, $_POST['email']);

//   // check to see if username exists in database
//   $sql_qry_user = "SELECT username FROM user WHERE username = '$username'";
//   $result_id_user = mysqli_query($conn, $sql_qry);

//   $sql_qry_email = "SELECT email FROM user WHERE email = '$email'";
//   $result_id_email = mysqli_query($conn, $sql_qry);

//   $username_count = mysqli_num_rows($result_id_user);
//   $email_count = mysqli_num_rows($result_id_email);


//   if ($username_count == 1) {
//     $_SESSION["username_taken_error"] = 'Username taken';
//     $_SESSION["user_and_email_free"] = false;
//   } 
//   if ($email_count == 1) {
//     $_SESSION["email_taken_error"] = 'Email already in use';
//     $_SESSION["user_and_email_free"] = false;
//   } 
//   if ($username_count == 0 && $email_count == 0) {
//     $_SESSION["user_and_email_free"] = true;
//   }
// }
?>

<html lang="en">

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
    Create an Account
  </h1>
  <form action="insert.php" method="post">
    <div class="container">

      <form>
        <label for="uname"><h2>Enter Your Information</h2></label><br>
            <input type="text" id="firstName" name="first_name" placeholder="First Name" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" required><br>
            <input type="text" id="lastName" name="last_name" placeholder="Last Name" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" required><br>
            <input type="email" id="email" name="email" placeholder="Email" required><br>
            <!-- <p id="email_error_p">
              <?php
                // if(isset($_SESSION["email_taken_error"])) {
                //   echo $_SESSION["email_taken_error"];
                // } else {
                //   unset($_SESSION['email_taken_error']);
                //   // $error_email = "";
                // }

                // //  echo $error_email;
              ?>
            </p> -->
            <input type="text" id="username" name="username" placeholder="Username" pattern="^[a-zA-Z0-9_.-]*" required ?><br>
            <!-- <p id="username_error_p">
              <?php
                // if(isset($_SESSION["username_taken_error"])) {
                //   echo $_SESSION["username_taken_error"];
                // } else {
                //   unset($_SESSION['username_taken_error']);
                //   // $error_user = "";
                // }

                // // echo $error_user;
              ?>
            </p> -->
            <input type="password" id="password1" name="password" placeholder="Password" pattern="^[A-Za-z0-9_@./#&+!%$^*()<>-]*$" required><br>
            <input type="password" name="password2" id="password2" placeholder="Re-enter Password" required><br>
            <p id="password-repeat"></p>

            <!-- add php for checking if passwords match -->
            <script>
              var password = document.getElementById('password1');
              var passwordRepeat = document.getElementById('password2');
              var matchText = document.getElementById('password-repeat');

              passwordRepeat.addEventListener('input', function() {
                var expected = password.value;
                var actual = passwordRepeat.value;

                // Update the text indicator
                if (actual !== expected) {
                  matchText.innerHTML = "<i>" + "Passwords do not match." + "</i>";
                } else {
                  matchText.innerHTML = "<i> Passwords match. </i>";
                }
              });
            </script>

        <!-- javascript that disables button until all fields are filled -->

        <button type="submit" id="btnSubmit">Sign Up</button>
      </form>
    </div>
    <!-- <p id="register_success_p">
      <?php
        // if(isset($_SESSION["register_success"])) {
        //   echo $_SESSION["register_success"];
        //   session_unset();
        //   session_destroy();
        // } else {
        //   // $message = "";
        // }

        // // echo $message;
      ?>
    </p> -->
    <h2>Already have an account? Log in <a href="index.php">here</a></h2>
</body>

</html>