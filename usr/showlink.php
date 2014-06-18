<?php
require_once '../config.php';
header("Content-type:text/html;charset=utf-8");
$showurl = new Friendlink();
$show_url_list = $showurl->ShowUrl();
foreach ($show_url_list as $url_list) {
    echo "<div class=\"url_list\">";
    echo "<ul>";
    echo "<li>";
    echo "<a href='{$url_list['lurl']}'> {$url_list['lname']}</a>";
    //echo $url_list['linkurl'];
    echo "</li>";
    echo "</ul >";
    echo "</div>";
}
//echo "<pre>";
//print_r($show_url_list);
//echo "</pre>";
?>
