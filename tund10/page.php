<?php
  //var_dump($_POST);
  require("classes/SessionManager.class.php");
  SessionManager::sessionStart("vpj", 0, "/~johaleo/", "greeny.cs.tlu.ee");
  require("../../../config.php");
  require("other/picshow.php");
  require("other/header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1 style="color:#ff5050;">😎 Äge, sa pole sisse logitud. 😎</h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
  <a href="auth/adduser.php">Loo kasutaja</a>
  <a href="auth/loginuser.php">Logi sisse</a>
  <?php require("other/semestershow.php"); ?>
  <?php require("auth/loginuser.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  
</body>
</html>