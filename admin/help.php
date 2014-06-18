<?php 
require_once '../config.php';
require_once ROOT_PATH.'/includes/header.php';
?>
<div id="tabs">
<div class="container_right">
    <div class="help">
        <strong>===========后台管理说明============</strong>
        <p>请在进行管理操作前，认真阅读以下说明：<br />
            <br />
            1.可以修改管理员登录密码和邮箱，但必须提供原来的正确密码，用户一旦注册后不允许修改，为了安全用户名用户密码不要过于简单;<br />
            <br />
            2.在所有操作完成后，请务必点击&quot;安全退出&quot;后，再关闭浏览器;<br />
            <br />
            3.点击&quot;新闻管理列表&quot;,可以对新闻进行<strong>浏览、修改、删除、发布</strong>等管理操作;<br />
            <br />
            4.点击进入新闻中心可以新添加一条新闻，添加新闻时最好控制好宽度以免发布会出现错位，调整好再发布;<br />
            <br />
            5.【注意】本系统提供类似word编辑排版功能的录入框，不推荐在word中排版好了再拷贝进来发布，<br />
            <br />
            这样容易导致页面混乱;建议在记事本准备好要发布的新闻内容，然后拷贝进来进行简单的排版后发布。<br />
            <br />
            6.【提示】鼠标移动到&rdquo;新闻编辑器&ldquo;的下边框，鼠标点击上下拖动可以改变高度，宽度最好不要改变，以免出现格式混乱；<br />
            <br />
        </p>
    </div>
</div>
</div>
<!-- 	内容结束-->
<?php require_once ROOT_PATH.'/includes/footer.php'; ?>