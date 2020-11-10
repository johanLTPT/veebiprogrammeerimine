<?php
  //session_start();
  require("classes/SessionManager.class.php");
  SessionManager::sessionStart("vpj", 0, "/~johaleo/", "greeny.cs.tlu.ee");
  //if login
  if(!isset($_SESSION["userid"])){
    //jõuga suunatakse sisselogimise lehele
    header("Location:page.php");
    exit();
  }
  //logout
  if(isset($_GET["logout"])){
    //lõpetame sessiooni
    session_destroy();
    header("Location:page.php");
    exit();
  }
