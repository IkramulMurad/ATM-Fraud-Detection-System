<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if(isset($_SESSION["balance"]) && isset($_SESSION["account_no"])){
    $balance = $_SESSION["balance"];
    $acc_no = $_SESSION["account_no"];
  }

  if(isset($_SESSION["blnc"]) && isset($_SESSION["acc_no"])){
    $balance = $_SESSION["blnc"];
    $acc_no = $_SESSION["acc_no"];
  }

  $myfile = fopen("query.txt", "r"); $query = fread($myfile, filesize("query.txt")); fclose($myfile);
  mysqli_query($conn, $query);

  $myfile = fopen("atrl.txt", "w"); fwrite($myfile, "0"); fclose($myfile);

  header('Refresh : 15; url = atm_cardenter.php');
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
      
      <form method="post" class="STYLE-NAME">
          <h1>ATM 
              <span>Fraud Detection System</span>
          </h1>
          <p style="font-size: 20px;">Transaction Succesfull!</p>
          <p style="font-size: 20px;">Thank You</p>

      </form>

    </div>

</body>
</html>
