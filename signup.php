<?php 

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
            <input type="text" id="username" name="username" placeholder="Username" pattern="^[a-zA-Z0-9_.-]*" required ?><br>
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
       <script type="text/javascript">
           function callback() {
            var first = document.getElementById('firstName').value
            var last = document.getElementById('lastName').value
            var email = document.getElementById('email').value
            var user = document.getElementById('username').value
            var pass1 = document.getElementById('password1').value
            var pass2 = document.getElementById('password2').value
            var btnSubmit = document.getElementById("btnSubmit")
            btnSubmit.disabled = true;

            btnSubmit.disabled = EnableDisable(first, last, email, user, pass1, pass2);
           }
        </script>

        <button type="submit" id="btnSubmit">Sign Up</button>
      </form>
    </div>

    <h2>Already have an account? Log in <a href="index.php">here</a></h2>
</body>

</html>