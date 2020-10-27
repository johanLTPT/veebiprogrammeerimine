<?php
require("auth/usesession.php");
require("../../../config.php");

$database = "if20_johan_le_1";
$inputerror = "";
$notice = null;
$filetype = null;
$filename = null;
$photomaxwidth = 600;
$photomaxheight = 400;
$filenameprefix = "vp_";
$filesizelimit = 1048576;
$photouploaddir_orig = "../photoupload_orig/";
$photouploaddir_norm = "../photoupload_norm/";
if (isset($_POST["photosubmit"])) {
  //var_dump($_POST);
  //var_dump($_FILES);
  $check = getimagesize($_FILES["photoinput"]["tmp_name"]); 
  if ($check !== false) {
    //var_dump($check);
    if ($check["mime"] == "image/jpeg") {
      $filetype = "jpg";
    }
    if ($check["mime"] == "image/png") {
      $filetype = "png";
    }
    if ($check["mime"] == "image/gif") {
      $filetype = "gif";
    }
  } else {
    $inputerror = "Valitud fail pole pilt! ";
  }
  if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesizelimit){
    $inputerror = "Fail on liiga suur! ";
  }
  //uus failinimi koosneb prefix ja kuupäevast
  $timestamp = microtime(1) *10000;
  $filename = $filenameprefix .$timestamp ."." .$filetype;
  

  if (file_exists($photouploaddir_orig .$filename)) {
    $inputerror = "Fail sama nimega on olemas ";
  }
  if (empty($inputerror)) {
    $target = $photouploaddir_norm .$filename;
    //pildi suuruse muutmine
    //loome pikslikogumi, pildi objekti
    if($filetype == "jpg"){
      $mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["tmp_name"]);
    }
    if($filetype == "png"){
      $mytempimage = imagecreatefrompng($_FILES["photoinput"]["tmp_name"]);
    }
    if($filetype == "gif"){
      $mytempimage = imagecreatefromgif($_FILES["photoinput"]["tmp_name"]);
    }
    //tuvastame originaal suuruse
    $imagew = imagesx($mytempimage); 
    $imageh = imagesy($mytempimage);
    if($imagew > $photomaxwidth or $imageh > $photomaxheight){
      //kui vaja muuta suurust, siis muudame seda
      if($imagew/$photomaxwidth > $imageh/$photomaxheight){
        $photosizeratio = $imagew/$photomaxwidth;
      }else{
        $photosizeratio = $imageh/$photomaxheight;
      }
      //Arvutame uued mõõdud
      $neww = round($imagew/$photosizeratio);
      $newh = round($imageh/$photosizeratio);
      //teeme uue pikslikogumiku
      $mynewtempimage = imagecreatetruecolor($neww,$newh);
      //kirjutame järelejäävad pikslid uuele pildile
      imagecopyresampled($mynewtempimage, $mytempimage, 0, 0, 0, 0, $neww, $newh, $imagew, $imageh);
      //salvestame selle uue pildi
      $notice = saveimage($mynewtempimage, $filetype, $target);
    }else{
      $notice = saveimage($mytempimage, $filetype, $target);
    }
    if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig . $filename)){
      $notice .= "Originaal pildi salvestamine õnnestus";
    }else{
      $notice .= "Originaal pilt ei saanud salvestatud";
    }
    
  }
}
function saveimage($mynewtempimage, $filetype, $target){
  $notice = null;
  if($filetype == "jpg"){
    if(imagejpeg($mynewtempimage, $target, 90)){
      $notice = "Pilt sai vähendatud ja salvestatud";
    }else{
      $notice="tekkis tõrge pildi vähendamisel.";
    }
  }
  if($filetype == "png"){
    if(imagepng($mynewtempimage, $target, 6)){
      $notice = "Pilt sai vähendatud ja salvestatud";
    }else{
      $notice="tekkis tõrge pildi vähendamisel.";
    }
  }
  if($filetype == "gif"){
    if(imagegif($mynewtempimage, $target)){
      $notice = "Pilt sai vähendatud ja salvestatud";
    }else{
      $notice="tekkis tõrge pildi vähendamisel.";
    }
  }
  imagedestroy($mynewtempimage);
  return $notice;
}

require("other/header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] . " " . $_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
  <label for="photoinput">Vali pildifail</label>
  <input id="photoinput" name="photoinput" type="file" required>
  <br>
  <label for="altinput">Lisa pildi lühikirjeldus/alternatiiv tekst</label>
  <input id="altinput" name="altinput" type="text">
  <br>
  <label><b>Privaatsustase</b></label>
  <br>
  <input type="radio" name="privinput" id="privinput1" value="1">
  <label for="privinput1">Privaatne(ainult ise näed)</label>
  <input type="radio" name="privinput" id="privinput2" value="2">
  <label for="privinput2">Klubi liikmetele(sisseloginud)</label>
  <input type="radio" name="privinput" id="privinput3" value="3">
  <label for="privinput3">Avalik(kõik näevad)</label>
  <br>
  <input type="submit" name="photosubmit" value="Lae foto üles">

</form>
<p><?php
    echo $inputerror;
    echo $notice;
    ?>
</p>

<hr>
<li><a href="home.php">Avaleht</a></li>
<li><a href="filmshow.php">Näita filme</a></li>
<li><a href="?logout=1" style="color: red;">Logi välja</a></li>
</ul>
</body>