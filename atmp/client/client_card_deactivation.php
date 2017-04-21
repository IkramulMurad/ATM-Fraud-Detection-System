<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";


  if(isset($_POST["off"])){
    $query = "UPDATE card SET card_state = 0 WHERE card_number = '" . $_SESSION["card_no"] . "'";
    mysqli_query($conn, $query);

    header('Location: client_card_activation.php');
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
          
          <div style="height: 60px; text-align: center;">
          <p style="font-size: 20px">
            Card State: 
            <b style="color: green;">ON</b>
          </p>
          </div>

          <form method="post">
           <label>
              <span>&nbsp;</span> 
              <div style="text-align: center;"><input type="submit" name="off" class="button" value="Turn Off" /></div>
          </label>    
          </form>

    </div>

</body>
</html>
