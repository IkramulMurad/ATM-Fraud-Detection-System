<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $myfile = fopen("atrl.txt", "w"); fwrite($myfile, "0"); fclose($myfile);
  $myfile = fopen("alert.txt", "w"); fwrite($myfile, "1"); fclose($myfile);

  session_destroy();
  header('Refresh : 18; url = atm_cardenter.php');
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

    <p style="font-size: 20px;">Insecure Transaction Attempt.</p>

  </div>

  <audio id="alert" src="alert.mp3" ></audio>

  <script>
      setInterval(checkVariableValue, 2000);
      function checkVariableValue() {
           $.ajax({
                method: 'POST',
                url: 'alert.txt',
                datatype: 'text',
                success: function(data) {
                  var x = data;
                  if(x == "1"){
                    var alert = document.getElementById("alert");
                    alert.play();
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
