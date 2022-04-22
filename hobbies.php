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
        <form name="hobbies" action="hobbies.php" method="POST">
        <h5><input class = "radiostyle" type="checkbox" name="hiking" value="Hiking">Hiking</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="swimming" value="Swimming">Swimming</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="calligraphy" value="Calligraphy">Calligraphy</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="bowling" value="Bowling">Bowling</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="movie" value="Movies">Movies</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="cooking" value="Cooking">Cooking</h5><br>
        <h5><input class = "radiostyle" type="checkbox" name="dancing" value="Dancing">Dancing</h5><br>
        <button type="submit" id="btn" name=setHobbies value="Submit">Submit Hobbies</button>
      </form>
      </div>
      <?php
        if(isset($_POST['setHobbies'])){
          // check if hobbies have already been set
          $sql_check = "SELECT * FROM user_hobbies WHERE user='$user_name'";
          $result_check = mysqli_query($conn_comp440, $sql_check);
          $num_hobbies = mysqli_num_rows($result_check);

          if($num_hobbies < 1) {
            if($_POST['hiking']) {
              // getting the ID of the hobby
              $sql_hiking = "SELECT hobbyId FROM hobbies WHERE hobbyName='hiking'";
              $result_hiking = mysqli_query($conn_comp440, $sql_hiking);
              $row = mysqli_fetch_assoc($result_hiking);
              $hiking_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $hiking_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['swimming']) {
              // getting the ID of the hobby
              $sql_swimming = "SELECT hobbyId FROM hobbies WHERE hobbyName='swimming'";
              $result_swimming = mysqli_query($conn_comp440, $sql_swimming);
              $row = mysqli_fetch_assoc($result_swimming);
              $swimming_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $swimming_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['calligraphy']) {
              // getting the ID of the hobby
              $sql_calligraphy = "SELECT hobbyId FROM hobbies WHERE hobbyName='calligraphy'";
              $result_calligraphy = mysqli_query($conn_comp440, $sql_calligraphy);
              $row = mysqli_fetch_assoc($result_calligraphy);
              $calligraphy_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $calligraphy_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['bowling']) {
              // getting the ID of the hobby
              $sql_bowling = "SELECT hobbyId FROM hobbies WHERE hobbyName='bowling'";
              $result_bowling = mysqli_query($conn_comp440, $sql_bowling);
              $row = mysqli_fetch_assoc($result_bowling);
              $bowling_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $bowling_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['movie']) {
              // getting the ID of the hobby
              $sql_movie = "SELECT hobbyId FROM hobbies WHERE hobbyName='movie'";
              $result_movie = mysqli_query($conn_comp440, $sql_movie);
              $row = mysqli_fetch_assoc($result_movie);
              $movie_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $movie_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['cooking']) {
              // getting the ID of the hobby
              $sql_cooking = "SELECT hobbyId FROM hobbies WHERE hobbyName='cooking'";
              $result_cooking = mysqli_query($conn_comp440, $sql_cooking);
              $row = mysqli_fetch_assoc($result_cooking);
              $cooking_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $cooking_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            if($_POST['dancing']) {
              // getting the ID of the hobby
              $sql_dancing = "SELECT hobbyId FROM hobbies WHERE hobbyName='dancing'";
              $result_dancing = mysqli_query($conn_comp440, $sql_dancing);
              $row = mysqli_fetch_assoc($result_dancing);
              $dancing_id = $row['hobbyId'];

              // insert into user_hobbies table
              $sql_insert = "INSERT INTO user_hobbies(user, hobbyId) VALUES ('$user_name', $dancing_id)";
              mysqli_query($conn_comp440, $sql_insert);
            }
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Your hobbies have been set.');
                    </script>");
          } else {
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Your hobbies have already been set.');
                    </script>");
          }
          echo ("<script LANGUAGE='JavaScript'>
              window.location.href='http://localhost:3000/homepage.php';
              </script>");
        }
      ?>
  </body>
</html>