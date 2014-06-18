<?php

// Set default timezone in PHP 5.
if (function_exists('date_default_timezone_set'))
    date_default_timezone_set('UTC');


/* * 目录的绝对路径。 */
//$x=str_replace('\\', '/', __FILE__);
if (!defined('ROOT_PATH'))
    define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)));

//echo ROOT_PATH;
// 自动加载类
function __autoload($className) {
    // 类所在路径为：/lib/
    // 类文件名定义规则:类名.class.php
    require_once ROOT_PATH . '/var/' . $className . '.class.php';
}

?>
