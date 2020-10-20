<?php
  //var_dump($_POST);

  require("auth/usesession.php");
  require("../../../config.php");
  require("other/picshow.php");
  require("other/header.php");

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Tervist, <span style="color:#336CFF;"><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></span>!</h1>
<p><a href="?logout=1" style="color: red;">Logi välja</a></p>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee" style="color:#336CFF;">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <?php require("other/semestershow.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  <?php require("lingid.php"); ?>
</body>
</html>
