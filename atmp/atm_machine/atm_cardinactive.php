<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";

  if(isset($_POST["submit"])){
    header('Location: atm_cardenter.php');
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
    <p style="font-size: 20px;">Card Inactive!</p>
    <p style="font-size: 20px;">Please Activate your card before using.</p>
    <form method="post">
     <label>
      <span>&nbsp;</span> 
      <input type="submit" class="button" value="Retry" name="submit" /> 
     </label>    
    </form>

  </div>

</body>
</html>
