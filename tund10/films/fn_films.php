<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function router($table){
        header("Location: films/read/" .$table .".php");
}