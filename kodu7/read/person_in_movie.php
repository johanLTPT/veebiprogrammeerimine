<?php
require("usesession.php");
require("../../../config.php");
require("fn_films.php");
require("header.php");
$sortby = 0;
$sortorder = 0;
?>
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