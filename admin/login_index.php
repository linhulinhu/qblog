<?php
require_once 'header.php';
?>

        <div class="main">
            <div class="container typecho-dashboard">
                <div class="colgroup">
                    <div class="typecho-page-title col-mb-12">
                        <h2>网站概要</h2>
                    </div>
                </div>
                <div class="colgroup typecho-page-main">
                    <div class="col-mb-12 welcome-board" role="main">
                        <?php
                        $posts = new Post();
                        $com = new Comment();
                        ?> 
                        <p>目前有 <em><?php echo $posts->ShowLogtotalNumber(); ?></em> 篇日志, 并有 <em><?php echo $com->ShowCommentstotalNumber(); ?></em> 条关于你的评论.</p>
                        <p>你当前的时间为:<spam id="timeclock"></spam></p>
                        <script language="javascript">
                            function clockon()
                            {
                                var now = new Date();
                                var year = now.getFullYear(); //getFullYear getYear  
                                var month = now.getMonth();
                                var date = now.getDate();
                                var day = now.getDay();
                                var hour = now.getHours();
                                var minu = now.getMinutes();
                                var sec = now.getSeconds();
                                var week;
                                month = month + 1;
                                if (month < 10)
                                    month = "0" + month;
                                if (date < 10)
                                    date = "0" + date;
                                if (hour < 10)
                                    hour = "0" + hour;
                                if (minu < 10)
                                    minu = "0" + minu;
                                if (sec < 10)
                                    sec = "0" + sec;
                                var arr_week = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
                                week = arr_week[day];
                                var time = "";
                                time = year + "年" + month + "月" + date + "日" + " " + hour + ":" + minu + ":" + sec + " " + week;

                                document.getElementById("timeclock").innerHTML = "[" + time + "]";
                                var timer = setTimeout("clockon()", 200);
                            }
                            clockon();
                        </script>  
                        <?php
                        $iipp = ":" . $_SERVER["REMOTE_ADDR"];
                        date_default_timezone_set('Asia/Shanghai');
                        echo "你的登录ip地址为" . $iipp . "</br>";
                        echo "你当前服务器信息为" . php_uname() . "</br>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once 'footer.php';
?>