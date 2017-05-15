<?php 
namespace myclass\middle;

class common{
    public $middle_db;
    public $class_name;

    public function __db($class_name){
        global $Middle_db_re;
        $this->middle_db  = $middle_db;
        $this->class_name = $class_name;
    }
    //添加资料
    public function add($in){
        $in['add_time'] = time();
        $insert_sql     = MT('fun','composeInsert',array($in));
        $insert_values  = MT("fun",'composeValues',array($in));
        $params         = MT("fun",'composeParams',array($in));
        $sql            = " insert into ".$this->class_name." (".$insert_sql.") values (".$insert_values.") ";
        $id             = $this->middle_db->insert($sql,$params);
        return $id;
    }
    //更新资料
    public function update($where,$up){
        $update_sql     = MT("fun","composeUpdate",array($up));
        $params         = MT("fun",'composeParams',array($up));
        $where_sql      = MT("fun",'composeWhere',array($where));
        foreach ($where as $key => $value) {
            if(is_array($value)){
                $params[] = $value[1];
            }else{
                $params[] = $value;
            }
        }
        $sql            = " update ".$this->class_name." set ".$update_sql." where ".$where_sql." ";
        $this->middle_db->query($sql,$params);
    }
    //删除资料
    public function delete($where){
        $where_sql      = MT("fun",'composeWhere',array($where));
        $params         = MT("fun",'composeParams',array($where));
        $sql            = " delete from ".$this->class_name." where ".$where_sql." ";
        $this->middle_db->query($sql,$params);
    }
    //查找资料
    public function find($where){
        $where_sql      = MT("fun",'composeWhere',array($where));
        $params         = MT("fun",'composeParams',array($where));
        $sql            = "select * from ".$this->class_name." where ".$where_sql." ";
        return $this->middle_db->getOne($sql,$params);
    }


}