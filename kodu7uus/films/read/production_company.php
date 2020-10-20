<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = $production_company = $address= "";
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>production_company</h1>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
}

echo read_production_company($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["production_companyinput"])) {
      $production_company = $_POST["production_companyinput"];
    } else {
      $notice = " Sisesta firma!";
    }
    if (!empty($_POST["addressinput"])) {
      $address = $_POST["addressinput"];
    } else {
      $notice = " Sisesta aadress!";
    }
    if (!empty($production_company)) {
      $notice = new_production_company($production_company, $address);
  }
}
?>
<h2>Lisa uus Stuudio</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="production_companyinput">Firma nimi</label>
  <input type="text" name="production_companyinput" id="production_companyinput" placeholder="Firma">
  <br>
  <label for="addressinput">Aadress</label>
  <input type="text" name="addressinput" id="addressinput" placeholder="Aadress">
  <br>
  <input type="submit" name="submit" value="Lisa stuudio"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
<li><a href="">Uuenda tabelit</a></li>
<li><a href="../../filmpage.php">Tagasi</a></li>
</ul>