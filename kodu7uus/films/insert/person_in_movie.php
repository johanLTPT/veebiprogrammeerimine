<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$notice = "";
$film = "";
$studio = "";
$human = "";
$position = "";
$genre = "";
$quote = "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<?php
if (isset($_POST["filmpersonsubmit"])) {
    if (!empty($_POST["filminput"])) {
      $film = $_POST["filminput"];
    } else {
      $notice = " Vali film!";
    }
    if (!empty($_POST["humaninput"])) {
      $human = $_POST["humaninput"];
    } else {
      $notice = " Vali Inimene!";
    }
    if (!empty($_POST["positioninput"])) {
      $position = $_POST["positioninput"];
    } else {
      $notice = " Vali Amet!";
    }
    if (!empty($film) and !empty($human) and !empty($position)) {
      $notice = new_person_in_movie($film, $human, $position);
    }
  }
?>
<h2>Määrame filmile Isiku ja Positsiooni</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <?php echo readpositionselect($position); ?>
  <input type="submit" name="filmpersonsubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>