<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if($_POST){
    $_SESSION["id"] = $_POST["id"];

    $errors = array();
    
    if(empty($_POST["id"])){
      $errors["id_e_error"] = "ID can't be empty";
    }

    if(count($errors) == 0){
      $query = "SELECT * FROM admin WHERE id = '" . $_POST["id"] . "'";

      $result = mysqli_query($conn, $query);
      
      $row = mysqli_fetch_assoc($result);
      echo $row["id"] . " - " . $row["password"];
      
      if(mysqli_num_rows($result) == 0){
        $errors["invalid"] = "Invalid ID";
      }
      if($_POST["password"] != $row["password"]){
        $errors["password"] = "Incorrect Password!";
      }

      if(count($errors) == 0){
        header('Location: admin_home.php');
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
              <span>ID :</span>
              <input id="id" type="text" name="id" placeholder="Enter Your ID.." />
              <?php
                if(isset($errors["id_e_error"])) echo "<p style='color: red;'>" . $errors["id_e_error"] . "</p>";
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
