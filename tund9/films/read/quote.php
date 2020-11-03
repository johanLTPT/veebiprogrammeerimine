<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = $role = $human = $film = $person_in_movie = "";
$position = "1";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>quote</h1>
<?php 
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_quote($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
if (isset($_POST["submit"])) {
  if (!empty($_POST["quoteinput"])) {
    $quote= $_POST["quoteinput"];
  } else {
    $notice = " Sisesta tsitaat";
  }
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
    if (!empty($_POST["roleinput"])) {
      $role = $_POST["roleinput"];
    } else {
      $notice = " Vali Roll!";
    }
    if (!empty($film) and !empty($human) and !empty($role)) {
      $notice = new_person_in_movie($film, $human, $position, $role);
      if (!empty($quote)) {
        $notice = new_quote($quote, $film, $human, $role);
    }
    }
    
}
?>
<h2>Lisa uus tsitaat</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="quoteinput">Tsitaat</label><br>
  <textarea rows="2" cols="30" name="quoteinput" id="quoteinput" placeholder="Tsitaat.."></textarea>
  <br>
  <?php echo readfilmselect($film); ?>
  <?php echo readhumanselect($human); ?>
  <label for="roleinput">Roll</label>
  <input type="text" name="roleinput" id="roleinput" placeholder="Roll">
  <br>
  <input type="submit" name="submit" value="Lisa Tsitaat"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>