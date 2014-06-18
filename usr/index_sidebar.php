<?php
//require_once '../config.php';
//header("Content-type:text/html;charset=utf-8");
?>
           <section class="post-option">
               <h2>分类*</h2>
                            <ul>
                                <?php 
                                $cat =new Category();
                                $list=$cat->get_cat_list();
                                foreach ($list as $row) {
                               //print_r($row);
                                ?>
                                <?php echo "<a href='usr/category.php?id={$row['mid']}'> {$row['name']} </a>" ?>
                                <?php } ?>
                            </ul>
            </section>
             <section class="post-option">
                 <h2>标签*</h2>
                            <ul>
                                <?php 
                                $cat =new Category();
                                $list=$cat->get_tag_list();
                                foreach ($list as $row) {
                               //print_r($row);
                                ?>
                               <?php echo "<a href='usr/tag.php?id={$row['mid']}'> {$row['name']} </a>" ?>
                                <?php } ?>
                            </ul>
             </section>
        <div>
             <h2>最新内容</h2>
            <?php
                $posts = new Post();
            $list=$posts->ShowPostNum(6);
            foreach ($list as $row) {
                ?>
                <div class="info">
                    <div class="title">
                        <?php $t=iconv_substr($row['title'],0,25,"utf-8") ?>
                        <ul><li><?php echo "<a href='usr/single.php?id={$row['pid']}'>{$t}...</a>"; ?></li></ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div>
            <h2>最新评论</h2>
            <?php
            $coms = new Comment();
            $list=$coms->ShowCommentsNum(5);
            foreach ($list as $row) {
                ?>
                <div class="info">
                    <div class="title">
                         <?php $t=iconv_substr($row['content'],0,15,"utf-8") ?>
                        <ul><li><?php echo "<a href='usr/single.php?id={$row['pid']}'>{$t}...</a>"; ?></li></ul>
                    </div>
                </div>
            <?php } ?>
        </div>


