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
    
    if(empty($_POST["name"])){
      $errors["name_e_error"] = "Name can't be empty";
    }
    if(empty($_POST["account_no"])){
      $errors["account_e_error"] = "Account Number can't be empty";
    }
    if(empty($_POST["password"])){
      $errors["password_e_error"] = "Password can't be empty";
    }

    if(count($errors) == 0){
      $query = "INSERT INTO user(name, account_number, password, balance) VALUES('" . $_POST["name"] . "', '" . $_POST["account_no"] . "', '" . $_POST["password"] . "', 0)";
      mysqli_query($conn, $query);

      $_SESSION["type"] = "Client";
      $_SESSION["account_no"] = $_POST["account_no"];
      header('Location: admin_scanface.php');
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
              <span>Name :</span>
              <input id="name" type="text" name="name" placeholder="Enter Client Name.." />
              <?php
                if(isset($errors["name_e_error"])) echo "<p style='color: red;'>" . $errors["name_e_error"] . "</p>";
              ?>
          </label>
          
          <label>
              <span>Account number :</span>
              <input id="account_no" type="text" name="account_no" placeholder="Enter Account Number.." />
              <?php
                if(isset($errors["account_e_error"])) echo "<p style='color: red;'>" . $errors["account_e_error"] . "</p>";
              ?>
          </label>

          <label>
              <span>Password :</span>
              <input id="password" type="text" name="password" placeholder="Enter Password for Account.." />
              <?php
                if(isset($errors["password_e_error"])) echo "<p style='color: red;'>" . $errors["password_e_error"] . "</p>";
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
