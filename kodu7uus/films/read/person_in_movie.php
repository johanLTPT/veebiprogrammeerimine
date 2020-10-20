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
$film = $studio = $human = $position = $genre = $role = $quote = "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>person_in_movie</h1>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 5){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_person_in_movie($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
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
    if (!empty($_POST["roleinput"])) {
      $role = $_POST["roleinput"];
    } else {
      $notice = " sisesta roll!";
    }
    if (!empty($film) and !empty($human) and !empty($position)) {
      $notice = new_person_in_movie($film, $human, $position, $role);
    }
  }
?>
<h2>Lisa uus seos</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <?php echo readpositionselect($position); ?>
  <label for="roleinput">Roll</label>
  <input type="text" name="roleinput" id="roleinput" placeholder="Roll">
  <br>
  <input type="submit" name="filmpersonsubmit" value="Salvesta"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>