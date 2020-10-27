<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = "";
$film = $studio = $human = $position = $genre = $quote = "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>movie_by_production_company</h1>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_movie_by_production_company($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
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
      $notice = new_movie_by_production_company($film, $studio);
    }
  }
?>
<h2>Lisa uus seos</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readstudioselect($studio); ?>

  <input type="submit" name="filmjoinsubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>