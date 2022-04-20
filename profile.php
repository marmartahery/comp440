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
<!-- we need 2 forms on this page. one form will be for the user to be able to submit their hobbies
these will be check boxes. the other form will be maybe a single text box to start following someone. they would put
in the username of the user they want to follow and when they submit we'll check the database for that user
and if it exists we'll add the list of people that they are following (backend). front end we just need the textbox 
with a follow button 
we'll need a section for the users followers and who they are following 
add the hobbies to the your information part with the checkboxes-->



<html>

  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link href="input.css" rel="stylesheet" type="text/css">
  </head>

  <body>
      <h3>Your Information</h3>
      <h4>First Name: <?php echo $first ?></h4>
      <h4>Last Name: <?php echo $last ?>  </h4>
      <h4>Email: <?php echo $email ?></h4>
      <h4>Username: <?php echo $username ?></h4><br>
      <h4>Hobbies: <?php echo $hobbies?><br>
      <?php
        // list user's hobbies
        $sql_get_hobbies = "SELECT hobbyId FROM comments WHERE commentId IN (SELECT commentId FROM blog_comments WHERE blogId=$blog_id)";
        $result_comments = mysqli_query($conn_comp440, $sql_get_comments);
        echo "<br><p class='comment-section-title'>Comments: </p>";
        if ($result_comments->num_rows > 0) {
            while ($row = $result_comments->fetch_assoc()) {
                echo "<br>";
                echo "<p class='commentOwner'>" . $row["ownerUsername"] . ":</p>";
                echo "<p class='comments'>&nbsp&nbsp" . $row["content"] . "</p>";
                echo "<p class='date'>&nbsp&nbsp&nbsp" . $row["datePosted"] . "</p>";
                echo "<br>";
            }
        }
      ?>
      <!-- need the functionality to call the selected hobbies from the database here -->
      <h3><table class = tableFol><tr><th>Following</th> <th>Followers</th></h3>
  </body>
</html>
