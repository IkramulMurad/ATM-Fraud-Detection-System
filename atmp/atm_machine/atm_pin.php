<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if($_POST){
    $errors = array();
    
    if(empty($_POST["pin"])){
      $errors["pin_e_error"] = "PIN number can't be empty";
    }


    if(count($errors) == 0){
      $query = "SELECT * FROM card WHERE card_number = '" . $_SESSION["card_no"] . "'";

      $result = mysqli_query($conn, $query);
      
      $row = mysqli_fetch_assoc($result);
      echo $row["card_number"]." - ".$row["card_state"]." - ".$row["pin"];
      

      if($_POST["pin"] != $row["pin"]){
        header('Location: atm_invalidpin.php');
        exit();
      }
      else{
        $_SESSION["auth"] = "pin";
        header('Location: atm_transaction.php');
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
              <span>Enter PIN Number :</span>
              <input id="pin" type="password" name="pin" placeholder="Enter Your PIN.." />
              <?php
                if(isset($errors["pin_e_error"])) echo "<p style='color: red;'>" . $errors["pin_e_error"] . "</p>";
              ?>
          </label> <br>

           <label>
              <span>&nbsp;</span> 
              <input type="submit" class="button" value="Submit" /> 
          </label>    
      </form>

    </div>

</body>
</html>
