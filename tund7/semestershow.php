<?php
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$monthnow = date("m");
$daynow = date("d");
$yearnow = date("Y");
$time = date("H:i:s");
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
?>
<p >Lehe avamise hetk: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$daynow ."." .$monthnameset[$monthnow - 1] ." " .$yearnow .", kell " . $time ?>.</p>
<p><?php echo "Praegu on " .$partofday ."."; ?></p>
<h2 style="color:#336CFF;">Veits semestri kohta</h2>
<p><?php echo "Praegu on semesteri pikkus " .$semesterdurationdays ."."; ?></p>
<p><?php echo "Praegu on semester kestnud juba nii mitu päeva: " .$semesterruntimedays ."."; ?></p>
<p><?php echo "Sama lugu protsentidena " .$semesterpercent ."%."; ?></p>
<hr>