<?php 
namespace myclass\src;

class uniacidCommon extends common{
    public $uniacid  ;
    public $school_id;
    public $table;
    public $table_name;

    //赋值全局量
    public function setGlobal(){
        global $_W;
        $this->school_id = getSchoolId();
        $this->uniacid   = $_W['uniacid'];
    }
    //设置table  
    public function setTable($table_name){
        $this->table_name = $table_name.'_'.$this->uniacid;
        $this->table      = tablename($this->table_name);
    }
    
}