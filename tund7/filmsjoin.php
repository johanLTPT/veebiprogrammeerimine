<?php
require("usesession.php");
require("../../../config.php");
require("fn_films.php");
require("fn_films_select.php");
require("header.php");

$notice = $notice2 = $notice3 = $notice4 = "";
$film = "";
$studio = "";
$human = "";
$position = "";
$genre = "";
$quote = "";
if (isset($_POST["filmjoinsubmit"])) {
  if (!empty($_POST["filminput"])) {
    $film = $_POST["filminput"];
  } else {
    $notice = " Vali film!";
  }
  if (!empty($_POST["studioinput"])) {
    $studio = $_POST["studioinput"];
  } else {
    $notice = " Vali stuudio!";
  }
  if (!empty($film) and !empty($studio)) {
    $notice = newfilmandstudio($film, $studio);
  }
}
if (isset($_POST["filmpersonsubmit"])) {
  if (!empty($_POST["filminput"])) {
    $film = $_POST["filminput"];
  } else {
    $notice2 = " Vali film!";
  }
  if (!empty($_POST["humaninput"])) {
    $human = $_POST["humaninput"];
  } else {
    $notice2 = " Vali stuudio!";
  }
  if (!empty($_POST["positioninput"])) {
    $position = $_POST["positioninput"];
  } else {
    $notice2 = " Vali Amet!";
  }
  if (!empty($film) and !empty($human) and !empty($position)) {
    $notice2 = newfilmandhuman($film, $human, $position);
  }
}
if (isset($_POST["filmgenresubmit"])) {
  if (!empty($_POST["filminput"])) {
    $film = $_POST["filminput"];
  } else {
    $notice3 = " Vali film!";
  }
  if (!empty($_POST["genreinput"])) {
    $genre = $_POST["genreinput"];
  } else {
    $notice3 = " Vali genre!";
  }
  if (!empty($film) and !empty($genre)) {
    $notice3 = newfilmandgenre($film, $genre);
  }
}
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Tervist, <span style="color:#336CFF;"><?php echo $_SESSION["userfirstname"] . " " . $_SESSION["userlastname"] ?></span>!</h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
<h2>Määrame filmile Stuudio</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readstudioselect($studio); ?>

  <input type="submit" name="filmjoinsubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>
<h2>Määrame filmile Isiku ja Positsiooni</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <?php echo readpositionselect($position); ?>
  <input type="submit" name="filmpersonsubmit" value="Salvesta"><span><?php echo $notice2; ?></span>
</form>
<hr>
<h2>Määrame filmile Žanri</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readgenreselect($genre); ?>
  <input type="submit" name="filmgenresubmit" value="Salvesta"><span><?php echo $notice3; ?></span>
</form>
<hr>
<h2>Määrame filmile Tsitaadi</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <?php echo readquoteselect($quote); ?>
  <input type="submit" name="filmgenresubmit" value="Salvesta"><span><?php echo $notice4; ?></span>
</form>
<hr>
<ul>
  <li><a href="?logout=1" style="color: red;">Logi välja</a></li>
  <li><a href="home.php">Avaleht</a></li>
  <li><a href="filmsinput.php">Näita filme</a></li>
</ul>
</body>