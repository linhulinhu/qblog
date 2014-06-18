<?php

session_start();
//内容实例化
require_once '../config.php';
require_once 'page_check.php';
$category = new Category();
$category->name = $_POST["name"];
$category->slug = $_POST["slug"];
$category->type = "category";
$category->description = $_POST["description"];
?>
<html>
    <head>
        <title>添加分类</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <?php if ($category->add_category()) { ?>
            发表成功. <span id="time">3</span>秒后，页面会自动跳转<br />
            如果浏览器没有自动跳转，请点击<a id="jump_url" href="login_indexsssss.php"></a>.
            <?php
        } else {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('添加类别失败！');";
            echo "window.location.href='admin_addposts_cat_form.php'";
            echo "</script>";
        }
        ?>
    </body>
    <script type="text/javascript">
        var timer = null;
        function change_time(){
            var left_time_span = document.getElementById('time');
            var left_time = 1;
            if (left_time_span) {
                left_time = left_time_span.innerHTML;
            }

            if (left_time == '1') {
                var url = document.getElementById('jump_url').href;
                clearInterval(timer);
                window.location.href= url;
            } else {
                left_time_span.innerHTML = left_time - 1;
            }
        }
        timer = setInterval(change_time,1000);
    </script>
</html>
