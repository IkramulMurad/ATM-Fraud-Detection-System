<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";

  if($_POST){
    $path = 'C:\\Python27\\python.exe';
    $py = 'C:\\xampp\\htdocs\\atmp\\admin\\sample.py';

    // This is the data you want to pass to Python
    $data = $_SESSION["account_no"];
    //echo $data;

    // Execute the python script with the JSON data
    exec('C:\\Python27\\python.exe C:\\xampp\\htdocs\\atmp\\face_recognition\\dataset_creator.py ' . $data);
    exec('C:\\Python27\\python.exe C:\\xampp\\htdocs\\atmp\\face_recognition\\trainer.py');

    header('Location: admin_success.php');
    exit();
    // Decode the result
    //$resultData = json_decode($result, true);

    // This will contain: making array
    //var_dump( explode( ',', $resultData ) );

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

          <ul>
            <li><p style="font-size: 16px;">To Complete the action, Face Scanning process must be proceed.</p></li>
            <li><p style="font-size: 16px;">Click "Start Scan" button to start the process</p></li>
          </ul>

          <form method="post">
            <label>
              <span>&nbsp;</span> 
              <div style="text-align: center;"><input type="submit" name="scan" class="button" value="Start Scan" /> </div>
            </label>            
          </form> 

    </div>

</body>
</html>
