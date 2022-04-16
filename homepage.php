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
<!-- foreign key checks: delete tables in order and you dont need to set this -->
<?php
  function initializeDb(){
    include("config.php");

    $conn_comp440->multi_query(file_get_contents('initialize.sql'));
  }
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Create Account</title>
  <link href="input.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h1>
    You're signed in!
  </h1>

  <!-- need the functionality to initialize database -->
  <button type="submit" name='initialize_db' onclick="onClickInit()">Initialize Database</button><br>
  <script>
    function onClickInit(){
      var init_db = "<?php initializeDb(); ?>";
      alert(init_db);
    }
  </script>


  <h2><a href="logout.php">Sign Out</a></h2>


</body>
</html>