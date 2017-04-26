<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
?>

<!DOCTYPE html>
<html>
<head>
  <title>ATM Fraud Detection System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/template.css">
  <script src="../style/jquery.min.js" type="text/javascript"></script>
</head>

<body>

  <div class="smart-green">
      
    <h1>ATM 
      <span>Fraud Detection System</span>
    </h1>

    <p style="font-size: 20px;">Confirm your transaction from your account.</p>

  </div>

  <script>
      setInterval(checkVariableValue, 2500);
      function checkVariableValue() {
           $.ajax({
                method: 'POST',
                url: 'atrl.txt',
                datatype: 'text',
                success: function(data) {
                  var x = data;
                  if(x == "1"){
                    window.location.href = "atm_success.php";
                  }
                  else if(x == "2"){
                    window.location.href = "atm_insecureattempt.php";
                  }
                  else{
                    console.log("no: " + x);
                  }

                }
           });
      }
  </script>

</body>
</html>
