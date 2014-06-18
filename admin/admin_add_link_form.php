<!doctype html>
<html>
<head>
	<title>The yyxblog</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
require_once '../config.php';
?>
    <form  id="moudle" action="admin_add_link.php" method="post" name="moudleform"  onsubmit="" >
        <div id="moudle-info">
            <p> 
                <label for="moudle">链接名称*</label>
                <input type="text" name="lname"  class="moudle_text" size="22" tabindex="1" /> 
            </p>
                        <p> 
                <label for="moudle">链接地址*</label>
                <input type="text" name="lurl"  class="moudle_text" size="22" tabindex="2" /> 
            </p>
           <p> 
                <label for="moudle">链接描述*</label>
                <input type="text" name="description"  class="moudle_text" size="22" tabindex="3" /> 
            </p>

        </div>

        <p>
            <input class="submit" name="submit" type="submit" id="submit" tabindex="4" value="添加" />
            <input class="reset" name="reset" type="reset" id="reset" tabindex="5" value="重写" />
        </p>
    </form>
	</body>
</html>