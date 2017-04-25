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
    
    if(empty($_POST["amount"])){
      $errors["amount_e_error"] = "Amount can't be empty";
    }

    $amount = (int)$_POST["amount"];
    if($amount < 100){
      $errors["amount_less_error"] = "Amount should be at least 100.";
    }

    //echo $_SESSION["card_no"] . "found";

    $query = "SELECT * FROM user JOIN card ON user.account_number = card.account_number WHERE card.card_number = '" . $_SESSION["card_no"] . "'";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_assoc($result);
    //echo "<br>" . $row["balance"] . " - " . $row["account_number"];

    $newBalance = (float)$row["balance"] - $amount;
    //echo $newBalance;

    if(count($errors) == 0){

      if((int)$row["balance"] < $amount){
        $errors["amount_insuf_error"] = "Insufficient balance!";  
      }
      else{
        $query = "UPDATE user SET balance = '" . $newBalance . "' WHERE account_number = '" . $row["account_number"] . "'";
        $myfile = fopen("query.txt", "w"); fwrite($myfile, $query); fclose($myfile);

        if ($_SESSION["auth"] == "face") {
          //mysqli_query($conn, $query);
          header('Location: atm_success.php');
          exit();
        }
        else if($_SESSION["auth"] == "pin"){
          $myfile = fopen("../client/clrl.txt", "w"); fwrite($myfile, "1"); fclose($myfile);

          //header('Location: atm_success.php');
          header('Location: atm_confirmclient.php');
          exit();
        }
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
              <span>Enter Amount :</span>
              <input id="amount" type="text" name="amount" placeholder="Enter Your Amount.." />
              <?php
                if(isset($errors["amount_e_error"])) echo "<p style='color: red;'>" . $errors["amount_e_error"] . "</p>";
                if(isset($errors["amount_less_error"])) echo "<p style='color: red;'>" . $errors["amount_less_error"] . "</p>";
                if(isset($errors["amount_insuf_error"])) echo "<p style='color: red;'>" . $errors["amount_insuf_error"] . "</p>";
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
