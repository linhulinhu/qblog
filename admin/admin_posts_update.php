<?php
require_once 'header.php';
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
            <div class="typecho-page-title col-mb-12">
                <h2>修改文章</h2>
            </div>
        </div>
        <div class="colgroup typecho-page-main typecho-post-area" role="form">
            <?php require_once '../config.php'; ?>
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
            <?php
            /**
             * 更新
             */
            $posts = new Post();
            if (!isset($_POST['title']) || !isset($_POST['content']) || isset($_POST['submit'])) {
                $t = $posts->GetDetails($_GET['id']);
                ?>
                <form action="" method="post" name="write_post">
                    <div class="col-mb-12 col-tb-9" role="main">

                        <p class="title">
                            <label for="title" class="sr-only">标题</label>
                            <input type="text" id="title" name="title" autocomplete="off" value="<?php echo $t['title'] ?>" placeholder="标题" class="w-100 text title" />
                        </p>
                        <p class="title">
                            <label for="title" class="sr-only">别名*</label>
                            <input type="text" id="title" name="slug" autocomplete="off" value="<?php echo $t['slug'] ?>" placeholder="别名" class="w-100 text title" />
                        </p>

                        <label for="text" class="sr-only">文章内容</label>
                        <textarea style="height: 310px;width: 98%" autocomplete="off" id="text" name="content" class="w-100 mono"><?php echo $t['content'] ?></textarea>
                        </p>
                        <input type="hidden" name="titleid" value="<?php echo $t['pid'] ?>">
                        <p class="submit clearfix">
                            <span class="right">
                                <button type="submit" name="confirm" value="save" id="btn-save">保存草稿</button>
                                <button type="submit" name="confirm" value="publish" class="primary" id="btn-submit">发布文章</button>
                            </span>
                        </p>

                    </div>

                    <div id="edit-secondary" class="col-mb-12 col-tb-3" role="complementary">



                        <div id="tab-advance" class="tab-content">
                            <?php
                            $id = $_GET['id'];
                            $_SESSION['pid'] = $_GET['pid'];
                            $list = $posts->GetDetails($id);
                            $catname = $posts->ShowPostIdCat($id, "category");
                            $tagname = $posts->ShowPostIdCat($id, "tag");
                            ?>
                            <section class="typecho-post-option category-option">
                                <label class="label">分类*</label>
                                <ul>
                                    <?php
                                    foreach ($catname as $row) {
                                        ?>
                                        <li><input type="checkbox" id="cat" name="catid[]" checked="checked" value="<?php echo $row[mid]; ?>"/><label><?php echo $row[name]; ?></label></li>
                                    <?php } ?>
                                </ul>
                            </section>
                            <section class="typecho-post-option category-option">
                                <label class="label">标签*</label>
                                <ul>
                                    <?php
                                    foreach ($tagname as $row) {
                                        ?>
                                        <li><input type="checkbox" id="cat" name="tagid[]" checked="checked" value="<?php echo $row[mid]; ?>"/><label><?php echo $row[name]; ?></label></li>
                                    <?php } ?>
                                </ul>
                            </section>
                        </div><!-- end #tab-advance -->
                    </div>
                </form>
                <?php
            } else { //处理表单提交的数据
                $posts->pid = $_POST['titleid'];
                $posts->title = $_POST['title'];
                $posts->slug = $_POST['slug'];
                $posts->status = "publish";
                $posts->content = $_POST['content'];
                $posts->update_posts($_POST['pid']);
                // print_r($posts);
                ?>
                <script type="text/javascript">
                    showNotification({
                        message: "修改日志成功！！！",
                        type: "success",
                        autoClose: true,
                        duration: 1
                    });
                </script>
                <a id="jump_url" href="admin_show_posts_list.php"></a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var timer = null;
    function change_time() {
        var left_time_span = document.getElementById('time');
        var left_time = 1;
        if (left_time_span) {
            left_time = left_time_span.innerHTML;
        }

        if (left_time == '1') {
            var url = document.getElementById('jump_url').href;
            clearInterval(timer);
            window.location.href = url;
        } else {
            left_time_span.innerHTML = left_time - 1;
        }
    }
    timer = setInterval(change_time, 1000);
</script>
<?php
require_once 'footer.php';
?>
