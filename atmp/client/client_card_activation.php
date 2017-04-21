<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if(isset($_POST["logout"])){
    session_destroy();
    header('Location: client_login.php');
    exit();
  }

  if(isset($_POST["on"])){
    $query = "UPDATE card SET card_state = 1 WHERE card_number = '" . $_SESSION["card_no"] . "'";
    mysqli_query($conn, $query);

    header('Location: client_card_deactivation.php');
    exit();
  }

?>


<!DOCTYPE html>
<html>
<head>
  <title>ATM Fraud Detection System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/template.css">
</head>

<body>

  <div class="smart-green">
      
          <h1>ATM 
              <span>Fraud Detection System</span>
          </h1>

          <form method="post">
          <label>
            <div style="text-align: right;">
              <span>&nbsp;</span>
              <input type="submit" name="logout" class="button" value="Log out" style="background-color: red;">
            </div>
          </label> 
          </form>
          
          <div style="height: 60px; text-align: center;">
          <p style="font-size: 20px">
            Card State: 
            <b style="color: red;">OFF</b>
          </p>
          </div>

          <form method="post">
           <label>
              <span>&nbsp;</span> 
              <div style="text-align: center;"><input type="submit" name="on" class="button" value="Turn On" /></div>
          </label>    
          </form>

    </div>

</body>
</html>
