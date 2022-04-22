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
            echo 'button 1 worked!';
        }
        if(isset($_POST['button2'])){
            echo 'button 2 worked!';
        }
        if(isset($_POST['button3'])){
            echo 'button 3 worked!';
        }
        if(isset($_POST['button4'])){
            echo 'button 4 worked!';
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