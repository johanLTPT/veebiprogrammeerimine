<?php
  require("../../../config.php");
  $database = "if20_johan_le_1";
  
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	  //sql statementi ettevalmistamine
	  $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn->error;
	  
	  //admed, i = integer, d = decimal, s = string
	  $stmt->bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }
  $username = "";
  require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $username; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
<form method="POST">
	<label>Sisesta oma mõtetera </label>
	<input type="text" name="ideainput" placeholder="kirjuta siia">
	<input type="submit" name="ideasubmit" value="Pane mõte teele!">
  </form>
	<hr>
	<ul>
	<li><a href="home.php">Avaleht</a></li>
	<li><a href="ideashow.php">Näita ideid</a></li>
	</ul>
	


</body>