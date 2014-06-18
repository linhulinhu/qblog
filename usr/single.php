<?php
session_start();
require_once '../config.php';
require_once ROOT_PATH . '/usr/header.php';
?>

<section>
    <article id="post-">
        <?php
        $posts = new Post();
        $id = $_GET['id'];
        $_SESSION['pid'] = $_GET['id'];
        $list = $posts->GetDetails($id);
        //print_r($list);
        $catname = $posts->ShowPostIdCat($id, "category");
        $tagname = $posts->ShowPostIdCat($id, "tag");
        $u = new User();
        $uu = $u->GetDetails($list['authorid']);
        // print_r($uu);
        //print_r($catname)."分类asdasd";
        ?>
        <header>
            <h2><?php echo $list['title']; ?></h2>
            <p>
                <span class="author">作者:<?php echo $uu['nikename']; ?></span><span class="time">发表时间:<?php echo $list['posttime']; ?></span>
<!--                <span class="commentpost">评论:</span>
                <span class="views"></span>-->
            </p>
        </header>
        <section>
            <?php echo $list['content']; ?>
        </section>
        <footer>
            <p><span>标签:</span><?php
                foreach ($tagname as $row) {
                    ?>
                    <span><?php echo "<a href='tag.php?id={$row['mid']}'> {$row['name']} </a>" ?></span>
                <?php } ?>
            </p>
            <P>
                该日志发表在<?php foreach ($catname as $row) { ?>
                    <span><?php echo "<a href='category.php?id={$row['mid']}'> {$row['name']} </a>" ?></span>
                <?php } ?>
                分类下，通告目前不可用，你可以至底部留下评论。
                原创文章转载请注明: <?php echo "<a href='single.php?id={$list['pid']}'> {$list['title']} </a>"; ?><br/>
            </p>
        </footer>
    </article>

    <?php
    //显示评论
    $c = new Comment();
    $showc = $c->ShowPostIdComments($id);
    //print_r($showc);
    foreach ($showc as $row) {
        ?>
    <div class="comment-post">
            <div class="comment-left">
                <p><img src="<?php echo get_gravatar($row['mail'], '80', 'wavatar', 'g', false); ?>" /></p>
            </div>
            <div class="comment-right">
                <p><?php echo "<a href='{$row['url']}'>{$row['user']} </a>" ?>在<?php echo $row['time']; ?>说 </p>
                <p class="comrow"><span>内容:</span><?php echo $row['content']; ?></p>
            </div>
        </div>
    <?php } ?>
    <?php require_once 'comments.php'; ?>

    <nav>
    </nav>
</section>

<!--中间结束-->
<?php require_once ROOT_PATH . '/usr/sidebar.php'; ?>
<?php require_once ROOT_PATH . '/usr/footer.php'; ?>