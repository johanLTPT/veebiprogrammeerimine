<?php
  //var_dump($_POST);
  require("usesession.php");
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
  $username="";
  require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
<?php echo $ideahtml; ?>
<hr>
	<li><a href="home.php">Avaleht</a></li>
  <li><a href="ideainput.php">Sisesta ideid</a></li>
  <li><a href="?logout=1" style="color: red;">Logi välja</a></li>
	</ul>
</body>
