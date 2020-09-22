<?php
  //var_dump($_POST);
  require("../../../config.php");
  require("picshow.php");
  require("header.php");
?>
  <?php require("semestershow.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  <p>Lingid</p>
  <ul>
  <li><a href="ideainput.php">Sisesta ideed</a></li>
  <li><a href="ideashow.php">Näita ideid</a></li>
  <li><a href="filmshow.php">Näita filme</a></li>
  <li><a href="filmsinput.php">Lisa filme</a></li>
	</ul>
</body>
</html>
