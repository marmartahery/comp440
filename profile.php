<?php
session_start();
include("config.php");

$user_name = $_SESSION["login_user"];

$qry_info = "SELECT * FROM user WHERE username = '$user_name'";
$result_info = mysqli_query($conn, $qry_info);
$row_1 = mysqli_fetch_array($result_info, MYSQLI_ASSOC);
$first = $row_1['first_name'];
$last = $row_1['last_name'];
$email = $row_1['email'];
$username = $row_1['username'];


echo "<h1><i> Welcome,&nbsp" . $first . ".</i></h1>";
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Profile</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h3>Your Information</h3>
  <h4>First Name: <?php echo $first ?></h4>
  <h4>Last Name: <?php echo $last ?> </h4>
  <h4>Email: <?php echo $email ?></h4>
  <h4>Username: <?php echo $username ?></h4><br>
  <h4>Hobbies:
    <?php
    // list user's hobbies
    // get the hobby ids of each of the user's hobbies
    $sql_get_hobbies = "SELECT hobbyId FROM user_hobbies WHERE user='$username'";
    $result_hobbies = mysqli_query($conn_comp440, $sql_get_hobbies);
    if ($result_hobbies->num_rows > 0) {
      echo "<br>";
      while ($row = $result_hobbies->fetch_assoc()) {
        // get the hobby name for each hobby id returned and list it
        $hobby_id = $row["hobbyId"];
        $sql_get_hobby_name = "SELECT hobbyName FROM hobbies WHERE hobbyId=$hobby_id";
        $result_get_hobby_name = mysqli_query($conn_comp440, $sql_get_hobby_name);
        $row_hobby = mysqli_fetch_assoc($result_get_hobby_name);
        echo " ‘" . $row_hobby["hobbyName"] . "’ ";
      }
    }
    ?>
  </h4><br>
  <form action="profile.php" method="POST">
    <h4>Follow someone new!</h4>
    <input type="text" id="username" name="username" placeholder="Username" pattern="^[a-zA-Z0-9_.-]*" required ?><br>
    <button type="submit" id="followBtn" name=follow value="follow">Follow</button>
  </form>
  <?php 
    if(isset($_POST['follow'])){
      $add_follow = $_POST['username'];
      // check if the user exists
      $sql_get_user = "SELECT * FROM user WHERE username='$add_follow'";
      $result_get_user = mysqli_query($conn_comp440, $sql_get_user);
      $row_count = mysqli_num_rows($result_get_user);

      // make sure user exists and user is not trying to follow themselves
      if($add_follow != $user_name && $row_count == 1) {
        $sql_add_follow = "INSERT INTO user_following (user, followingUser) VALUES ('$user_name', '$add_follow')";
        mysqli_query($conn_comp440, $sql_add_follow);
        echo ("<script LANGUAGE='JavaScript'>
          window.alert('Added user to list!');
          </script>");
      } else {
        if($add_follow == $user_name) {
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('You may not follow yourself!');
          </script>");
        } else {
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('User does not exist.');
          </script>");
        }
      }
      
    }
  ?>
  <h4 style="text-decoration: underline;">Following</h4>
  <?php
  // list users being followed by current user
  // get the user names of each person the current user is following
  $sql_get_followers = "SELECT followingUser FROM user_following WHERE user='$username'";
  $result_followers = mysqli_query($conn_comp440, $sql_get_followers);
  if ($result_followers->num_rows > 0) {
    while ($row = $result_followers->fetch_assoc()) {
      echo "" . $row["followingUser"] . "";
      echo "<br>";
    }
  }
  ?>
  <h4 style="text-decoration: underline;">Followers</h4>
  <?php
  // list current user's followers
  // get the user names of each person following the current user
  $sql_get_following = "SELECT user FROM user_following WHERE followingUser='$username'";
  $result_following = mysqli_query($conn_comp440, $sql_get_following);
  if ($result_following->num_rows > 0) {
    while ($row = $result_following->fetch_assoc()) {
      echo "" . $row["user"] . "";
      echo "<br>";
    }
  }
  ?>
</body>

</html>