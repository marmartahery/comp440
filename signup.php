<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src='front_validation.js'> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
</head>

<body>
  <h1>
    Create an Account
  </h1>
  <form action="insert.php" method="post">
    <div class="container">

      <form>
        <label for="uname"><h2>Enter Your Information</h2></label><br>
        <div class="row">
          <div class="column">
            <input type="text" id="firstName" name="first_name" placeholder="First Name" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" minlength="3" maxlength="30" required><br>
            <input type="text" id="birthDay" name="birth_date" placeholder="Birth Date (YYYY-MM-DD)" pattern="^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$" maxlength="10" required><br>
            <div <?php if (isset($name_error)) : ?> class="form_error" <?php endif ?>>
              <input type="text" id="username" name="username" minlength="5" maxlength="20" placeholder="Username" pattern="^[a-zA-Z0-9_.-]*" required value="<?php echo $username; ?>">
              <?php if (isset($name_error)) : ?>
                <span><?php echo $name_error; ?></span>
              <?php endif ?>
            </div>
            <input type="password" id="password1" name="password" minlength="6" maxlength="20" placeholder="Password" pattern="^[A-Za-z0-9_@./#&+!%$^*()<>-]*$" required><br>
            <meter max="4" id="password-strength-meter"></meter>
            <div id="password-strength-text"></div>
            <script>
              var strength = {
                0: "Very Bad ☹",
                1: "Bad ☹",
                2: "Weak ☹",
                3: "Good ☺",
                4: "Strong ☻"
              }

              var password = document.getElementById('password1');
              var meter = document.getElementById('password-strength-meter');
              var text = document.getElementById('password-strength-text');

              password.addEventListener('input', function() {
                var val = password.value;
                var result = zxcvbn(val);

                // Update the password strength meter
                meter.value = result.score;

                // Update the text indicator
                if (val !== "") {
                  // text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span"; 
                  text.innerHTML = "<i>" + "Password Strength: " + strength[result.score] + "</i>";
                } else {
                  text.innerHTML = " ";
                }
              });
            </script>
            <h2>What city were you born in?</h2>
            <h2>What school did you attend for sixth grade?</h2>
          </div>
          <div class="column">
            <input type="text" id="lastName" name="last_name" placeholder="Last Name" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" minlength="3" maxlength="30" required><br>
            <div <?php if (isset($email_error)) : ?> class="form_error" <?php endif ?>>
              <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $email; ?>">
              <?php if (isset($email_error)) : ?>
                <span><?php echo $email_error; ?></span>
              <?php endif ?>
            </div>
            <input type="form_spacer" disabled>
            <input type="password" id="password2" minlength="6" maxlength="20" placeholder="Re-enter Password" required><br>
            <p id="password-repeat"></p>
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
            <input type="text" id="answer_one" name="answer_one" placeholder="City" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" minlength="3" maxlength="25" required>
            <input type="text" id="answer_two" name="answer_two" placeholder="School Name" pattern="^[A-Za-z][A-Za-z'-]+([ A-Za-z][A-Za-z'-]+)*" minlength="3" maxlength="25" required>
          </div>
        </div>

        <!-- beginning of recaptcha -->

        <head>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </head>

        <body margin="auto">
          <form action="?" method="POST">
            <div class="g-recaptcha" data-sitekey="6LchkD8dAAAAAARDJbFidx8QurJw20oaRXdA5JjJ" data-callback="callback"></div>
            <br />
          </form>
        </body>
        <!-- end of recaptcha -->
        <script type="text/javascript">
          // function callback() {
            var first = document.getElementById('firstName').value
            var last = document.getElementById('lastName').value
            var bday = document.getElementById('birthDay').value
            var email = document.getElementById('email').value
            var user = document.getElementById('username').value
            var pass1 = document.getElementById('password1').value
            var pass2 = document.getElementById('password2').value
            var ans1 = document.getElementById('answer_one').value
            var ans2 = document.getElementById('answer_two').value
            var btnSubmit = document.getElementById("btnSubmit")
            btnSubmit.disabled = true;

            btnSubmit.disabled = EnableDisable(first, last, bday, email, user, pass1, pass2, ans1, ans2);
          // }
        </script>

        <button class="button1" type="submit" id="btnSubmit">Sign Up</button>
      </form>
    </div>
    <div class="forgotpsw">
      <a href="index.php">Back</a>
    </div>
</body>

</html>