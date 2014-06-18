<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../config.php';
$code = new Code(80, 28, 4);
$code->ShowImage();
$_SESSION['code'] = $code->CheckCode;
//print_r($_SESSION['code']);
?>
