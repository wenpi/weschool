<?php 
    // 独立入口
    ini_set("display_errors", 1);

    define('IN_MOBILE', true);
    define('IN_ALONE', 'yes');
    define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT'].'/../../');

    require ROOT_PATH.'framework/bootstrap.inc.php';
    load()->app('common');
    load()->app('template');
    load()->model('app');
    require IA_ROOT . '/app/common/bootstrap.app.inc.php';

    define('MODULE_URL', $_W['siteroot']);
    require("site.php");
    $class_site = new Lianhu_schoolModuleSite();
    $class_site->__define = IA_ROOT.'/addons/lianhu_school/site.php';
    $class_site->doMobileAdminlogin();  
    