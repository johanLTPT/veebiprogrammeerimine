<?php
  //var_dump($_POST);
  require("../../../config.php");
  require("picshow.php");
  $username="";
  require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $username; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
  <a href="adduser.php">Loo kasutaja</a>
  <a href=".php">Logi sisse</a>
  <?php require("semestershow.php"); ?>
  <?php require("loginuser.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  
</body>
</html>