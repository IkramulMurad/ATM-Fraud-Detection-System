<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";

  if(isset($_POST["face"])){
    header('Location: atm_face.php');
    exit();
  }
  else if (isset($_POST["pin"])) {
    header('Location: atm_pin.php');
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

    <p style="font-size: 20px;">Please choose your authentication method:</p>

    <form method="post">
    <label>
        <span>&nbsp;</span> 
        <div style="text-align: center;"><input type="submit" name="face" class="button" value="Face Recognition" style="width: 200px;" /> </div>
    </label> 
    </form>

    <form method="post">
    <label>
        <span>&nbsp;</span> 
        <div style="text-align: center;"><input type="submit" name="pin" class="button" value="PIN" style="width: 200px;" /> </div>
    </label> 
    </form>

    </div>

</body>
</html>
