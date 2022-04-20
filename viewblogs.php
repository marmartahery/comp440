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
    <title>View Blogs</title>
    <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
    <h2><a href="homepage.php">Back to Homepage</a></h2>
    <br><button type="submit"><a href="newblog.php">New Blog Post</a></button><br>
    <div>
        <?php

        // get the total number of blogs
        $sql_count_blogs = "SELECT COUNT(*) FROM blogs";
        $num_blogs = mysqli_query($conn_comp440, $sql_count_blogs);
        $row_count = mysqli_fetch_array($num_blogs);
        $blog_count = $row_count[0];

        // get all the blogs
        $sql_get_blogs = "SELECT * FROM blogs";
        $result_blogs = mysqli_query($conn_comp440, $sql_get_blogs);

        if ($result_blogs->num_rows > 0) {
            while ($row = $result_blogs->fetch_assoc()) {
                $blog_id = $row['blogId'];

                echo "<div class='card'>";
                echo "<div class='container'>";
                echo "<p class='blog-title'>Title: " . $row["blogTitle"] . "</p>";
                echo "<p class='blog-owner'>&nbsp&nbspAuthor: ". $row["ownerUsername"] ."</p>";
                echo "<p class='date'>&nbsp&nbsp&nbsp". $row["datePosted"] . "</p>";
                echo "<br><p class='blog-content'>“" . $row["content"] . "” </p>";

                // add associated tags to blog post
                $sql_get_tags = "SELECT tagTitle FROM tags WHERE tagId IN (SELECT tagId FROM blog_tags WHERE blogId=$blog_id)";
                $result_tags = mysqli_query($conn_comp440, $sql_get_tags);
                echo "<br><p class='tags'>Tags:";
                if ($result_tags->num_rows > 0) {
                    while ($row = $result_tags->fetch_assoc()) {
                        // echo "<p class='tags'>" .$row["tagTitle"]."</p>";
                        echo " ‘" . $row["tagTitle"] . "’ ";
                    }
                }
                echo "</p>";
                echo "<hr>";

                // add associated comments to blog post
                $sql_get_comments = "SELECT content, datePosted, ownerUsername, sentiment FROM comments WHERE commentId IN (SELECT commentId FROM blog_comments WHERE blogId=$blog_id)";
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
               echo "<form action='viewblogs.php' method='POST'>";
               echo "<input class='comment-area' type='textarea' style='resize: none; height:100px' id='content' name='content' minlength=1 maxlength=250 placeholder='Leave a comment...' required><br>";
               echo "<p class='comment-section-title'>Did you like this post?</p>";
               echo "<input class='radiostyle' type='radio' id='yes' name='sentiment' value=1 checked>";                
               echo "<label class='comment-section-title' for='yes'>&nbsp&nbspYes</label><br>";
               echo "<input class='radiostyle' type='radio' id='no' name='sentiment' value=0>";
               echo "<label class='comment-section-title'for='no'>&nbsp&nbspNo</label><br>";
               echo "<input type='hidden' id='blogId' name='blogId' value='$blog_id'>";
               echo "<button type='submit' name=insert value='Post Comment'>Post Comment</button>";
               echo "</form>";
               echo "</div>";
               echo "</div>";
               echo "<br>";
            }
        }
        ?>
    </div>

    <?php
    if(isset($_POST['insert'])){
        $content = $_POST['content'];
        $blog_id = $_POST['blogId'];
        $username = $_SESSION["login_user"];
        $sentiment = $_POST['sentiment'];
        $current_date = date("Y-m-d");

        $content = stripcslashes($content);
        $content = mysqli_real_escape_string($conn_comp440, $content);

        // get all comments posted by user for current day
        $sql_num_comments = "SELECT * FROM comments WHERE ownerUsername='$username' AND datePosted='$current_date'";
        $result_num_comments = mysqli_query($conn_comp440, $sql_num_comments);
        $count = mysqli_num_rows($result_num_comments);

        // get author of post
        $sql_get_owner_username = "SELECT * FROM blogs WHERE blogId='$blog_id'";
        $result_get_owner_username = mysqli_query($conn_comp440, $sql_get_owner_username);
        $row = mysqli_fetch_assoc($result_get_owner_username);
        $owner_username = $row['ownerUsername'];

        // get all the comments on the current blog posted by the current user
        $sql_get_user_comms = "SELECT * FROM comments WHERE commentId IN (SELECT commentId FROM blog_comments WHERE blogId=$blog_id) AND ownerUsername='$username'";
        $result_num_user_comms = mysqli_query($conn_comp440, $sql_get_user_comms);
        $num_user_comms = mysqli_num_rows($result_num_user_comms);    

        // if user is trying to comment on their own post, disallow
        // if user has already commented on the current post, disallow
        if($owner_username != $username && $num_user_comms == 0){
            // if user has posted less than 3 comments in the current day, allow to post comment
            if($count < 3) {
                $sql = "INSERT INTO comments (content, datePosted, ownerUsername, sentiment) 
                        VALUES ('$content', '$current_date', '$username', $sentiment)";
                if ($conn_comp440->query($sql) === TRUE) {
                    // insert into relation table
                    $sql_comm_id = "SELECT commentId FROM comments ORDER BY commentId DESC LIMIT 1";
                    $result_comm_id = mysqli_query($conn_comp440, $sql_comm_id);
                    while ($row = $result_comm_id->fetch_assoc()) {
                        $comment_id = $row["commentId"];
                    }
                    $sql2 = "INSERT INTO blog_comments (blogId, commentId) VALUES ($blog_id, $comment_id)";
                    if($conn_comp440->query($sql2) === TRUE){
                        echo ("<script LANGUAGE='Javascript'>window.location.href = window.location.href;</script>");
                    } else {
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Something went wrong...');
                        </script>");
                    }
                }
            } else {
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('You may not post more than three comments per day, please try again tomorrow.');
                    </script>");
            }
        } else {
            if($owner_username == $username) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('You may not comment on your own post.');
                </script>");
            } else {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('You may not comment more than once on a post.');
                </script>");
            }
        }
    }
    ?>

    <br>
    <h2><a href="homepage.php">Back to Homepage</a></h2>
</body>

</html>