<?php
  require("auth/usesession.php");
  //var_dump($_POST);

  //klassi testimine
  /*require("classes/First_class.php");
  $myclassobject = new First(10);
  echo "Avalik arv" .$myclassobject->everybodysbusiness;
  $myclassobject->tellMe();
  unset($myclassobject);*/
  
  //Söön küpsist
  //setcookie() seee func peab olema enne html elementi
  //küpsise nimi, väärtus, aegumisaeg, failitee (domeeni piires), domeen, https kasutamine
  setcookie("vpvisitorname", $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"],time() + (60*60*24*8), "/~johaleo/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]),true);
  $lastvisitor = null;
  if(isset($_COOKIE["vpvisitorname"])){
    $lastvisitor = "<p>Viimati külastas lehte: " .$_COOKIE["vpvisitorname"] .".</p> \n";
  } else{
    $lastvisitor = "<p>Küpsiseid ei leitud: viimane külastaja pole teada.</p>\n";
  }
    //küpsise kustutamine
    //kustutamiseks tuleb sama küpsis kirjutada minevikus aegumistähtajaga, näiteks time() - 3600

  require("../../../config.php");
  require("other/picshow.php");
  require("other/header.php");

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Tervist, <span style="color:#336CFF;"><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></span>!</h1>
<p><a href="?logout=1" style="color: red;">Logi välja</a></p>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee" style="color:#336CFF;">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <?php require("other/semestershow.php"); ?>
  <?php echo $imghtml; ?>
  <hr>
  <?php require("lingid.php"); ?>
  <hr>
  <h3>Viimane külastaja sellest arvutist</h3>
  <?php
    if(count($_COOKIE) > 0){
      echo "<p>Küpsised on lubatud. Leiti: " .count($_COOKIE) ." küpsist</p>";
    } else {
      echo "<p>Küpsised on keelatud.</p>";
    }

    echo $lastvisitor;
  ?>
</body>
</html>
