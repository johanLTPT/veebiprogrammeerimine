<?php
require("../../../../config.php");
require("../other/header.php");
require("../fn_common.php");
require("fn_users.php");
$database = "if20_johan_le_1";
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
$firstnameError = $lastnameError = $emailError = $genderError = $passwordError = $passwordsecondaryError = "";
$birthdateerror = $birthdayerror = $birthmontherror = $birthyearerror = null;
$firstname = $lastname = $gender = $email =  "";
$birthday = $birthmonth = $birthyear = $birthdate = null;
if (isset($_POST["usersubmit"])) {
 
  if(!empty($_POST["firstnameinput"]) and !empty($_POST["usersubmit"])) {
    $firstname = test_input($_POST["firstnameinput"]);
  }else{$firstnameError = "Sisesta nimi!";}

  if(!empty($_POST["lastnameinput"]) and !empty($_POST["usersubmit"])) {
    $lastname = test_input($_POST["lastnameinput"]);
  }else{$lastnameError = "Sisesta see nimi ka!";}

  if(!empty($_POST["emailinput"]) and !empty($_POST["usersubmit"])) {
    $email = test_email($_POST["emailinput"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    } else {
      $emailError = "$email is not a valid email address";
    }
  }else{$emailError = "Sisesta Email!";}

  if(!empty($_POST["genderinput"]) and !empty($_POST["usersubmit"])) {
    $gender = intval( $_POST["genderinput"]);
  }else{$genderError = "Vali sugu";}

//Sünnikuupäevakontroll
  if(!empty($_POST["birthdayinput"])){
    $birthday = intval( $_POST["birthdayinput"]);
  }else{
    $birthdayerror = "Vali sünnikuupäev!";
  }
  if(!empty($_POST["birthmonthinput"])){
    $birthmonth = intval( $_POST["birthmonthinput"]);
  }else{
    $birthmontherror = "Vali sünnikuu!";
  }
  if(!empty($_POST["birthyearinput"])){
    $birthyear = intval( $_POST["birthyearinput"]);
  }else{
    $birthyearerror = "Vali sünniaasta!";
  }
  //kontrollime kuupäeva valiidsust
  if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
    if(checkdate($birthmonth, $birthday, $birthyear)){
      $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
      $birthdate = $tempdate->format("Y-m-d");
    }else{
      $birthdateerror= "Kuupäev on väljunud reaalsuse piirist!";
    }
  }
  if(strlen($_POST["passwordinput"]) < 8){
    $passwordError = "Vähemalt 8 tähemärki";
  }
  if(empty($_POST["passwordinput"])) {
    $passwordError = "Sisesta salasõna, soovitatavalt 8 tähte";
  }
  if(empty($_POST["passwordsecondaryinput"])) {
    $passwordsecondaryError = "Sisesta salasõna uuesti";
  }
  if($_POST["passwordinput"] != $_POST["passwordsecondaryinput"]) {
    $passwordsecondaryError = "Salasõnad ei klapi";
  }
  if (empty($firstnameError) and empty($lastnameError) and empty($emailError) and empty($birthdateerror) and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($genderError) and empty($passwordError) and empty($passwordsecondaryError)) {
    $result = signup( $firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
    if($result == "ok"){
      $notice = "kõik korras";
      $firstname = $lastname = $email = $gender = "";
      $birthdate = $birthday = $birthmonth = $birthyear = null;
    }else{
      $notice = "tehniline tõrge" .$result;
    }
    
    
  }
    
}


?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="firstnameinput">Eesnimi</label>
  <input type="text" name="firstnameinput" id="firstnameinput" value="<?php echo $firstname;?>">
  <span class="error"> <?php echo $firstnameError;?></span>
  <br>
  <label for="lastnameinput">Perenimi</label>
  <input type="text" name="lastnameinput" id="lastnameinput" value="<?php echo $lastname;?>">
  <span class="error"> <?php echo $lastnameError;?></span>
  <br>
  <label for="genderinput">Sugu</label>
  <label for="gender1">Mees</label>
  <input type="radio" name="genderinput" id="gender1" value="1" <?php if($gender == "1"){echo "checked";} ?>>
  <label for="gender2">Naine</label>
  <input type="radio" name="genderinput" id="gender2" value="2" <?php if($gender == "2"){echo "checked";} ?>>
  <span><?php echo $genderError; ?></span>
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
	  <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
  <br>
  <br>
  <label for="emailinput">email</label>
  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email;?>">
  <span class="error"> <?php echo $emailError;?></span>
  <br>
  <label for="passwordinput">Salasõna</label>
  <input type="password" name="passwordinput" id="passwordinput">
  <span class="error"><?php echo $passwordError;?></span>
  <br>
  <label for="passwordsecondaryinput">Salasõna uuesti</label>
  <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput">
  <span class="error"> <?php echo $passwordsecondaryError;?></span>
  <br>

  <input type="submit" name="usersubmit" value="Lisa kasutaja">
</form>
<ul><li><a href="../home.php">Avaleht</a></li></ul>

</body>