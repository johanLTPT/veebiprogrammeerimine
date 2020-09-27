<?php
require("../../../config.php");
//require("fn_users.php");
require("header.php");
$database = "if20_johan_le_1";
$firstnameError = $lastnameError = $emailError = $genderError = $passwordError = $passwordsecondaryError = "";
$firstname = $lastname = $email = $gender = "";
if (isset($_POST["usersubmit"])) {
 
  if(empty($_POST["firstnameinput"]) and !empty($_POST["usersubmit"])) {
    $firstnameError = "Sisesta nimi!";
  }
  if(empty($_POST["lastnameinput"]) and !empty($_POST["usersubmit"])) {
    $lastnameError = "Sisesta see nimi ka!";
  }
  if(empty($_POST["emailinput"]) and !empty($_POST["usersubmit"])) {
    $emailError = "Email!";
  }
  if(empty($_POST["genderinput"]) and !empty($_POST["usersubmit"])) {
    $genderError = "Vali sugu";
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
  if (empty($firstnameError and $lastnameError and $emailError and $genderError and $passwordError and $passwordsecondaryError)) {
    
  }
  $firstname = $_POST["firstnameinput"]; $lastname = $_POST["lastnameinput"]; $email = $_POST["emailinput"]; $gender = $_POST["genderinput"];
}
?>

<form method="POST">
  <label for="firstnameinput">Eesnimi</label>
  <input type="text" name="firstnameinput" id="firstnameinput" value="<?php echo $firstname;?>">
  <span class="error">* <?php echo $firstnameError;?></span>
  <br>
  <label for="lastnameinput">Perenimi</label>
  <input type="text" name="lastnameinput" id="lastnameinput" value="<?php echo $lastname;?>">
  <span class="error">* <?php echo $lastnameError;?></span>
  <br>
  <label for="emailinput">email</label>
  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailError;?></span>
  <br>
  <label for="genderinput">Sugu</label>
  <label for="gender1">Mees</label>
  <input type="radio" name="genderinput" id="gender1" value="1" <?php if($gender == "1"){echo "checked";} ?>>
  <label for="gender2">Naine</label>
  <input type="radio" name="genderinput" id="gender2" value="2" <?php if($gender == "2"){echo "checked";} ?>>
  <span><?php echo $genderError; ?></span>
  <br>
  <label for="passwordinput">Salasõna</label>
  <input type="password" name="passwordinput" id="passwordinput">
  <span class="error">* <?php echo $passwordError;?></span>
  <br>
  <label for="passwordsecondaryinput">Salasõna uuesti</label>
  <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput">
  <span class="error">* <?php echo $passwordsecondaryError;?></span>
  <br>

  <input type="submit" name="usersubmit" value="Lisa kasutaja">
</form>

<hr>
<li><a href="home.php">Avaleht</a></li>
</ul>
</body>