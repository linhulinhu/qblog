<?php
require_once 'header.php';
?>

        <div class="main">
            <div class="body container">
                <div class="colgroup">
                    <div class="typecho-page-title col-mb-12">
                        <h2>新增用户</h2>
                    </div>
                </div>
                <div class="colgroup typecho-page-main" role="form">
                    <div class="col-mb-12 col-tb-6 col-tb-offset-3">
                        <?php
                        require_once '../config.php';
                        ?>
                        <form action="admin_register.php" method="post" name="registerform" onsubmit="">
                            <ul class="typecho-option" id="typecho-option-item-name-0">
                                <li>
                                    <label class="typecho-label" for="name-0-1">
                                        用户名 *</label>
                                    <input id="username" name="username" type="text" class="text" onblur="startRequest(document.getElementById('username').value);" />
                                    <span id="ckuser"></span>
                                    <p class="description">
                                        此用户名将作为用户登录时所用的名称.<br />
                                        请不要与系统中现有的用户名重复.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-mail-1">
                                <li>
                                    <label class="typecho-label" for="mail-0-2">
                                        电子邮箱地址 *</label>
                                    <input id="mail-0-2" name="mail" type="text" class="text" />
                                    <p class="description">
                                        电子邮箱地址将作为此用户的主要联系方式.<br />
                                        请不要与系统中现有的电子邮箱地址重复.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-screenName-2">
                                <li>
                                    <label class="typecho-label" for="screenName-0-3">
                                        用户昵称</label>
                                    <input id="screenName-0-3" name="nikename" type="text" class="text" />
                                    <p class="description">
                                        用户昵称可以与用户名不同, 用于前台显示.<br />
                                        如果你将此项留空, 将默认使用用户名.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-password-3">
                                <li>
                                    <label class="typecho-label" for="password-0-4">
                                        用户密码 *</label>
                                    <input id="password-0-4" name="userpass" type="password" class="w-60" />
                                    <p class="description">
                                        为此用户分配一个密码.<br />
                                        建议使用特殊字符与字母的混编样式,以增加系统安全性.</p>
                                </li>
                            </ul>
                            <ul class="typecho-option" id="typecho-option-item-url-5">
                                <li>
                                    <label class="typecho-label" for="url-0-6">
                                        个人主页地址</label>
                                    <input id="url-0-6" name="url" type="text" class="text" />
                                    <p class="description">
                                        此用户的个人主页地址, 请用 <code>http://</code> 开头.</p>
                                </li>
                            </ul>

                            <ul class="typecho-option" id="typecho-option-item-do-7" style="display:none">
                                <li>
                                    <input name="submit" type="submit" value="" />
                                </li>
                            </ul>

                            <ul class="typecho-option typecho-option-submit" id="typecho-option-item--9">
                                <li>
                                    <button type="submit" class="primary">
                                        增加用户</button>
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