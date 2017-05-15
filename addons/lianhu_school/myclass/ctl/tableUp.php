<?php 
namespace myclass\ctl;

class tableUp{

    //优化表
    public function optimizeTable(){
        $tables = array(
            "lianhu_cron",
        );
        foreach ($tables as $key => $value) {
            pdo_run(" optimize table ".tablename($value));
        }
    }
    //回收innodb表垃圾
    public function innodbUp(){
         $tables = array(
            "lianhu_msg_queue",
        );
        foreach ($tables as $key => $value) {
            pdo_run(" alter  table ".tablename($value).' engine=innodb ');
        }       
    }
    //
    public function doAction(){
        $now_time = date("His",time());
        if($now_time > '235945' ){
            $this->optimizeTable();
        }elseif($now_time < '000015'){
            $this->innodbUp();
        }
    }


}