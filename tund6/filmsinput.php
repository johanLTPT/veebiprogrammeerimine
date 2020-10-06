<?php
require("usesession.php");
require("../../../config.php");
require("fn_films.php");

$database = "if20_johan_le_1";
$inputerror = "";
if (isset($_POST["filmsubmit"])) {
  if (empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])) {
    $inputerror .= "Osa infot on sisestamata! ";
  }
  if ($_POST["yearinput"] > date("Y") or $_POST["yearinput" < 1895]) {
    $inputerror .= "Ebarealne valmimisaasta! ";
  }
  if (empty($inputerror)) {
    savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
  }
}
require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<form method="POST">
  <label for="titleinput">Filmi pealkiri</label>
  <input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
  <br>
  <label for="yearinput">Filmi Aasta</label>
  <input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
  <br>
  <label for="durationinput">Filmi kestvus</label>
  <input type="number" name="durationinput" id="durationinput" value="80">
  <br>
  <label for="genreinput">Filmi Žanr</label>
  <input type="text" name="genreinput" id="genreinput" placeholder="Žanr">
  <br>
  <label for="studioinput">Filmi stuudio/tootja</label>
  <input type="text" name="studioinput" id="studioinput" placeholder="stuudio/tootja">
  <br>
  <label for="directorinput">Filmi lavastaja</label>
  <input type="text" name="directorinput" id="directorinput" placeholder="lavastaja">
  <br>
  <input type="submit" name="filmsubmit" value="salvesta film">
</form>
<p><?php echo $inputerror; ?></p>

<hr>
<li><a href="home.php">Avaleht</a></li>
<li><a href="filmshow.php">Näita filme</a></li>
<li><a href="?logout=1" style="color: red;">Logi välja</a></li>
</ul>
</body>