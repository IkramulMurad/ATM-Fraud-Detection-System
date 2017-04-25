<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $myfile = fopen("atrl.txt", "w"); fwrite($myfile, "0"); fclose($myfile);

  session_destroy();
  header('Refresh : 10; url = atm_cardenter.php');
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

    <p style="font-size: 20px;">Insecure Transaction Attempt.</p>

    </div>

</body>
</html>
