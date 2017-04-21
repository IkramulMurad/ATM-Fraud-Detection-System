<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if($_POST){
    $_SESSION["card_no"] = $_POST["card_no"];

    $errors = array();
    
    if(empty($_POST["card_no"])){
      $errors["card_e_error"] = "Card number can't be empty";
    }
    if(empty($_POST["account_no"])){
      $errors["account_e_error"] = "Card number can't be empty";
    }


    if(count($errors) == 0){
      $query = "SELECT user.account_number, user.password, card.card_number, card.card_state FROM user JOIN card ON user.account_number = card.account_number WHERE user.account_number = '" . $_POST["account_no"] . "' AND card.card_number = '" . $_POST["card_no"] . "'";

      $result = mysqli_query($conn, $query);
      
      $row = mysqli_fetch_assoc($result);
      echo $row["account_number"]." - ".$row["card_number"]." - ".$row["card_state"]." - ".$row["password"];
      
      if(mysqli_num_rows($result) == 0){
        $errors["invalid"] = "Incorrect account number or card number";
      }
      if($_POST["password"] != $row["password"]){
        $errors["password"] = "Incorrect Password!";
      }

      if(count($errors) == 0){
        header('Location: client_card_activation.php');
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
              <span>Card Number :</span>
              <input id="card_no" type="text" name="card_no" placeholder="Enter Your Card Number.." />
              <?php
                if(isset($errors["card_e_error"])) echo "<p style='color: red;'>" . $errors["card_e_error"] . "</p>";
                if(isset($errors["invalid"])) echo "<p style='color: red;'>" . $errors["invalid"] . "</p>";
              ?>
          </label>
          
          <label>
              <span>Account Number :</span>
              <input id="account_no" type="text" name="account_no" placeholder="Enter Your Account Number.." />
              <?php
                if(isset($errors["account_e_error"])) echo "<p style='color: red;'>" . $errors["account_e_error"] . "</p>";
                if(isset($errors["invalid"])) echo "<p style='color: red;'>" . $errors["invalid"] . "</p>";
              ?>
          </label>
            
          <label>
              <span>Password :</span>
              <input id="password" type="password" name="password" placeholder="Enter Your Password.." />
              <?php
                if(isset($errors["password"])) echo "<p style='color: red;'>" . $errors["password"] . "</p>";
              ?>
          </label>

           <label>
              <span>&nbsp;</span> 
              <input type="submit" class="button" value="Log In" /> 
          </label>    
      </form>

    </div>

</body>
</html>
