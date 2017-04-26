<?php
  session_start();

  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "projectDB";

  $conn = mysqli_connect($server, $user, $password, $db);
  //if($conn) echo "Connected Successfully";

  if(isset($_POST["home"])){
    header('Location: admin_home.php');
    exit();
  }
  if(isset($_POST["add"])){
    if ($_SESSION["type"] == "Card") {
      header('Location: admin_addcard.php');
      exit();  
    }
    else if($_SESSION["type"] == "Client"){
      header('Location: admin_addclient.php');
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

  <div class="smart-green" style="height: 200px;">

    <h1>ATM 
        <span>Fraud Detection System</span>
    </h1>

    <p style="color: rgb(200, 0, 35); font-size: 16px; background-color: rgb(205, 255, 130); padding: 3px;"><?php echo $_SESSION["type"]; ?> added successfully.</p>
      
    <div style="float: left; width: 30%;"> 
    
    <form method="post">
    <label>
      <span>&nbsp;</span> 
      <input type="submit" name="add" class="button" value="Add" style="width: 100px;" />
    </label>    
    </form>

    <form method="post">
    <label>
      <span>&nbsp;</span> 
      <input type="submit" name="home" class="button" value="Home"" style="width: 100px;" />
    </label>    
    </form>
    </div>

    <div style="float: left; width: 70%;">
      <ul>
        <li><p style="font-size: 16">Click Add to add another <?php echo $_SESSION["type"]; ?></p></li>
        <li><p style="font-size: 16">Click Home to view homepage</p></li>
      </ul>
    </div>

  </div>

</body>
</html>
