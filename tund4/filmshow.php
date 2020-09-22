<?php
  require("../../../config.php");
  require("fn_films.php");
  require("header.php");
  //$filmhtml = readfilms();
?>

<hr>
<?php echo readfilms(); ?>
<hr>
	<li><a href="home.php">Avaleht</a></li>
	<li><a href="filmsinput.php">Näita filme</a></li>
	</ul>
</body>
