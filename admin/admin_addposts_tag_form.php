<?php
require_once 'header.php';
?>
        <div class="main">
            <div class="body container">
                <div class="colgroup">
                    <div class="typecho-page-title col-mb-12">
                        <h2>标签和分类</h2>
                    </div>
                </div>
                <div class="colgroup typecho-page-main manage-metas">              
                    <div class="col-mb-12 col-tb-8" role="main">


                        <ul class="typecho-list-notable tag-list clearfix">
                            <ul>
                                <?php
                                $cat = new Category();
                                $list = $cat->get_tag_list();
                                foreach ($list as $row) {
                                    //print_r($row);
                                    ?>
                                    <?php echo "<li><a href='#'> {$row['name']} </a></li>" ?>
                                <?php } ?>
                            </ul>
                        </ul>


                    </div>
                    <div class="col-mb-12 col-tb-4" role="form">
                        <form action="admin_addposts_tag.php" method="post" name="moudleform"  onsubmit="">
                            <ul class="typecho-option" id="typecho-option-item-name-0">
                                <li>
                                    <label class="typecho-label" for="name-0-1">
                                        标签名称 *</label>
                                    <input id="name-0-1" name="name" type="text" class="text" />
                                    <p class="description">
                                        这是标签在站点中显示的名称.可以使用中文,如 "地球".</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-slug-1">
                                <li>
                                    <label class="typecho-label" for="slug-0-2">
                                        标签缩略名</label>
                                    <input id="slug-0-2" name="slug" type="text" class="text" />
                                    <p class="description">
                                        标签缩略名用于创建友好的链接形式, 如果留空则默认使用标签名称.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-do-2" style="display:none">
                                <li>
                                    <input name="submit" type="submit" value="" />
                                </li>
                            </ul>
                            <ul class="typecho-option typecho-option-submit" id="typecho-option-item--4">
                                <li>
                                    <button type="submit" class="primary">
                                        增加标签</button>
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
