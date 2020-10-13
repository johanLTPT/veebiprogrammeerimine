<?php
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
$picnum = mt_rand(0, ($piccount - 1));
$imghtml = "";

$imghtml .= '<img src="../vp_pics/'.$picfiles[$picnum] .'" alt="Tallinna Ülikool">' ;

?>