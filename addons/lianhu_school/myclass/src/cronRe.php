<?php 
namespace myclass\src;

class cronRe{
    public $re_id;
    public $record_id;
    public $teacher_id;
    public $student_id;
    public $db_admin_id;
    public $add_time;

    public $table;
    public $table_name;
    public $ge_time = 10800;

    public function __construct(){
        $this->table_name = 'lianhu_cron_re';
        $this->table      = tablename($this->table_name);
    }
    public function add($arr){
        $arr['add_time'] = time();
        pdo_insert($this->table_name,$arr);
        return pdo_insertid();
    }
    public function edit($where){
        foreach ($where as $key => $value) {
            $params[":".$key] = $value;
            if(is_array($value)){
                $in_params[":".$key] = $value[1];
            }else{
                $in_params[":".$key] = $value;
            }
        }
        $where_str = S("fun",'composeParamsToWhere',array($params));
        $result    = pdo_fetch("select * from ".$this->table." where ".$where_str ." order by add_time desc",$in_params);
        return $result;
    }
    //找到了不用复发
    public function findTea($record_id,$teacher_id){
        $params["record_id"]    = $record_id;
        $params["teacher_id"]   = $teacher_id;
        $params["add_time"]     = array(">",time()-$this->ge_time);
        $result = $this->edit($params);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function findStu($record_id,$student_id){
        $params["record_id"]    = $record_id;
        $params["student_id"]   = $student_id;
        $params["add_time"]     = array(">",time()-$this->ge_time);
        $result = $this->edit($params);
        if($result){
            return true;
        }else{
            return false;
        }
    }   

}