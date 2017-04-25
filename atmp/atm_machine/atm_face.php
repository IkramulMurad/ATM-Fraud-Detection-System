<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";
  
  $query = "SELECT account_number FROM card WHERE card_number = '" . $_SESSION["card_no"] . "'";
  $res = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($res);
  $data = $row["account_number"];
  echo $data;

  if(isset($_POST["start"])){

    $result = exec('C:\\Python27\\python.exe C:\\xampp\\htdocs\\atmp\\face_recognition\\recognizer.py ' . $data);
    $resultData = json_decode($result, true);

    //echo $resultData;
    echo "<br>";
    var_dump(explode(',', $resultData));



    if($resultData == "no"){
      header('Location: atm_invalidface.php');
      exit();
    }
    else if ($resultData == "yes") {
      $_SESSION["auth"] = "face";
      header('Location: atm_transaction.php');
      exit();
    }

}
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>ATM Fraud Detection System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/template.css">

  <script>
    function dostuff() {
      document.getElementById('prompt').style.display = 'none';
      document.getElementById('alert').style.display = 'block';
      document.getElementById('button').style.display = 'none';
    }
  </script>
</head>



<body>

  <div class="smart-green">
      
    <h1>ATM 
      <span>Fraud Detection System</span>
    </h1>

    <div id="prompt"><p style="font-size: 20px;">Please press Start button to start face recognition process.</p></div>
    <div style="display: none;" id="alert"><p style="font-size: 20px;">Please stand in front of camera.</p></div>

    <form method="post" class="STYLE-NAME">
         <label>
            <span>&nbsp;</span> 
            <div id="button"><input type="submit" class="button" value="Start" name="start"  onclick="dostuff();" /></div>
        </label>    
    </form>

    </div>

</body>
</html>
