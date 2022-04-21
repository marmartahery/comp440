<?php
include("config.php");
session_start();
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="input.css" rel="stylesheet" type="text/css">
  <!-- <script type="text/javascript" src='front_validation.js'> </script> -->
</head>

<body>
  <h1>
    Create an Account
  </h1>
  <div class="container">

    <form name="f1" action="signup.php" method="POST">
      <label for="uname">
        <h2>Enter Your Information</h2>
      </label><br>
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

      <button type="submit" id="btn" name=create value="Register">Register</button>
    </form>
  </div>
  <div>
    <?php
    if(isset($_POST['create'])){

      if(mysqli_connect_errno()) {  
          die("Failed to connect with MySQL: ". mysqli_connect_error());  
      }  
      $username = $_POST['username'];  
      $password = $_POST['password']; 
      $password_repeat = $_POST['password2'];
      $fName = $_POST['first_name'];  
      $lName = $_POST['last_name']; 
      $email = $_POST['email'];  


      //to prevent from mysqli injection  
      $username = stripcslashes($username);  
      $password = stripcslashes($password);  
      $username = mysqli_real_escape_string($conn, $username);  
      $password = mysqli_real_escape_string($conn, $password);

      $sql = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";  
      $result = mysqli_query($conn, $sql);  
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
      $count = mysqli_num_rows($result);

      if($count==0){
        if($password == $password_repeat){
          $sql = "INSERT INTO user (username, password, first_name, last_name, email)
                  VALUES ('$username', '$password', '$fName','$lName','$email')";
          if ($conn->query($sql) === TRUE) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $_SESSION["login_user"] = $username;
            $_SESSION["first_load"] = 1;
              echo ("<script LANGUAGE='JavaScript'>
               window.alert('User Created!');
              window.location.href='http://localhost:3000/homepage.php';
              </script>");
              // user is redirected to hobbies.php instead to select hobbies
          } 
        } else {
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Passwords do not match, please try again.');
         </script>");
            }
      }else {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('User or email taken!');
       </script>");
    }
  }
    ?>
  </div>
  <h2>Already have an account? Log in <a href="index.php">here</a></h2>
</body>

</html>