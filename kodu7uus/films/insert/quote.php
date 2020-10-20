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
if (isset($_POST["filmquotesubmit"])) {
    if (!empty($_POST["filminput"])) {
      $film = $_POST["filminput"];
    } else {
      $notice = " Vali film!";
    }
    if (!empty($_POST["quoteinput"])) {
      $studio = $_POST["quoteinput"];
    } else {
      $notice = " Vali Tsitaat  !";
    }
    if (!empty($film) and !empty($human) and !empty($quote)) {
      $notice = new_movie_quote($film, $human, $quote);
    }
  }
?>
<h2>Määrame filmile Tsitaadi</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <?php echo readquoteselect($quote); ?>
  <input type="submit" name="filmquotesubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>