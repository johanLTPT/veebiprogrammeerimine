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
if (isset($_POST["filmgenresubmit"])) {
    if (!empty($_POST["filminput"])) {
      $film = $_POST["filminput"];
    } else {
      $notice = " Vali film!";
    }
    if (!empty($_POST["genreinput"])) {
      $genre = $_POST["genreinput"];
    } else {
      $notice = " Vali genre!";
    }
    if (!empty($film) and !empty($genre)) {
      $notice = new_movie_genre($film, $genre);
    }
  }
?>
<h2>Määrame filmile Žanri</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readgenreselect($genre); ?>
  <input type="submit" name="filmgenresubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>