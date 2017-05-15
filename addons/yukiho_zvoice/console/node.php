<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/30
 * Time: 2:26
 */

ini_set('display_errors', '1');
error_reporting(E_ALL ^ E_NOTICE);

$exec = exec("node -v");
if(empty($exec)){
    message("请先安装node js",referer(),'error');
}

$exec = system("node index.js");
print_r($exec);