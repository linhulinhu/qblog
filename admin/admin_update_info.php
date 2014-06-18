<?php
require_once 'header.php';
?>

<div class="main">
    <div class="body container">
        <div class="colgroup">
            <div class="typecho-page-title col-mb-12">
                <h2>编辑用户</h2>
            </div>
        </div>
        <div class="colgroup typecho-page-main" role="form">
            <div class="col-mb-12 col-tb-6 col-tb-offset-3">
                <?php
                require_once '../config.php';
//require_once ROOT_PATH . '/includes/header.php';
                ?>
                <?php
                $user = new User();
                if (!isset($_POST['userpass']) || !isset($_POST['mail']) || !isset($_POST['old_pass'])) {
                    $u = $user->GetDetails($_GET['user_id']);
                    // print_r($u);
                    ?>
                    <form action="admin_update_info.php" method="post" enctype="application/x-www-form-urlencoded">
                        <ul class="typecho-option" id="typecho-option-item-name-0">
                            <li>
                                <label class="typecho-label" for="name-0-1">
                                    用户名 *</label>
                                <input id="name-0-1" name="username" type="text" class="text" value="<?php echo $u['username'] ?>" disabled="disabled" />
                                <p class="description">
                                    此用户名将作为用户登录时所用的名称.<br />
                                    请不要与系统中现有的用户名重复.</p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-mail-1">
                            <li>
                                <label class="typecho-label" for="mail-0-2">
                                    电子邮箱地址 *</label>
                                <input id="mail-0-2" name="mail" type="text" class="text" value="<?php echo $u['mail'] ?>" />
                                <p class="description">
                                    电子邮箱地址将作为此用户的主要联系方式.<br />
                                    请不要与系统中现有的电子邮箱地址重复.</p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-screenName-2">
                            <li>
                                <label class="typecho-label" for="screenName-0-3">
                                    用户昵称</label>
                                <input id="screenName-0-3" name="nikename" type="text" class="text" value="<?php echo $u['nikename'] ?>" />
                                <p class="description">
                                    用户昵称可以与用户名不同, 用于前台显示.<br />
                                    如果你将此项留空, 将默认使用用户名.</p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-password-3">
                            <li>
                                <label class="typecho-label" for="password-0-4">
                                    原密码</label>
                                <input id="password-0-4" name="old_pass" type="password" class="w-60" />
                                <p class="description">
                                    输入原密码来修改个人信息.<br />
                                </p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-confirm-4">
                            <li>
                                <label class="typecho-label" for="confirm-0-5">
                                    新密码</label>
                                <input id="confirm-0-5" name="userpass" type="password" class="w-60" />
                                <p class="description">
                                    建议使用特殊字符与字母的混编样式,以增加系统安全性.</p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-url-5">
                            <li>
                                <label class="typecho-label" for="url-0-6">
                                    个人主页地址</label>
                                <input id="url-0-6" name="url" type="text" class="text" value="<?php echo $u['url'] ?>" />
                                <p class="description">
                                    此用户的个人主页地址, 请用 <code>http://</code> 开头.</p>
                            </li>
                        </ul>
                        <ul class="typecho-option" id="typecho-option-item-do-7" style="display:none">
                            <li>
                                <input name="confirm" type="submit" value="" />
                            </li>
                        </ul>
                        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
                        <ul class="typecho-option typecho-option-submit" id="typecho-option-item--9">
                            <li>
                                <button type="submit" class="primary">
                                    编辑用户</button>
                            </li>
                        </ul>
                    </form>
                    <?php
                } else {
                    $user->uid = $_POST['user_id'];
                    $user->nikename = $_POST['nikename'];
                    $user->old_pass = md5($_POST['old_pass']);
                    $user->new_pass = md5($_POST['userpass']);
                    $user->new_pass_c = $_POST['userpass']; //获取新密码判断是否为空
                    $user->mail = $_POST['mail'];
                    $user->url = $_POST['url'];
                    //var_dump($user);
                    $user->chang_pass();
                    echo "<script language='javascript' type='text/javascript'>";
                    echo "alert('修改成功！');";
                    echo "window.location.href='admin_show_user_list.php'";
                    echo "</script>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
