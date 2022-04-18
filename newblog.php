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
      <input type="text" id="title" name="title" placeholder="Title" required><br>
      <input type="text" id="blog_content" name="blog_content" maxlength="2500" placeholder="Write your post here!" required><br>
      <h2>Add up to 3 tags to help users find your post:</h2>
      <input type="text" id="tag1" name="tag1" pattern="[A-Za-z]+" maxlength="20" placeholder="Tag #1"><br>      
      <input type="text" id="tag2" name="tag2" pattern="[A-Za-z]+" maxlength="20" placeholder="Tag #2"><br>
      <input type="text" id="tag3" name="tag3" pattern="[A-Za-z]+" maxlength="20" placeholder="Tag #3"><br>            
      <button type="submit" id="btn" name="newB">Create New Post</button>
    </form><br>
    <h2><a href="viewblogs.php">View Blogs</a></h2> 
    <h2><a href="homepage.php">Back to Homepage</a></h2> 
</div>
<div>
  <?php
  if(isset($_POST['newB'])){
    if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } 
    $title = $_POST['title'];
    $bcontent = $_POST['blog_content'];
    $tag1 = $_POST['tag1'];
    $tag2 = $_POST['tag2'];
    $tag3 = $_POST['tag3'];
    $currdate = date("Y-m-d");

    $title = stripcslashes($title);
    $bcontent = stripcslashes($bcontent);
    $title = mysqli_real_escape_string($conn_comp440, $title);
    $bcontent = mysqli_real_escape_string($conn_comp440, $bcontent);
    if($tag1 != null) {
      $tag1 = stripcslashes($tag1);
      $tag1 = mysqli_real_escape_string($conn_comp440, $tag1);
    }
    if($tag2 != null) {
      $tag2 = stripcslashes($tag2);
      $tag2 = mysqli_real_escape_string($conn_comp440, $tag2);
    }
    if($tag3 != null) {
      $tag3 = stripcslashes($tag3);
      $tag3 = mysqli_real_escape_string($conn_comp440, $tag3);
    }

    //get all blogs posted by user for current day
    $sql_num_posts = "SELECT * FROM blogs WHERE ownerUsername='$user_name' AND datePosted='$currdate'";
    $result_num_posts = mysqli_query($conn_comp440, $sql_num_posts);
    $count = mysqli_num_rows($result_num_posts);

    //if user has posted less than 2 posts in the current day, allow blog to be posted
    if($count < 2) {
      $sql = "INSERT INTO blogs (blogTitle, content, ownerUsername, datePosted)
        VALUES ('$title', '$bcontent', '$user_name', '$currdate')";
      if ($conn_comp440->query($sql) === TRUE) {
        // get blog id for future use
        $sql_get_blog_id = "SELECT blogId FROM blogs ORDER BY blogId DESC LIMIT 1";
        $result_get_blog_id = mysqli_query($conn_comp440, $sql_get_blog_id);
        $row = mysqli_fetch_assoc($result_get_blog_id);
        $blog_id = $row['blogId'];

        // see if tags need to be added
        if($tag1 != null) {
          $sql_check_tag_exist = "SELECT * FROM tags WHERE tagTitle='$tag1'";
          $result_check_tag_exist = mysqli_query($conn_comp440, $sql_check_tag_exist);
          $count = mysqli_num_rows($result_check_tag_exist);
          if($count == 0) {
            // insert tag into tag table
            $sql_insert_tag = "INSERT INTO tags (tagTitle) VALUES ('$tag1')";
            $result_insert_tag = mysqli_query($conn_comp440, $sql_insert_tag);

            // get the tag id for tag just added
            $sql_get_tag_id = "SELECT tagId FROM tags ORDER BY tagId DESC LIMIT 1";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          } else {
            // get the tag id
            $sql_get_tag_id = "SELECT tagId FROM tags WHERE tagTitle='$tag1'";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          }
        }
        if($tag2 != null && $tag2 != $tag1) {
          $sql_check_tag_exist = "SELECT * FROM tags WHERE tagTitle='$tag2'";
          $result_check_tag_exist = mysqli_query($conn_comp440, $sql_check_tag_exist);
          $count = mysqli_num_rows($result_check_tag_exist);
          if($count == 0) {
            // insert tag into tag table
            $sql_insert_tag = "INSERT INTO tags (tagTitle) VALUES ('$tag2')";
            $result_insert_tag = mysqli_query($conn_comp440, $sql_insert_tag);

            // get the tag id for tag just added
            $sql_get_tag_id = "SELECT tagId FROM tags ORDER BY tagId DESC LIMIT 1";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          } else {
            // get the tag id
            $sql_get_tag_id = "SELECT tagId FROM tags WHERE tagTitle='$tag2'";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          }
        }
        if($tag3 != null && $tag3 != $tag2 && $tag3 != $tag1) {
          $sql_check_tag_exist = "SELECT * FROM tags WHERE tagTitle='$tag3'";
          $result_check_tag_exist = mysqli_query($conn_comp440, $sql_check_tag_exist);
          $count = mysqli_num_rows($result_check_tag_exist);
          if($count == 0) {
            // insert tag into tag table
            $sql_insert_tag = "INSERT INTO tags (tagTitle) VALUES ('$tag3')";
            $result_insert_tag = mysqli_query($conn_comp440, $sql_insert_tag);

            // get the tag id for tag just added
            $sql_get_tag_id = "SELECT tagId FROM tags ORDER BY tagId DESC LIMIT 1";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          } else {
            // get the tag id
            $sql_get_tag_id = "SELECT tagId FROM tags WHERE tagTitle='$tag3'";
            $result_get_tag_id = mysqli_query($conn_comp440, $sql_get_tag_id);
            $row = mysqli_fetch_assoc($result_get_tag_id);
            $tag_id = $row['tagId'];
            // insert blog id and tag id into blog_tags table
            $sql_make_tag_assoc = "INSERT INTO blog_tags (blogId, tagId) VALUES ('$blog_id', '$tag_id')";
            $result_make_tag_assoc = mysqli_query($conn_comp440, $sql_make_tag_assoc);
          }
        }
      }
    } else {
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('You may not post more than two blogs per day, please try again tomorrow.');
          </script>");
    }
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Blog posted!');
    </script>");
  }
  ?>
</div>

</body>
</html>