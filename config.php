<?php

require_once("config/config.php");

$link = mysqli_connect(strHostName, strUserName, strPassword, strDbName);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    exit();
}

?>