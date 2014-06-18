<?php

/**
 * 删除单条信息
 * 
 */
require_once '../config.php';;

header("Content-type:text/html;charset=utf-8");
$posts = new Post();
if (!isset($_POST['title']) || !isset($_POST['content'])) {
    $posts->Delete($_GET['titleid']);
    header("Location:admin_show_posts_list.php");
}
?>
