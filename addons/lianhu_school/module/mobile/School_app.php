<?php 
#界面调试
$title = $_GPC['title'];
$page  = $_GPC['page'];
if(!$page) 
    $page = 'index';
include $this->template("school/".$page);
exit();