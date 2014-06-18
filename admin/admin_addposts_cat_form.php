<?php
require_once 'header.php';
?>

        <div class="main">
            <div class="body container">
                <div class="colgroup">
                    <div class="typecho-page-title col-mb-12">
                        <h2>分类</h2>
                    </div>
                </div>
                <div class="colgroup typecho-page-main manage-metas">

                    <div class="col-mb-12 col-tb-8" role="main">

                        <ul class="typecho-list-notable tag-list clearfix">
                            <ul>
                                <?php
                                $cat = new Category();
                                $list = $cat->get_cat_list();
                                foreach ($list as $row) {
                                    //print_r($row);
                                    ?>
                                    <?php echo "<li><a href='#'> {$row['name']} </a></li>" ?>
                                <?php } ?>
                            </ul>
                        </ul>

                    </div>
                    <div class="col-mb-12 col-tb-4" role="form">
                        <form action="admin_addposts_cat.php" method="post" name="moudleform" onsubmit="">
                            <ul class="typecho-option" id="typecho-option-item-name-0">
                                <li>
                                    <label class="typecho-label" for="name-0-1">
                                        分类名称 *</label>
                                    <input id="name-0-1" name="name" type="text" class="text" />
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-slug-1">
                                <li>
                                    <label class="typecho-label" for="slug-0-2">
                                        分类缩略名</label>
                                    <input id="slug-0-2" name="slug" type="text" class="text" />
                                    <p class="description">
                                        分类缩略名用于创建友好的链接形式,建议使用字母,数字,下划线和横杠.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-description-2">
                                <li>
                                    <label class="typecho-label" for="description-0-3">
                                        分类描述</label>
                                    <textarea id="description-0-3" name="description">
                                    </textarea>
                                    <p class="description">
                                        此文字用于描述分类,在有的主题中它会被显示.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-do-3" style="display:none">
                                <li>
                                    <input name="submit" type="hidden" value="" />
                                </li>
                            </ul>
                            <ul class="typecho-option typecho-option-submit" id="typecho-option-item--5">
                                <li>
                                    <button type="submit" class="primary">
                                        增加分类</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
require_once 'footer.php';
?>
