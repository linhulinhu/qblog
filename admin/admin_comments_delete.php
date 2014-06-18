<?php

/**
 * 删除单条信息
 * 
 */
require_once '../config.php';

header("Content-type:text/html;charset=utf-8");
$book = new Comment();
if (!isset($_POST['name']) || !isset($_POST['content'])) {
    $book->DeleteBook($_GET['titleid']);
    header("Location:admin_show_coments_list.php");
}
?>
