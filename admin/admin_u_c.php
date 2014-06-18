<?php
require_once '../config.php';
$cu=new User();
$username = $_GET["xname"];
//print_r($username)."SDFDSFF";
$cu->CUser($username);
?>