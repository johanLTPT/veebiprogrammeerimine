<?php
  //var_dump($_POST);
  require("../../../config.php");
  $database = "if20_johan_l_1";
  
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	  //sql statementi ettevalmistamine
	  $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn->error;
	  
	  //admed, i = integer, d = decimal, s = string
	  $stmt->bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }
  
  //andmebaasi lugemine
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT idea FROM myideas");
  echo $conn->error;
  //seome tulemuse muutujaga
  $stmt->bind_result($ideafromdb);
  
  $stmt->execute();
  $ideahtml = "";
  while($stmt->fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();
  
  $username = "Johan Leoste";
  $fulltimenow = date("d.m.Y H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];

  //echo $weekdaynameset;
  //var_dump($weekdaynameset);
  $weekdaynow = date("N");
  
  
  if($hournow >= 6 and $hournow <= 9){
	  $partofday = "Hommikutrenn";
  }
  if($hournow > 9 and $hournow <= 15){
	  $partofday = "kool";
  }
  if($hournow > 15 and $hournow <= 17){
    $partofday = "õhtutrenn";
  }
  if($hournow > 17 and $hournow < 21){
	  $partofday = "Kodutöö";
  }
  if($hournow >= 21 ){
    $partofday = "hiline aeg";
}
if($hournow < 6) {
    $partoftday = "uneaeg";
}//enne 6

  
  //vaatame semestri kulgemist
  $semesterstart = new DateTime("2020-08-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $semesterdurationdays = $semesterduration->format("%r%a");
  $today = new DateTime("now");
  $semesterruntime =  $semesterstart->diff($today);
  $semesterruntimedays = $semesterruntime->format("%r%a");
  $semesterpercent = $semesterruntimedays / $semesterdurationdays * 100;
  if($semesterruntimedays < 0){
    $semesterruntimedays = "pole alanud";
    $semesterpercent = "0";
  }
  if($semesterruntime > $semesterduration){
    $semesterruntimedays = "läbi juba";
    $semesterpercent = "100";
  }
  //määran lubatud pildi vormingud
  $picfiletypes = ["image/jpeg", "image/png"];
  //piltide katalogi sisu lugemine ja näitamine
  //$allfiles = scandir(scandir("../vp_pics/"));
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  //var_dump($allfiles);
  //$picfiles = array_slice($allfiles, 2);
  $picfiles = [];
  foreach($allfiles as $thing){
	  $fileinfo = getImagesize("../vp_pics/" . $thing);
	  if(in_array($fileinfo["mime"], $picfiletypes)){
		array_push($picfiles,$thing);  
	  }
  }
  
  //kõik pildid
  $piccount = count($picfiles);
  $imghtml = "";
  for ($i = 0; $i < $piccount; $i ++ ){
	  $imghtml .= '<img src="../vp_pics/'.$picfiles[$i] .'" alt="Tallinna Ülikool">' ;
  }
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset[$weekdaynow - 1] .", " . $fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <h2>Veits semestri kohta</h2>
  <p><?php echo "Praegu on semesteri pikkus " .$semesterdurationdays ."."; ?></p>
  <p><?php echo "Praegu on semester kestnud juba nii mitu päeva: " .$semesterruntimedays ."."; ?></p>
  <p><?php echo "Sama lugu protsentidena " .$semesterpercent ."%."; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <?php echo $ideahtml; ?>
  <hr>
  <form method="POST">
	<label>Sisesta oma mõtetera </label>
	<input type="text" name="ideainput" placeholder="kirjuta siia">
	<input type="submit" name="ideasubmit" value="Pane mõte teele!">
  </form>
</body>
</html>
