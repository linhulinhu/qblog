<?php
require_once 'header.php';
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
    <div class="typecho-page-title col-mb-12">
        <h2>显示评论</h2>
    </div>
</div>
        <div class="colgroup typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
            
                <div class="typecho-table-wrap">
 <?php
        $book = new Comment;
        $id = $_GET['id'];
        $list = $book->GetBookDetails($id);
        ?>
        <!--显示留言信息-->
        <div class="user_info">
                <div class="user_theme_title">
                    <ul>
                        <li>
                           <span>用户名:</span><?php echo $list['user']; ?>
                        </li>

                        <li><span>时间:</span><?php echo $list['time']; ?></li>

                        <li><span>邮箱:</span><?php echo $list['mail']; ?></li>
      
                        <li><span>主页:</span><?php echo $list['url']; ?></li>
                    </ul>
                </div>
            <!--      显示内容开始-->
            <div class="user_theme_content"> <?php echo $list['content']; ?> </div>
            <!--      显示内容结束--> 
        </div>
                </div>

            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>

<?php
require_once 'footer.php';
?>
