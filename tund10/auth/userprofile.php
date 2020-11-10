<?php
require("usesession.php");
require("../../../config.php");
require("fn_users.php");
require("fn_common.php");
$notice = "";
$userdescription="";

if (isset($_POST["profilesubmit"])) {
  $userdescription = test_input($_POST["descriptioninput"]);
  $notice = storeuserprofile($userdescription,$_POST["bgcolorinput"], $_POST["txtcolorinput"] );
  $_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
  $_SESSION["usertextcolor"] = $_POST["txtcolorinput"];
}
require("other/header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<form method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <label for="descriptioninput">Mu lühikirjeldus</label><br>
  <textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu lühikirjeldus......."><?php echo readuserdescription(); ?></textarea>
  <br>
  <label for="bgcolorinput">Taustavärv</label>
  <input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
  <br>
  <label for="bgcolorinput">Tekstivärv</label>
  <input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
  <br>
  <input type="submit" name="profilesubmit" value="salvesta profiil"> 
</form>
<p><?php echo $notice; ?></p>

<?php require("lingid.php"); ?>
</body>