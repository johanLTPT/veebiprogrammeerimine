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
  require("header.php");
?>
<hr>
<form method="POST">
	<label>Sisesta oma mõtetera </label>
	<input type="text" name="ideainput" placeholder="kirjuta siia">
	<input type="submit" name="ideasubmit" value="Pane mõte teele!">
  </form>
	<hr>
<a href="ideashow.php">Näita ideid</a>
<a href="home.php">Avaleht</a>
</body>