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
    <title>First Query</title>
    <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        if(isset($_POST['button1'])){
            $tagX = $_POST['tagX'];
            $tagY = $_POST['tagY'];

            // if they entered the same tag twice, send back to query page
            if($tagX == $tagY) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Please enter two different tags for Query 1.');
                window.location.href='http://localhost:3000/part3.php';
                </script>");
            }

            echo "<p><h3>List the users who post at least two blogs, one has a tag of '$tagX', and another has a tag of '$tagY':</p></h3>";
            $qry1 = "SELECT DISTINCT ownerUsername
            FROM
                (SELECT table1.bID1, table1.tag1, table2.bID2, table2.tag2,table1.ownerUsername
                FROM
                    (SELECT blogs.blogId AS bID1, result1.tagTitle AS tag1, ownerUsername
                    FROM blogs
                    RIGHT JOIN
                        (SELECT tagTitle, blog_tags.blogId, blog_tags.id
                        FROM blog_tags
                        LEFT JOIN tags
                        ON tags.tagId=blog_tags.tagId
                        WHERE tagTitle LIKE '$tagX') AS result1
                    ON blogs.blogId=result1.blogId) AS table1
                JOIN
                    (SELECT blogs.blogId AS bID2, result2.tagTitle AS tag2, ownerUsername
                    FROM blogs
                    RIGHT JOIN
                        (SELECT tagTitle, blog_tags.blogId, blog_tags.id
                        FROM blog_tags
                        LEFT JOIN tags
                        ON tags.tagId=blog_tags.tagId
                        WHERE tagTitle LIKE '$tagY') AS result2
                    ON blogs.blogId=result2.blogId) AS table2
                ON table1.ownerUsername=table2.ownerUsername AND table1.bID1!=table2.bID2 AND table1.tag1!=table2.tag2) AS query1";
            $sql1 = mysqli_query($conn_comp440, $qry1);

            if ($sql1->num_rows > 0) {
                echo "<br>";
                while ($row1 = $sql1->fetch_assoc()) {
                    echo "<h4>";
                    echo " ‘" . $row1["ownerUsername"] . "’ ";
                    echo "</h4>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
        if(isset($_POST['button2'])){
            $usernameX = $_POST['usernameX'];
            
            echo "<p><h3>List all the blogs of user '$usernameX', such that all the comments are positive for these blogs:</p></h3>";
            $qry2 = "SELECT * FROM blogs
            WHERE ownerUsername='$usernameX' 
            AND blogId NOT IN (
                SELECT blogs.blogId FROM blogs
                RIGHT JOIN(
                    SELECT blogId
                    FROM comp440.comments
                    RIGHT JOIN comp440.blog_comments
                    ON comments.commentId=blog_comments.commentId
                    WHERE sentiment='0') AS results ON blogs.blogId = results.blogId)
            AND blogId IN (
                SELECT blogId FROM blog_comments)";
            $sql2 = mysqli_query($conn_comp440, $qry2);

            if ($sql2->num_rows > 0) {
                echo "<br>";
                while ($row2 = $sql2->fetch_assoc()) {
                    echo "<div class='card'>";
                    echo "<div class='container'>";
                    echo "<p class='blog-title'>Title: " . $row2["blogTitle"] . "</p>";
                    echo "<p class='blog-owner'>&nbsp&nbspAuthor: ". $row2["ownerUsername"] ."</p>";
                    echo "<p class='date'>&nbsp&nbsp&nbsp". $row2["datePosted"] . "</p>";
                    echo "<br><p class='blog-content'>“" . $row2["content"] . "” </p>";

                    // add associated tags to blog post
                    $blog_id = $row2["blogId"];
                    $sql_get_tags = "SELECT tagTitle FROM tags WHERE tagId IN (SELECT tagId FROM blog_tags WHERE blogId=$blog_id)";
                    $result_tags = mysqli_query($conn_comp440, $sql_get_tags);
                    echo "<br><p class='tags'>Tags:";
                    if ($result_tags->num_rows > 0) {
                        while ($row_tags = $result_tags->fetch_assoc()) {
                            echo "<h4>";
                            echo " ‘" . $row_tags["tagTitle"] . "’ ";
                            echo "</h4>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<br>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
        if(isset($_POST['button3'])){
            echo "<p><h3>Lists the users who posted the most number of blogs on 5/1/2022; if there is a tie, then all of the users in the tie will be listed.</p></h3>";
            // get max number of blogs posted by a single user on 2022-05-01
            $qry3part1 = "SELECT MAX(numBlogs) AS maxNumBlogs
            FROM (SELECT COUNT(ownerUsername) AS numBlogs
                  FROM comp440.blogs
                  WHERE datePosted='2022-05-01'
                  GROUP BY ownerUsername) AS t";
            $sql3part1 = mysqli_query($conn_comp440, $qry3part1);
            $row3p1 = mysqli_fetch_assoc($sql3part1);
            $maxBlogs = $row3p1['maxNumBlogs'];
            echo "$maxBlogs";
            
            // get every user who posted this max number of blogs
            // use previous query result as $maxBlogs
            $qry3part2 = "SELECT ownerUsername 
            FROM (SELECT ownerUsername, COUNT(ownerUsername) AS numEach
                FROM comp440.blogs
                WHERE datePosted='2022-05-01'
                GROUP BY ownerUsername) AS numBlogsEach
                WHERE numEach=$maxBlogs";
            $sql3part2 = mysqli_query($conn_comp440, $qry3part2);

            if ($sql3part2->num_rows > 0) {
                echo "<br>";
                while ($row3p2 = $sql3part2->fetch_assoc()) {
                    echo "<h4>";
                    echo " ‘" . $row3p2["ownerUsername"] . "’ ";
                    echo "</h4>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
        if(isset($_POST['button4'])){
            $usernameX2 = $_POST['usernameX2'];
            $usernameY2 = $_POST['usernameY2'];

            // if they entered the same username twice, send back to queries page
            if($usernameX2 == $usernameY2) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Please enter two different usernames for Query 4.');
                window.location.href='http://localhost:3000/part3.php';
                </script>");
            }

            echo "<p><h3>List the users who are followed by both $usernameX2 and $usernameY2.</p></h3>";
            $qry4 = "SELECT followingUser AS userBeingFollowedByBoth
            FROM (SELECT followingUser, COUNT(*) AS `count`
                FROM user_following
                WHERE user IN('$usernameX2', '$usernameY2')
                GROUP BY followingUser) AS result 
                WHERE count>1";
            $sql4 = mysqli_query($conn_comp440, $qry4);

            if ($sql4->num_rows > 0) {
                echo "<br>";
                while ($row4 = $sql4->fetch_assoc()) {
                    echo "<h4>";
                    echo " ‘" . $row4["userBeingFollowedByBoth"] . "’ ";
                    echo "</h4>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
        if(isset($_POST['button5'])){
            echo "<p><h3> Lists user pairs ('X', 'Y') such that they have at least one common hobby. </h3></p>";
            $qry5 = "SELECT DISTINCT user, user2 FROM
            (SELECT hobbyId AS hID, user, result.user2
            FROM user_hobbies
            JOIN
            (SELECT user AS user2 , hobbyId
            FROM user_hobbies) AS result
            USING (hobbyId)
            WHERE user != user2 AND user < user2
            ORDER BY hID ASC) AS result2";
            $sql5 = mysqli_query($conn_comp440, $qry5);
            if ($sql5->num_rows > 0) {
                echo "<br>";
                while ($row5 = $sql5->fetch_assoc()) {
                    echo "<h4>";
                    echo "('" . $row5["user"] . "',";
                    echo " '" . $row5["user2"] . "')";
                    echo "<br>";
                    echo "</h4>";
                } 
            }else {
                echo "<h4>";
                echo ("Returned no results :( ");
                echo "</h4>";
              }
        }
        if(isset($_POST['button6'])){
            echo "<p><h3> Displays all the users who have yet to post a blog. </p></h3>";
            $qry6 = "SELECT username FROM comp440.user 
            LEFT JOIN comp440.blogs ON user.username=blogs.ownerUsername WHERE blogs.blogId is NULL";
            $sql6 = mysqli_query($conn_comp440, $qry6);
            if ($sql6->num_rows > 0) {
                echo "<br>";
                while ($row6 = $sql6->fetch_assoc()) {
                    echo "<h4>";
                    echo " '" . $row6["username"] . "' ";
                    echo "</h4>";
                  }
                } else {
                    echo "<h4>";
                    echo ("Returned no results :( ");
                    echo "</h4>";
                }
            }
        if(isset($_POST['button7'])){
            echo "<p><h3> Displays all the users who have yet to post a comment. </p><h3>";
            $qry7 = "SELECT username
            FROM comp440.user
            LEFT JOIN comp440.comments
            ON user.username=comments.ownerUsername
            WHERE comments.commentId is NULL";
            $sql7 = mysqli_query($conn_comp440, $qry7); 

            if ($sql7->num_rows > 0) {
                echo "<br>";
                while ($row7 = $sql7->fetch_assoc()) {
                    echo "<h4>";
                    echo " '" . $row7["username"] . "' ";
                    echo "</h4>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
        if(isset($_POST['button8'])){
            echo "<p><h3> Displays all the users who have only posted negative comments. </p><h3>";
            $qry8 = "SELECT ownerUsername 
            FROM (SELECT ownerUsername, SUM(sentiment) AS sum 
            FROM comments GROUP BY ownerUsername) AS result WHERE sum = 0";
            $sql8 = mysqli_query($conn_comp440, $qry8);
            if ($sql8->num_rows > 0) {
                echo "<br>";
                while ($row8 = $sql8->fetch_assoc()) {
                    echo "<h4>";
                    echo " '" . $row8["ownerUsername"] . "' ";
                    echo "</h4>";
                }
              } else {
                echo "<h4>";
                echo ("Returned no results :( ");
                echo "</h4>";
              }
        } 
        if(isset($_POST['button9'])){
            echo "<p><h3> Displays users who have yet to receive a negative comment on any of their blogs. </p><h3>";
            $qry9 = "SELECT ownerUsername FROM blogs
                    WHERE ownerUsername NOT IN 
                    (SELECT ownerUsername FROM blogs
                    RIGHT JOIN(SELECT blogId
                        FROM comp440.comments
                        RIGHT JOIN comp440.blog_comments
                        ON comments.commentId=blog_comments.commentId
                        WHERE sentiment='0') AS results 
                    ON blogs.blogId = results.blogId)
                    GROUP BY ownerUsername";
            $sql9 = mysqli_query($conn_comp440, $qry9); 

            if ($sql9->num_rows > 0) {
                echo "<br>";
                while ($row9 = $sql9->fetch_assoc()) {
                    echo "<h4>";
                    echo " '" . $row9["ownerUsername"] . "' ";
                    echo "</h4>";
                }
            } else {
                echo "<h4>";
                echo ("Returned no results :(");
                echo "</h4>";
            }
        }
    ?>
    <br>
    <h2><a href="part3.php">Back to Part 3 Queries Page</a></h2>
</body>

</html>