<?php
require_once 'header.php';
if (isset($_POST['submit'])) {
    require_once 'admin_add_posts.php';
}
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
            <div class="typecho-page-title col-mb-12">
                <h2>撰写新文章</h2>
            </div>
        </div>
        <div class="colgroup typecho-page-main typecho-post-area" role="form">
            <?php
            require_once '../config.php';
            ?>
            <link rel="stylesheet" href="editor/themes/default/default.css" />
            <link rel="stylesheet" href="editor/plugins/code/prettify.css" />
            <script charset="utf-8" src="editor/kindeditor.js"></script>
            <script charset="utf-8" src="editor/lang/zh_CN.js"></script>
            <script charset="utf-8" src="editor/plugins/code/prettify.js"></script>
            <script>
                KindEditor.ready(function(K) {
                    var editor1 = K.create('textarea[name="content"]', {
                        cssPath: 'editor/plugins/code/prettify.css',
                        uploadJson: 'editor/php/upload_json.php',
                        fileManagerJson: 'editor/php/file_manager_json.php',
                        allowFileManager: true,
                        afterCreate: function() {
                            var self = this;
                            K.ctrl(document, 13, function() {
                                self.sync();
                                K('form[name=write_post]')[0].submit();
                            });
                            K.ctrl(self.edit.doc, 13, function() {
                                self.sync();
                                K('form[name=write_post]')[0].submit();
                            });
                        }
                    });
                    prettyPrint();
                });
            </script>
            <form action="" method="post" name="write_post">
                <div class="col-mb-12 col-tb-9" role="main">

                    <p class="title">
                        <label for="title" class="sr-only">标题</label>
                        <input type="text" id="title" name="title" autocomplete="off" value="" placeholder="标题" class="w-100 text title" />
                    </p>
                    <p class="title">
                        <label for="title" class="sr-only">别名*</label>
                        <input type="text" id="title" name="slug" autocomplete="off" value="" placeholder="别名" class="w-100 text title" />
                    </p>

                    <label for="text" class="sr-only">文章内容</label>
                    <textarea style="height: 310px;width: 98%" autocomplete="off" id="text" name="content" class="w-100 mono"></textarea>
                    </p>

                    <p class="submit clearfix">
                        <span class="right">
                            <button type="submit" name="submit" value="save" id="btn-save">保存草稿</button>
                            <button type="submit" name="submit" value="publish" class="primary" id="btn-submit">发布文章</button>
                        </span>
                    </p>

                </div>

                <div id="edit-secondary" class="col-mb-12 col-tb-3" role="complementary">



                    <div id="tab-advance" class="tab-content">

                        <section class="typecho-post-option category-option">
                            <label class="label">分类*</label>
                            <ul>
                                <?php
                                $cat = new Category();
                                $list = $cat->get_cat_list();
                                foreach ($list as $row) {
                                    //print_r($row);
                                    ?>
                                    <li><input type="checkbox" id="cat" name="catid[]" value="<?php echo $row[mid]; ?>"/><label><?php echo $row[name]; ?></label></li>
                                <?php } ?>
                            </ul>
                        </section>
                        <section class="typecho-post-option category-option">
                            <label class="label">标签*</label>
                            <ul>
                                <?php
                                $cat = new Category();
                                $list = $cat->get_tag_list();
                                foreach ($list as $row) {
                                    //print_r($row);
                                    ?>
                                    <li><input type="checkbox" id="cat" name="tagid[]" value="<?php echo $row[mid]; ?>"/><label><?php echo $row[name]; ?></label></li>
                                        <?php } ?>
                            </ul>
                        </section>
                    </div><!-- end #tab-advance -->
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
