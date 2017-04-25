<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  $myfile = fopen("alert.txt", "w"); fwrite($myfile, "0"); fclose($myfile);

  if($_POST){
    $_SESSION["card_no"] = $_POST["card_no"];

    $errors = array();
    
    if(empty($_POST["card_no"])){
      $errors["card_e_error"] = "Card number can't be empty";
    }


    if(count($errors) == 0){
      $query = "SELECT * FROM card WHERE card_number = '" . $_POST["card_no"] . "'";

      $result = mysqli_query($conn, $query);
      
      $row = mysqli_fetch_assoc($result);
      echo $row["card_number"]." - ".$row["card_state"]." - ".$row["pin"];
      

      if(mysqli_num_rows($result) == 0){
        header('Location: atm_cardinvalid.php');
        exit();
      }
      else if($row["card_state"] == 0){
        header('Location: atm_cardinactive.php');
        exit();
      }
      else{
        header('Location: atm_cardauthentication.php');
        exit();
      }
    }

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
      
      <form method="post" class="STYLE-NAME">
          <h1>ATM 
              <span>Fraud Detection System</span>
          </h1>
          <label>
              <span>Enter Card Number :</span>
              <input id="card_no" type="text" name="card_no" placeholder="Enter Your Card Number.." />
              <?php
                if(isset($errors["card_e_error"])) echo "<p style='color: red;'>" . $errors["card_e_error"] . "</p>";
              ?>
          </label> <br>

           <label>
              <span>&nbsp;</span> 
              <input type="submit" class="button" value="Enter" /> 
          </label>    
      </form>

  </div>

</body>
</html>
