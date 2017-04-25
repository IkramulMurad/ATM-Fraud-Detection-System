<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";
  $myfile = fopen("card.txt", "r"); $card = fread($myfile, filesize("card.txt")); fclose($myfile);
  echo $card;

  if(isset($_POST["off"])){
    
    $query = "UPDATE card SET card_state = 0 WHERE card_number = '" . $card . "'";
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
  <script src="../style/jquery.min.js" type="text/javascript"></script>
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

    <script>
        setInterval(checkVariableValue, 5000);
        function checkVariableValue() {
             $.ajax({
                  method: 'POST',
                  url: 'clrl.txt',
                  datatype: 'text',
                  success: function(data) {
                    var x = data;
                    if(x == "1"){
                      window.location.href = "client_confirm.php";
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
