<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  if($conn) echo "Connected Successfully";

  if(isset($_POST["logout"])){
    session_destroy();
    header('Location: admin_login.php');
    exit();
  }

  if(isset($_POST["add_client"])){
    header('Location: admin_addclient.php');
    exit();
  }
  if(isset($_POST["add_card"])){
    header('Location: admin_addcard.php');
    exit();
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

  <div class="smart-green" style="height: 200px;">

    <h1>ATM 
        <span>Fraud Detection System</span>
    </h1>
      
    <div style="float: left; width: 30%;">
    <form method="post">
    <label>
      <span>&nbsp;</span> 
      <input type="submit" name="add_client" class="button" value="Add Client" style="width: 100px" />
    </label>    
    </form>      
    
    <form method="post">
    <label>
      <span>&nbsp;</span> 
      <input type="submit" name="add_card" class="button" value="Add Card" style="width: 100px;" />
    </label>    
    </form>

    <form method="post">
    <label>
      <span>&nbsp;</span> 
      <input type="submit" name="logout" class="button" value="Log out" style="background-color: red; width: 100px;" />
    </label>    
    </form>
    </div>

    <div style="float: left; width: 70%;">
      <ul>
        <li><p style="font-size: 16">Admin can add client</p></li>
        <li><p style="font-size: 16">Admin can add card</p></li>
      </ul>
    </div>

  </div>

</body>
</html>
