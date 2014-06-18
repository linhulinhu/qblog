<?php
session_start();
require_once '../config.php';
$link = new Friendlink();
$lname = $_POST['lname'];
$lurl = $_POST['lurl'];
$description = $_POST['description'];
$link->lname = $lname;
$link->lurl = $lurl;
$link->description = $description;
?>
<html>
    <head>
        <title>添加链接</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <?php if ($link->AddUrl()) { ?>
            发表成功. <span id="time">3</span>秒后，页面会自动跳转<br />
            如果浏览器没有自动跳转，请点击<a id="jump_url" href="admin_add_link_form.php"></a>.
            <?php
        } else {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('添加链接失败！');";
            echo "window.location.href='admin_add_link_form.php'";
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

