<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Html5、Css3、前端设计、后端开发、电脑技术、搜索引擎、网络安全、Web 2.0的IT技术网站。" />
    <title>yyxblog</title>
    <link rel="stylesheet" type="text/css" href="usr/style.css" title="style" />
    <link rel="shortcut icon" href="usr/img/favicon.ico" />
    <!--H5-->
    <!--[if lt IE 9]>
    <script src="usr/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <!-- PNG -->
    <!--[if lt IE 7]>
    <script type="text/javascript" src="usr/js/pngfix.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('.logo,#back-top span,#back-top,.time,.author,.comment');
    </script>
    <![endif]-->
    <!--[if IE 6]>
    <script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
    <![endif]-->
    <script type="text/javascript" src="usr/js/jquery.min.js" ></script>
    <script type="text/javascript" src="usr/js/headsome.js"></script>
    <!--滚屏-->
    <script type="text/javascript" src="usr/js/scrolling.js"></script>
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
    <script src="usr/js/jquery.lavalamp-1.3.5.js" ></script>
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
    require_once 'config.php';
//require_once ROOT_PATH.'/usr/header.php';
    require_once ROOT_PATH . '/usr/functions.php';
    ?>
    <header>
        <hgroup>
            <h1><a href="" id="logo"><img src="usr/img/logo.png" title="" alt="" /></a></h1>
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
        <section>    
            <article id="post-">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                //echo $page;
                $posts = new Post();
                //$tagname = $posts->ShowPostIdCat($id, "tag");
                $list = $posts->ShowPageListAll(5, $page);
                $u = new User();
                foreach ($list as $row) {
                    ?>
                    <header>
                        <h2><?php echo "<a href='usr/single.php?id={$row['pid']}'> {$row['title']} </a>"; ?></h2>
                        <p>
                            <?php
                            $uu = $u->GetDetails($row['authorid']);
                            ?>
                            <span class="author">作者:<?php echo $uu['nikename']; ?></span><span class="time">发表时间:<?php echo $row['posttime']; ?></span>
    <!--                    <span class="commentpost">评论:999</span>
                            <span class="views">999</span>-->
                        </p>
                    </header>
                    <section>
                        <?php echo cutstr_html($row['content'], 150, "...") ?>
                    </section>
                    <footer>
                        <p>
                            <span class="tags">标签:
                                <?php
                                $tagname = $posts->ShowPostIdCat($row['pid'], "tag");
                                foreach ($tagname as $row) {
                                    echo "<a href='tag.php?id={$row['mid']}'> {$row['name']} </a>";
                                }
                                ?>
                            </span> 
                            <span class="cate">分类：
                                <?php
                                $catname = $posts->ShowPostIdCat($row['pid'], "category");
                                foreach ($catname as $row) {
                                    echo "<a href='usr/category.php?id={$row['mid']}'> {$row['name']} </a>";
                                }
                                ?>
                            </span>
                        </p>
                    </footer>
                <?php } ?>
            </article>

            <!--翻页-->
            <nav><p><?php echo "<a href='?page=" . ($page - 1) . "'>上一页</a><a href='?page=" . ($page + 1) . "'>下一页</a>"; ?></p></nav>

        </section>

        <aside>
            <ul>
                <li>
                    <h3>分类*</h3>
                    <ul>
                        <?php
                        $cat = new Category();
                        $list = $cat->get_cat_list();
                        foreach ($list as $row) {
                            //print_r($row);
                            ?>
                            <?php echo "<li><a href='usr/category.php?id={$row['mid']}'> {$row['name']} </a></li>" ?>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <h3>最新内容*</h3>
                    <ul>
                        <?php
                        $posts = new post();
                        $list = $posts->ShowPostNum(6);
                        foreach ($list as $row) {
                            ?>
                            <?php $t = iconv_substr($row['title'], 0, 25, "utf-8") ?>
                            <li><?php echo "<a href='usr/single.php?id={$row['pid']}'>{$t}...</a>"; ?></li>
                        <?php } ?>
                    </ul>
                </li>

                <li>
                    <h3>最近评论*</h3>
                    <ul>
                        <?php
                        $coms = new Comment();
                        $list = $coms->ShowCommentsNum(5);
                        foreach ($list as $row) {
                            ?>
                            <?php $t = iconv_substr($row['content'], 0, 15, "utf-8") ?>
                            <li><?php echo "<a href='usr/single.php?id={$row['pid']}'>{$t}...</a>"; ?></li>
                        <?php } ?>
                    </ul>
                </li> 

            </ul>
        </aside>
    </section>
    <footer>
        <p>COPYRIGHT © 2014 Design By<a href="http://yanyuxing.cn" title="">YYX</a></p>
    </footer>
    <div id="upDown">
        <a href="#" class="upMove" title="返回顶部"></a><a href="#" class="hdMove" title="单击跟随鼠标上下滚动"></a><a href="#" class="downMove" title="返回底部"></a>
    </div>
</body>
</html>