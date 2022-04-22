<?php
session_start();
include("config.php");

$user_name = $_SESSION["login_user"];
$_SESSION["blogId"] = 0;

$qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
$result_first = mysqli_query($conn, $qry_first);
$row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
$first = $row_1['first_name'];

echo "<h1><i> Welcome,&nbsp" . $first . ".</i></h1>";
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Part 3 Queries</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h2><a href="homepage.php">Back to Homepage</a></h2>

  <br>
<form name="f1" action="part3.php" method="POST">
  <div class='card'>
    <div class='container'>
      <p>
        Lists the users who have posted at least two blogs, one has a tag of “X”, and another has a
        tag of “Y”. "X" and "Y" are inputs.
      </p>
      <input type="text" id="tagX" name="tagX" placeholder="Tag X" pattern="[A-Za-z]+" maxlength="20" required ?><br>
      <input type="text" id="tagY" name="tagY" placeholder="Tag Y" pattern="[A-Za-z]+" maxlength="20" required ?>
      <br><button type="submit" name="button1"><a href="1query.php">First Query</a></button><br>
    </div>
  </div>
</form>

<form name="f2" action="part3.php" method="POST">
  <div class='card'>
    <div class='container'>
      <p>
        Lists all the blogs of user "X", such that all the comments are positive for these blogs.
        "X" is an input.
      </p>
      <input type="text" id="usernameX" name="usernameX" placeholder="Username X" pattern="^[a-zA-Z0-9_.-]*" required ?>
      <br><button type="submit" name="button2"><a href="2query.php">Second Query</a></button><br>
    </div>
  </div>
</form>

  <div class='card'>
    <div class='container'>
      <p>
        Lists the users who posted the most number of blogs on 5/1/2022; if there is a tie,
        then all of the users in the tie will be listed.
      </p>
      <br><button type="submit" name="button3"><a href="3query.php">Third Query</a></button><br>
    </div>
  </div>

<form name="f3" action="part3.php" method="POST">
  <div class='card'>
    <div class='container'>
      <p>
        Lists the users who are followed by both "X" and "Y". Usernames "X" and "Y" are inputs.
      </p>
      <input type="text" id="usernameX2" name="usernameX2" placeholder="Username X" pattern="^[a-zA-Z0-9_.-]*" required ?><br>
      <input type="text" id="usernameY2" name="usernameY2" placeholder="Username Y" pattern="^[a-zA-Z0-9_.-]*" required ?>
      <br><button type="submit" name="button4"><a href="4query.php">Fourth Query</a></button><br>
    </div>
  </div>
</form>

  <div class='card'>
    <div class='container'>
      <p>
        Lists user pairs ("X", "Y") such that they have at least one common hobby.
      </p>
      <br><button type="submit" name="button5"><a href="5query.php">Fifth Query</a></button><br>
    </div>
  </div>

  <div class='card'>
    <div class='container'>
      <p>
        Displays all the users who have yet to post a blog.
      </p>
      <br><button type="submit" name="button6"><a href="6query.php">Sixth Query</a></button><br>
    </div>
  </div>

  <div class='card'>
    <div class='container'>
      <p>
        Displays all the users who have yet to post a comment.
      </p>
      <br><button type="submit" name="button7"><a href="7query.php">Seventh Query</a></button><br>
    </div>
  </div>

  <div class='card'>
    <div class='container'>
      <p>
        Displays all the users who have only posted negative comments.
      </p>
      <br><button type="submit" name="button8"><a href="8query.php">Eighth Query</a></button><br>
    </div>
  </div>

  <div class='card'>
    <div class='container'>
      <p>
        Displays users who have yet to receive a negative comment on any of their blogs.
      </p>
      <br><button type="submit" name="button9"><a href="9query.php">Ninth Query</a></button><br>
    </div>
  </div>

  <br>

</body>

</html>