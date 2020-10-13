<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf8_estonian_ci">
  <title>VP Johan</title>

  <style>
    <?php
  echo "body{ \n";
  if(isset($_SESSION["userbgcolor"])){
    echo "\t \t background-color: " .$_SESSION["userbgcolor"] ."; \n";
  }
  else{
    echo "\t \t background-color: #FFF; \n";
  }
  if(isset($_SESSION["usertxtcolor"])){
    echo "\t \t color: " .$_SESSION["usertxtcolor"] ."; \n";
  }
  else{
    echo "\t \t color: #000; \n";
  }
  echo "\t } \n";
    ?>
  </style>
</head>
<body>