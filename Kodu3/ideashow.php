<?php
  //var_dump($_POST);
  require("../../../config.php");
  $database = "if20_johan_le_1";
  
  //andmebaasi lugemine
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT idea FROM myideas");
  echo $conn->error;
  //seome tulemuse muutujaga
  $stmt->bind_result($ideafromdb);
  
  $stmt->execute();
  $ideahtml = "";
  while($stmt->fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();
  require("header.php");
?>

<hr>
<?php echo $ideahtml; ?>
<hr>
<a href="ideainput.php">Sisesta ideed</a>
<a href="home.php">Avaleht</a>
</body>
