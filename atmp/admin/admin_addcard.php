<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";

  if($_POST){
    $errors = array();
    
    if(empty($_POST["card_no"])){
      $errors["card_e_error"] = "Card Number can't be empty";
    }
    if(empty($_POST["account_no"])){
      $errors["account_e_error"] = "Account Number can't be empty";
    }
    if(empty($_POST["pin"])){
      $errors["pin_e_error"] = "PIN Number can't be empty";
    }

    if(count($errors) == 0){
      $query = "INSERT INTO card(card_number, account_number, card_state, pin) VALUES('" . $_POST["card_no"] . "', '" . $_POST["account_no"] . "' , 0 , '" . $_POST["pin"] . "')";
      mysqli_query($conn, $query);

      $_SESSION["type"] = "Card";
      header('Location: admin_success.php');
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
</head>

<body>

  <div class="smart-green">
      
      <form method="post" class="STYLE-NAME">
          <h1>ATM 
              <span>Fraud Detection System</span>
          </h1>
          <label>
              <span>Card number :</span>
              <input id="card_no" type="text" name="card_no" placeholder="Enter Card Number.." />
              <?php
                if(isset($errors["card_e_error"])) echo "<p style='color: red;'>" . $errors["card_e_error"] . "</p>";
              ?>
          </label>
          
          <label>
              <span>Account number :</span>
              <input id="account_no" type="text" name="account_no" placeholder="Enter Account Number for Card.." />
              <?php
                if(isset($errors["account_e_error"])) echo "<p style='color: red;'>" . $errors["account_e_error"] . "</p>";
              ?>
          </label>

          <label>
              <span>PIN :</span>
              <input id="pin" type="text" name="pin" placeholder="Enter PIN for Card.." />
              <?php
                if(isset($errors["pin_e_error"])) echo "<p style='color: red;'>" . $errors["pin_e_error"] . "</p>";
              ?>
          </label>

           <label>
              <span>&nbsp;</span> 
              <input type="submit" class="button" value="Add" /> 
          </label>    
      </form>

    </div>

</body>
</html>
