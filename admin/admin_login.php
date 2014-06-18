<?php

/**
 * 用户登录
 */
session_start();
require_once '../config.php';
header("Content-type:text/html;charset=utf-8");
if (isset($_POST['code'])) {
    $checkstr = $_SESSION['code']; //使用$_SESSION变量获页面上的验证码
    $str = $_POST['code'];   //用户输入的字符串
    if (strcasecmp($str, $checkstr) !== 0) { //不区分大小写进行比较
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('验证码不正确请重新输入！');";
        echo "window.location.href='login.php'";
        echo "</script>";
    } else {
        $user = new User();
        $user->username = $_POST['username'];
        $user->userpass = md5($_POST['userpass']);
        $u = $user->login();
        if ($u > 0) {
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['userid'] = $u;
            $_SESSION['isLogin'] = 1;
            echo "<script language='javascript' type='text/javascript'>";
            echo "window.location.href='login_index.php'";
            echo "</script>";
//            header('Location:login_index.php');
        }
    }
}

//注销登录
if ($_GET['action'] == "logout") {
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['isLogin']);
    echo '注销成功！点击此处 <a href="login.php">登录</a>';
    exit;
}
?>
