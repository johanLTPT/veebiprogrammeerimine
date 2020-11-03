<?php
require("../../auth/usesession.php");
require("../../../../../config.php");
require("../fn_films.php");
require("../fn_films_read.php");
require("../fn_films_insert.php");
require("../fn_films_select.php");
require("../../other/header.php");
$sortby = $sortorder = 0;
$notice = $firstname = $lastname = $birthdate = "";
$birthday = $birthmonth = $birthyear = $birthdate = null;
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
?>
<img src="../../../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>person</h1>
<?php
if (isset($_GET["sortby"]) and isset($_GET["sortorder"])) {
  if ($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4) {
    $sortby = $_GET["sortby"];
  }
  if ($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2) {
    $sortorder = $_GET["sortorder"];
  }
}

echo read_person($sortby, $sortorder); ?>
<h2><a href="">Uuenda tabelit</a></h2>
<hr>
<?php
if (isset($_POST["submit"])) {
  if(!empty($_POST["firstnameinput"])) {
    $firstname = $_POST["firstnameinput"];
  }else{$notice = "Sisesta eesnimi!";}

  if(!empty($_POST["lastnameinput"])) {
    $lastname = $_POST["lastnameinput"];
  }else{$notice = "Sisesta perenimi ka!";}
  //Sünnikuupäevakontroll
  if (!empty($_POST["birthdayinput"])) {
    $birthday = intval($_POST["birthdayinput"]);
  } else {
    $notice = "Vali sünnikuupäev!";
  }
  if (!empty($_POST["birthmonthinput"])) {
    $birthmonth = intval($_POST["birthmonthinput"]);
  } else {
    $notice = "Vali sünnikuu!";
  }
  if (!empty($_POST["birthyearinput"])) {
    $birthyear = intval($_POST["birthyearinput"]);
  } else {
    $notice = "Vali sünniaasta!";
  }
  //kontrollime kuupäeva valiidsust
  if (!empty($birthday) and !empty($birthmonth) and !empty($birthyear)) {
    if (checkdate($birthmonth, $birthday, $birthyear)) {
      $tempdate = new DateTime($birthyear . "-" . $birthmonth . "-" . $birthday);
      $birthdate = $tempdate->format("Y-m-d");
    } else {
      $notice = "Kuupäev on väljunud reaalsuse piirist!";
    }
  }

  if (!empty($firstname) and !empty($lastname) and !empty($birthdate)) {
    $notice = new_person($firstname, $lastname, $birthdate);
  }
}
?>
<h2>Lisa uus isik</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="firstnameinput">Eesnimi</label>
  <input type="text" name="firstnameinput" id="firstnameinput">
  <br>
  <label for="lastnameinput">Perenimi</label>
  <input type="text" name="lastnameinput" id="lastnameinput">
  <br>
  <label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
  <br>
  <input type="submit" name="submit" value="Lisa isik"><span><?php echo $notice; ?></span>
</form>
<hr>

<ul>
  <li><a href="">Uuenda tabelit</a></li>
  <li><a href="../../filmpage.php">Tagasi</a></li>
</ul>