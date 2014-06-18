<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Html5、Css3、前端设计、后端开发、电脑技术、搜索引擎、网络安全、Web 2.0的IT技术网站。" />
    <title>yyxblog</title>
    <link rel="stylesheet" type="text/css" href="style.css" title="style" />
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!--H5-->
    <!--[if lt IE 9]>
    <script src="js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <!-- PNG -->
    <!--[if lt IE 7]>
    <script type="text/javascript" src="js/pngfix.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('.logo,#back-top span,#back-top,.time,.author,.comment');
    </script>
    <![endif]-->
    <!--[if IE 6]>
    <script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/headsome.js"></script>
    <!--滚屏-->
    <script type="text/javascript" src="js/scrolling.js"></script>
    <!--Back to top button -->
    <script>
        $(document).ready(function() {
            // hide #back-top first
            $("#back-top").hide();
            // fade in #back-top
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });

        });
    </script>

    <!--The special effects navigation loading code-->
    <script src="js/jquery.lavalamp-1.3.5.js" ></script>
    <script>
        // jquery initialize:
        $(function() {
            $('ul#nav_menu').lavaLamp({fx: 'swing', speed: 333});
            loadLamps(easing);
            $('select#easing option[value=' + easing + ']').attr('selected', 'selected');
            $('span.easingLabel').text(easing);
        });
    </script>
</head>
<body>
    <?php
    require_once '../config.php';
//require_once ROOT_PATH.'/usr/header.php';
    require_once ROOT_PATH . '/usr/functions.php';
    ?>
    <header>
        <hgroup>
        <h1><a href="" id="logo"><img src="img/logo.png" title="" alt="" /></a></h1>
            <h2 id="site-description"></h2>
        </hgroup>
        <form method="get" id="searchform" action="/">
            <input type="text" class="field" id="s" name="s" value="" placeholder="关键字" required="required" autofocus="autofocus">
            <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search">
        </form> 
    </header>
    <!--顶部导航菜单-->
    <nav>
        <ul id="nav_menu" >
            <li><a href="index.php" title="">首页</a></li>
		    <li><a href="#" title="">Tag</a></li>
            <li><a href="#" title="">关于</a></li>
            <li><a href="#" title="">联系</a></li>
        </ul>
    </nav>
    <section>