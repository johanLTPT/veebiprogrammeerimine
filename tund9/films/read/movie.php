<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = $title = $year = $duration = $description= "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>movie</h1>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_movie($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["titleinput"])) {
      $title = $_POST["titleinput"];
    } else {
      $notice = " Sisesta film!";
    }
    if (!empty($_POST["yearinput"])) {
      $year = $_POST["yearinput"];
    } else {
      $notice = " Sisesta Aasta!";
    }
    if (!empty($_POST["durationinput"])) {
      $duration = $_POST["durationinput"];
    } else {
      $notice = " Sisesta kestvus!";
    }
    if (!empty($_POST["descriptioninput"])) {
      $description = $_POST["descriptioninput"];
    } else {
      $notice = " Sisesta kirjeldus!";
    }
    if (!empty($title) and !empty($year) and !empty($duration)) {
      $notice = new_movie($title, $year, $duration, $description);
  }
}
?>
<h2>Lisa uus film</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="titleinput">Filmi pealkiri</label>
  <input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
  <br>
  <label for="yearinput">Filmi Aasta</label>
  <input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
  <br>
  <label for="durationinput">Filmi kestvus</label>
  <input type="number" name="durationinput" id="durationinput" value="">
  <br>
  <label for="descriptioninput">Filmi lühikirjeldus</label><br>
  <textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Filmi lühikirjeldus.."></textarea>
  <br>
  <input type="submit" name="submit" value="Lisa film"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>