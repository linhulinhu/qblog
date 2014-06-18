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
                    <?php echo "<li><a href='category.php?id={$row['mid']}'> {$row['name']} </a></li>" ?>
                <?php } ?>
            </ul>
        </li>
        <li>
            <h3>最新内容*</h3>
            <ul>
                <?php
                $posts = new Post();
                $list = $posts->ShowPostNum(6);
                foreach ($list as $row) {
                    ?>
                    <?php $t = iconv_substr($row['title'], 0, 25, "utf-8") ?>
                    <li><?php echo "<a href='single.php?id={$row['pid']}'>{$t}...</a>"; ?></li>
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
                    <li><?php echo "<a href='single.php?id={$row['pid']}'>{$t}...</a>"; ?></li>
                <?php } ?>
            </ul>
        </li> 

    </ul>
</aside>