<?php

// 定义整个网站的配置项

// 定义管理员email
define('ADMIN_EMAIL', 'admin@ccniit.org'); 

// 定义数据库访问配置项

/**  数据库的名称 */
define('DB_NAME', 'yyxblog');

/** MySQL 数据库用户名 */
define('DB_USER', 'root');

/** MySQL 数据库密码 */
define('DB_PASSWORD', '123456');

/** MySQL 主机 */
define('DB_HOST', '127.0.0.1');

/** 创建数据表时默认的文字编码 */
//define('DB_CHARSET', 'utf8');

/** 设置变量和包含文件。 */
require_once('settings.php');
?>
