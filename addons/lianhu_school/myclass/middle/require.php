<?php 
    if(!file_exists('config.php')){
        return false;
    }
    require('config.php');
    //初始化中间库
    if(USE_MIDDLE==1){
        $Middle_db_re = MT('db','getInstance',array());
    }

