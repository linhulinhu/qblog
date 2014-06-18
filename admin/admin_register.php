<?php
session_start();
require_once 'page_check.php';
require_once '../config.php';
$user = new User();
$user->username = $_POST['username'];
$user->nikename = $_POST['nikename'];
$user->userpass = md5($_POST['userpass']);
$user->mail = $_POST['mail'];
$user->url = $_POST['url'];
//$user->username = $username;
//$user->userpass = $userpass;
//$user->email = $email;
//print_r($user);
?>
<html>
    <head>
        <title>添加用户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <?php if ($user->register()) { ?>
            发表成功. <span id="time">3</span>秒后，页面会自动跳转<br />
            如果浏览器没有自动跳转，请点击<a id="jump_url" href="admin_show_user_list.php"></a>.
            <?php
        } else {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('注册失败！');";
            echo "window.location.href='admin_register_form.php'";
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