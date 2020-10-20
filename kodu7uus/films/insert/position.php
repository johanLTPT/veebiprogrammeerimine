<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = $position = $description= "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_position($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["positioninput"])) {
      $genre = $_POST["positioninput"];
    } else {
      $notice = " Sisesta positisoon!";
    }
    if (!empty($_POST["descriptioninput"])) {
      $description = $_POST["descriptioninput"];
    } else {
      $notice = " Sisesta kirjeldus!";
    }
    if (!empty($genre)) {
      $notice = new_genre($position, $description);
  }
}
?>
<h2>Lisa uus Positstion</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="positioninput">Ameti nimetus</label>
  <input type="text" name="genreinput" id="genreinput" placeholder="Pealkiri">
  <br>
  <label for="descriptioninput">Ameti lühikirjeldus</label><br>
  <textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="lühikirjeldus.."></textarea>
  <br>
  <input type="submit" name="submit" value="Lisa Amet"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>