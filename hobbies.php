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
    <title>Hobbies</title>
    <link href="input.css" rel="stylesheet" type="text/css">
  </head>

  <body>
  <h3>Your Hobbies</h3>
  <h4>Please select your favorite hobbies. You cannot change this once submitted!</h4>
      <div class=container2>
        <form name="hobbies" action="profile.php" method="POST">
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Hiking">Hiking</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Swimming">Swimming</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Calligraphy">Calligraphy</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Bowling">Bowling</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Movies">Movies</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Cooking">Cooking</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="chkl[ ]" value="Dancing">Dancing</h5><br>
        </form>
      </div>
      <button type="submit" id="btn" name=create value="Submit">Submit Hobbies</button>
  </body>
</html>

<!-- need the redirect to go back to homepage.php -->