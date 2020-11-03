<?php
session_start();
require("../../../config.php");
require("other/header.php");
require("fn_common.php");
require("fn_users.php");
$database = "if20_johan_le_1";
$emailError = $passwordError = "";
$email = $notice=  "";
if (isset($_POST["login"])) {
  

  if(!empty($_POST["emailinput"]) and !empty($_POST["login"])) {
    $email = test_email($_POST["emailinput"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    } else {
      $emailError = "$email is not a valid email address";
    } 
  }else{$emailError = "Sisesta Email!";}

  if(strlen($_POST["passwordinput"]) < 8){
    $passwordError = "Vähemalt 8 tähemärki";
  }
  if(empty($_POST["passwordinput"])) {
    $passwordError = "Sisesta salasõna";
  }
 
  if (empty($emailError) and empty($passwordError)) {
    $result = signin($email, $_POST["passwordinput"]);
    if($result == "ok"){
      $notice = "kõik korras";
    }else{
      $notice = "tehniline tõrge " .$result;
    }
    
    
  }
    
}


?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <br>
  <label for="emailinput">email</label>
  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email;?>">
  <span class="error"> <?php echo $emailError;?></span>
  <br>
  <label for="passwordinput">Salasõna</label>
  <input type="password" name="passwordinput" id="passwordinput">
  <span class="error"><?php echo $passwordError;?></span>
  <br>
  <span class="error"><?php echo $notice;?></span>
  <input type="submit" name="login" value="Logi sisse">
</form>

<hr>
</body>