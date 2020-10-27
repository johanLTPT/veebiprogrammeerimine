<?php
  //var_dump($_POST);

  require("usesession.php");
  require("../../../config.php");
  require("picshow.php");
  require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Tervist, <span style="color:#336CFF;"><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></span>!</h1>
<p><a href="?logout=1" style="color: red;">Logi välja</a></p>
<p><a href="filmsjoin.php" style="color: green;">Filmide join</a></p>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee" style="color:#336CFF;">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <?php require("semestershow.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  <p>Lingid</p>
  <ul>
  <li><a href="ideainput.php">Sisesta ideed</a></li>
  <li><a href="ideashow.php">Näita ideid</a></li>
  <li><a href="filmshow.php">Näita filme</a></li>
    <li><a href="filmpersonshow.php">Näita filmi tegelasi</a></li>
  <li><a href="filmsinput.php">Lisa filme</a></li>
  <li><a href="userprofile.php">userprofile</a></li>
	</ul>
</body>
</html>
