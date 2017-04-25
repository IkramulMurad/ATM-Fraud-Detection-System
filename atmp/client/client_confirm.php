<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);

  if(isset($_POST["yes"])){
    $myfile = fopen("clrl.txt", "w"); fwrite($myfile, "0"); fclose($myfile);
    $myfile = fopen("../atm_machine/atrl.txt", "w"); fwrite($myfile, "1"); fclose($myfile);

    header('Location: client_successful.php');
    exit();
  }

  if(isset($_POST["no"])){
    $myfile = fopen("clrl.txt", "w"); fwrite($myfile, "0"); fclose($myfile);
    $myfile = fopen("../atm_machine/atrl.txt", "w"); fwrite($myfile, "2"); fclose($myfile);
    
    header('Location: client_insecureattempt.php');
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

  <div class="smart-green" style="height: 150px;">
      
    <h1>ATM 
      <span>Fraud Detection System</span>
    </h1>

    <p style="font-size: 20px;">Do you want to confirm the transaction?</p>

    <form method="post">
     <label>
        <span>&nbsp;</span> 
        <div style="float: left; width: 70px; margin-left: 5pc;"><input type="submit" name="yes" class="button" value="YES" /></div>
    </label>    
    </form>

    <form method="post">
     <label>
        <span>&nbsp;</span> 
        <div style="float: left; width: 70px; margin-left: 20px;"><input type="submit" name="no" class="button" value="NO" style="background-color: red;" /></div>
    </label>    
    </form>

  </div>

</body>
</html>
