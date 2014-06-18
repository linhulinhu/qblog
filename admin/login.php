<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>管理员登录</title>
        <link href="css/admin_login.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="login"> 
            <SCRIPT language='javascript'>
                function Checklogin()//登录检查
                {
                    if (document.loginform.username.value=="")
                    {
                        alert("请填写登录名!");
                        document.loginform.username.focus();
                        return false;
                    }
                    if (document.loginform.userpass.value=="")
                    {
                        alert("密码不能为空!");
                        document.loginform.userpass.focus();
                        return false;
                    }
                    if (document.loginform.code.value=="")
                    {
                        alert("验证码不能为空!");
                        document.loginform.code.focus();
                        return false;
                    }
                }
            </SCRIPT>
            <form action="admin_login.php"   class="loginform"method="post" name="loginform" onsubmit="return Checklogin();">
                <div class="user">
                    <p>
                        <label >用户名*</label>
                        <input type="text" name="username"  size="22" tabindex="1" />
                    </p>
                </div>
                <div class="password">
                    <p>
                        <label >密码*</label>
                        <input type="password" name="userpass"  size="22" tabindex="2" />
                    </p>
                </div>
                <div class="code">
                    <div class="inputcode">
                        <p>
                            <label >验证码*</label>
                            <input type="text" name="code" tabindex="3" />
                        </p>
                    </div>
                    <div class="inputimg">
                        <p> <img id="imgcode" src="code.php" onclick="this.src='code.php?'+Math.random()" alt="看不清请点击刷新" /><a href="#" onclick="document.getElementById('code').src='code.php?'+Math.random()"></a> </p>
                    </div>
                </div>
                <div class="sub">
                    <p>
                        <input type="submit" name="submit"   tabindex="4" value="登录" />
                        <input type="reset" name="reset"  tabindex="5" value="重写" />
                    </p>
                </div>
            </form>
            <div class="return_index">
                <ul>
                    <li>
                        <a href="../index.php">返回首页</a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
