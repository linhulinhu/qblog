<?php
session_start();
require_once 'page_check.php';
require_once '../config.php';
$posts = new Post();
$posts->title = $posts->post_check($_POST['title']);
$posts->slug = $posts->post_check($_POST['slug']);
$posts->status = "publish";
$posts->content = $posts->post_check($_POST['content']);
$posts->authorid=$_SESSION['userid'];
//日志ID存为数组
$postid = $posts->add_posts();
if ($postid) {
    ?>
    <script type="text/javascript">
        showNotification({
            message: "发布日志成功！！！",
            type: "success",
            autoClose: true,
            duration: 1
        });
    </script>
    <a id="jump_url" href="admin_show_posts_list.php"></a>
    <?php
} else {
    ?>
    <script type="text/javascript">
        showNotification({
            message: "发布日志失败！！！",
            type: "error",
            autoClose: true,
            duration: 1
        });
    </script>
    <?php
}
?>
<?php
//获取选中的分类
$cat = $_POST['catid'];
//获取选中的标签
$tag = $_POST['tagid'];
//foreach ($cat as $key => $value) {
//   $arr[][$postid['0']]=$value;
//}
//echo "<pre>";
//print_r($arr);
//echo "</pre>";
$rs = new Rs();
if(is_array($cat))   
  {   
foreach ($cat as $key => $value) {
    $rs->pid = $postid;
    $rs->mid = $value;
    $rs->add_rs();
}
}
//
if(is_array($tag))   
  { 
foreach ($tag as $key => $value) {
    $rs->pid = $postid;
    $rs->mid = $value;
    $rs->add_rs();
}
}
?>
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