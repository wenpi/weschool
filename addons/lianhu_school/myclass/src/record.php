<?php 
namespace myclass\src;

class record{
    public $table ;
    public $school_id;
    
    public function __construct(){
        $this->table = tablename('lianhu_jilv_class');
        $this->school_id =  getSchoolId();
    }
    //获取学生记录分类
    public function getRecordClass($all=false){
        $school_id = $this->school_id;
        if($all){
            $where = " ( uniacid=0 and school_id=0 ) or school_id = ".$school_id." ";
        }else{
            $where = "class_status=1  and ( (uniacid=0 and school_id=0) or school_id = ".$school_id.")";
        }
		$class_list = pdo_fetchall("select * from ".$this->table." where ".$where." order by school_id desc ");	
        return $class_list;
    }
    //编辑
    public function edit($class_id,$up=false){
        if($up){
            pdo_update('lianhu_jilv_class',$up,array("class_id"=>$class_id));
        }
        $result = pdo_fetch("select * from ".$this->table." where class_id =:cid ",array(":cid"=>$class_id));
        return $result;
    }
    
}