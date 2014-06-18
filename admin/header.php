<?php
session_start();
require_once 'page_check.php';
require_once '../config.php';
?>
<!DOCTYPE HTML>
<html class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>博客后台管理</title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="css/normalize.css"> 
        <link rel="stylesheet" href="css/grid.css"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/jquery_notification.css">
        <script src="js/ajax.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_notification_v.js"></script>
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="s/respond.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 9]>
            <div class="message error browsehappy">当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.</div>
        <![endif]-->
        <div class="typecho-head-nav clearfix" role="navigation">
            <nav id="typecho-nav-list">
                <ul class="root focus">
                    <li class="parent"><a href="login_index.php">控制台</a></li>
                    <ul class="child">
                        <li class="focus"><a href="login_index.php">概要</a></li>
                        <li><a href="#">个人设置</a></li>
                    </ul>
                </ul>
                <ul class="root">
                    <li class="parent"><a href="#">撰写</a></li>
                    <ul class="child">
                        <li><a href="admin_add_posts_form.php">撰写文章</a></li>
                    </ul>
                </ul>
                <ul class="root">
                    <li class="parent"><a href="#">管理</a></li>
                    <ul class="child">
                        <li><a href="admin_show_posts_list.php">文章</a></li>
                        <li><a href="admin_show_coments_list.php">评论</a></li>
                        <li><a href="admin_addposts_cat_form.php">分类管理</a></li>
                        <li><a href="admin_addposts_tag_form.php">标签管理</a></li>
                        <li class="last"><a href="admin_show_user_list.php">用户</a></li>
                        <li class="last"><a href="admin_register_form.php">新增用户</a></li>
                    </ul>
                </ul>
                <ul class="root">
                    <li class="parent"><a href="#">设置</a></li>
                    <ul class="child"><li><a href="#">基本</a></li>
                    </ul>
                </ul>    
            </nav>
            <div class="operate">
                <a title="最后登录: 4小时前" href="" class="author"><?php echo $_SESSION['username']; ?></a>
                <a class="exit" href="admin_login.php?action=logout">登出</a>
                <a href="http://yanyuxing.cn/" target="_blank">网站</a>
            </div>
        </div>