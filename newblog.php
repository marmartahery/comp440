<?php
  session_start();
  include("config.php");

  $user_name = $_SESSION["login_user"];

  $qry_first = "SELECT first_name FROM user WHERE username = '$user_name'";
  $result_first = mysqli_query($conn, $qry_first);
  $row_1 = mysqli_fetch_array($result_first, MYSQLI_ASSOC);
  $first = $row_1['first_name'];

  echo "<h1><i> Welcome,&nbsp" . $first .".</i></h1>";
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>New Blog Post</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Create a New Blog Post Here!</h1>
<h2>You are only allowed to create up to 2 new blogs per day</h2>

<form name="newblog" action="newblog.php" method="POST">
<label for="uname"></label><br>
<div class="form-area">
      <input type="text" id="title" name="title" placeholder="Title"><br>
      <!-- <input style="height:200px" type="textarea" id="description" name="description" placeholder="Description"><br> -->
      <input type="text" style="resize: none; height:200px" id="blog-content" name="blog-content" maxlength="2500" placeholder="Write your post here!"></textarea><br>
      <h2>Add up to 3 tags to help users find your post:</h2>
      <input type="text" id="tag1" name="tag1" pattern="/^[a-zA-Z]*$/" maxlength="20" minlength="1" placeholder="Tag #1"><br>      
      <input type="text" id="tag2" name="tag2" pattern="/^[a-zA-Z]*$/" maxlength="20" placeholder="Tag #2"><br>
      <input type="text" id="tag3" name="tag3" pattern="/^[a-zA-Z]*$/" maxlength="20" placeholder="Tag #3"><br>            
      <button type="submit" id="btn" name="newB"><a href="currentblog.php">Create New Post</a></button>
    </form><br>
    <h2><a href="homepage.php">Back to Homepage</a></h2> 
</div>
<div>
  <?php
  if(isset($_POST['newB'])){
    if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
  } 
  $title = $_POST['title'];
  $bcontent = $_POST['blog-content'];
  $tag1 = $_POST['tag1'];
  $tag2 = $_POST['tag2'];
  $tag3 = $_POST['tag3'];
  $currdate = date("Y-m-d");

  $title = stripcslashes($title);
  $bcontent = stripcslashes($bcontent);
  $tag1 = stripcslashes($tag1);
  $tag2 = stripcslashes($tag2);
  $tag3 = stripcslashes($tag3);
  $title = mysqli_real_escape_string($conn_comp44, $title);
  $bcontent = mysqli_real_escape_string($conn_comp44, $bcontent);
  $tag1 = mysqli_real_escape_string($conn_comp44, $tag1);
  $tag2 = mysqli_real_escape_string($conn_comp44, $tag2);
  $tag3 = mysqli_real_escape_string($conn_comp44, $tag3);

  $sql = "INSERT INTO user (blogTitle, content, ownerUsername, datePosted)
                  VALUES ('$title', '$bcontent', '$user_name','$currdate')";
  if ($conn->query($sql) === TRUE) {
          echo ("<script LANGUAGE='JavaScript'>
                 window.alert('Data Added!');
                </script>");
            } 
  }
  ?>
</div>

</body>
</html>