<?php
session_start();
/**
 * 页面检测
 */
if (!isset($_SESSION['isLogin']) || !isset($_SESSION['username']) || empty($_SESSION)) {
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='../404.php'";
    echo "</script>";
}
?>
