<?php
require_once 'header.php';
?>
<div class="main">
    <div class="body container">
        <div class="colgroup">
    <div class="typecho-page-title col-mb-12">
        <h2>管理评论</h2>
    </div>
</div>
        <div class="colgroup typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
            
                <div class="typecho-table-wrap">
<?php 
require_once '../config.php';
//require_once ROOT_PATH.'/includes/header.php'; 
?>
    <?php
    /**
     * 用户留言显示
     * 
     */
    $book = new Comment();
    $list = $book->ShowBookList();
    echo "<div class=\"shownews\">";
    foreach ($list as $element) {
        echo "<div class=\"shownews_list\">";

        echo "<div class=\"show_cn\"><a href='admin_comments_info.php?id={$element['coid']}'>{$element['content']}</a> <a href='admin_comments_delete.php?titleid={$element['coid']}'>删除</a></div>";
        echo "<div class=\"show_time\">{$element['time']}</div>";
        echo "</div>";
    }
    echo "</div>";
    ?>
                </div>

            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>

<?php
require_once 'footer.php';
?>
