<?php
require_once 'header.php';
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
    <div class="typecho-page-title col-mb-12">
        <h2>用户管理<a href="admin_register_form.php">新增</a></h2>
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
    $user = new User();
    $user_list = $user->GetList(0);
    echo "<div class=\"user_list\">";
    foreach ($user_list as $element) {
        echo "<div class=\"user_list_li\">";
//    echo "<ul>";
        echo "<div class=\"username_left\">{$element['username']}</div>";
        echo "<div class=\"username_right\"><a href='admin_update_info.php?user_id={$element['uid']}'>修改</a></div>";
        //   echo "</ul>";
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
