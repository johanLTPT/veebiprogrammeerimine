<?php
  //var_dump($_POST);
  require("../../../config.php");
  require("other/picshow.php");
  require("other/header.php");
  require("films/fn_films.php");

  $notice = $table = "";
  if (isset($_POST["tablesubmit"])) {
    if (!empty($_POST["tableinput"])) {
      $table = $_POST["tableinput"];
    } else {
      $notice = " Vali tabel!";
    }
    if (!empty($table)) {
      $notice = router($table);
    }
  }
  
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h2>See on super duper informatsiooni kuvar ja sisestaja.</h2>
<p>Vali tabel, mida soovid vaadata.
Vastavalt tabeli liigile saad sinna lisada uusi andmeid, või uusi seoseid. Peale andmete lisamist uuenda tabelit, et näha just sisestatud andmeid.</p>

<hr>
<form method="POST">
<select name ="tableinput" id = "tableinput">
<option value="" selected disabled>Vali tabel andmebaasist</option>
<option value="person">person</option>
<option value="quote">quote</option>
<option value="position">position</option>
<option value="genre">genre</option>
<option value="production_company">production_company</option>
<option value="movie">movie</option>
<option value="person_in_movie">person_in_movie</option>
<option value="movie_genre">movie_genre</option>
<option value="movie_by_production_company">movie_by_production_company</option>
</select>

</select>
<input type="submit" name="tablesubmit" value="Vali"><span><?php echo $notice; ?></span>
</form>
<?php require("lingid.php"); ?>
</body>
</html>
