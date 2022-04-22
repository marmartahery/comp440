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
    <h2><a href="part3.php">Back to Part 3 Queries Page</a></h2>
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
                    echo "('" . $row5["user"] . "',";
                    echo " '" . $row5["user2"] . "')";
                    echo "<br>";
                } 
            }else {
                echo ("Returned no results :( ");
              }
        }
        if(isset($_POST['button6'])){
            $qry6 = "SELECT username FROM comp440.user 
            LEFT JOIN comp440.blogs ON user.username=blogs.ownerUsername WHERE blogs.blogId is NULL";
            $sql6 = mysqli_query($conn_comp440, $qry6);
            if ($sql6->num_rows > 0) {
                echo "<br>";
                while ($row6 = $sql6->fetch_assoc()) {
                    echo " '" . $row6["username"] . "' ";
                  }
                } else {
                  echo ("Returned no results :( ");
                }
            }
        if(isset($_POST['button7'])){
            $qry7 = "SELECT username
            FROM comp440.user
            LEFT JOIN comp440.comments
            ON user.username=comments.ownerUsername
            WHERE comments.commentId is NULL";
            $sql7 = mysqli_query($conn_comp440, $qry7); 

            if ($sql7->num_rows > 0) {
                echo "<br>";
                while ($row7 = $sql7->fetch_assoc()) {
                    echo " '" . $row7["username"] . "' ";
                }
            } else {
                echo ("Returned no results :(");
            }
        }
        if(isset($_POST['button8'])){
            $qry8 = "SELECT ownerUsername 
            FROM (SELECT ownerUsername, SUM(sentiment) AS sum 
            FROM comments GROUP BY ownerUsername) AS result WHERE sum = 0";
            $sql8 = mysqli_query($conn_comp440, $qry8);
            if ($sql8->num_rows > 0) {
                echo "<br>";
                while ($row8 = $sql8->fetch_assoc()) {
                  echo " '" . $row8["ownerUsername"] . "' ";
                }
              } else {
                echo ("Returned no results :( ");
              }
        } 
        if(isset($_POST['button9'])){
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
                  echo " '" . $row9["ownerUsername"] . "' ";
                }
            } else {
                echo ("Returned no results :(");
            }
        }
    ?>
</body>

</html>