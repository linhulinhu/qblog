<?php
require_once 'header.php';
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
    <div class="typecho-page-title col-mb-12">
        <h2>管理文章<a href="admin_add_posts_form.php">新增</a></h2>
    </div>
</div>
        <div class="colgroup typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
            
                <div class="typecho-table-wrap">
<?php 
require_once '../config.php';
//require_once ROOT_PATH.'/includes/header.php'; 
?>
      <div class="shownews">
            <?php
            $page=isset($_GET['page'])? $_GET['page']:1;
            //echo $page;
            $posts = new Post();
            //$list = $news->ShowList(1);
            $list=$posts->ShowPageListAll(5,$page);
            foreach ($list as $row) {
                ?>
                <div class="shownews_list">
                    <div class="show_cn">
                        <?php echo "<a href='admin_posts_update.php?id={$row['pid']}'> {$row['title']} </a> <a href='admin_posts_delete.php?titleid={$row['pid']}'>删除</a>"; ?>
                    </div>
                    <div class="show_time"><?php echo $row['posttime']; ?></div>
                </div>
            <?php } ?>
          <?php  echo "<a href='?page=".($page-1)."'>上一页</a><a href='?page=".($page+1)."'>下一页</a>";   ?>

        </div>
                </div>

            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>

<?php
require_once 'footer.php';
?>
