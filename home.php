<?php
  $username = "Johan Leoste";
  $fulltimenow = date("d.m.Y H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
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
    $paroftday = "uneaeg";
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
  
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> programmeerib veebi</title>

</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <h2>Veits semestri kohta</h2>
  <p><?php echo "Praegu on semester pikkusega " .$semesterdurationdays ."."; ?></p>
  <p><?php echo "Praegu on semester kestnud juba " .$semesterruntimedays ."."; ?></p>
  <p><?php echo "Sama lugu protsentidena " .$semesterpercent ."%."; ?></p>
</body>
</html>
