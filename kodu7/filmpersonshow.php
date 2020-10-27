<?php
require("usesession.php");
require("../../../config.php");
require("fn_films.php");
require("header.php");
$sortby = 0;
$sortorder = 0;
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] . " " . $_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<hr>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
  if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
    $sortby = $_GET["sortby"];
  }
  if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
    $sortorder = $_GET["sortorder"];
  }
} 
echo readpersonsinfilms($sortby, $sortorder); ?>
<hr>
<ul>
  <li><a href="?logout=1" style="color: red;">Logi välja</a></li>
  <li><a href="home.php">Avaleht</a></li>
  <li><a href="filmsinput.php">Näita filme</a></li>
</ul>
</body>
</html>

