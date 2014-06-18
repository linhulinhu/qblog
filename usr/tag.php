<?php
require_once '../config.php';
require_once ROOT_PATH . '/usr/header.php';
?>
<!--中间开始-->
<section>    
    <article id="post-">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        //echo $page;
        $posts = new Post();
        $id = $_GET['id'];
        // print_r($id);
        $list = $posts->ShowCatPost($id, 5, $page);
        $u = new User();
        foreach ($list as $row) {
            ?>
            <header>
                <h2><?php echo "<a href='single.php?id={$row['pid']}'> {$row['title']} </a>"; ?></h2>
                <p>
                    <?php
                    $uu = $u->GetDetails($row['authorid']);
                    ?>
                    <span class="author">作者:<?php echo $uu['nikename']; ?></span><span class="time">发表时间:<?php echo $row['posttime']; ?></span>
    <!--                            <span class="commentpost">评论:999</span>
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
                            echo "<a href='category.php?id={$row['mid']}'> {$row['name']} </a>";
                        }
                        ?>
                    </span>
                </p>
            </footer>
        <?php } ?>
    </article>

    <!--翻页-->
    <nav><p><?php echo "<a href='?id={$_GET['id']}&page=" . ($page - 1) . "'>上一页</a><a href='?id={$_GET['id']}&page=" . ($page + 1) . "'>下一页</a>"; ?></p></nav>

</section>
<!--中间结束-->
<?php require_once ROOT_PATH . '/usr/sidebar.php'; ?>
<?php require_once ROOT_PATH . '/usr/footer.php'; ?>
