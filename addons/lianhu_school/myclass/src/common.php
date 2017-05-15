<?php 
namespace myclass\src;

class common{
    public    $table_name;
    public    $table;
    public    $school_id;
    public    $uniacid;
    public    $each_page = 20;//每页数
    public    $field_str = '';//获取的字段
    public    $group_by  = '';

    public function _set($name,$value){
        $this->$name = $value;
    }
    //赋值全局量
    public function setGlobal(){
        global $_W;
        $this->school_id = getSchoolId();
        $this->uniacid   = $_W['uniacid'];
    }
    //设置table  
    public function setTable($table_name){
        $this->table_name = $table_name;
        $this->table      = tablename($table_name);
    }
    //check field
    public function checkAndAdd($field,$add_sql){
        $re  = pdo_fieldexists($this->table_name,$field);
        if(!$re){
            $run_sql = " alter table ".$this->table." add  ".$add_sql;
            pdo_run($run_sql);
        }
    }
    //add
    public function add($arr){
        $arr['uniacid']     = $this->uniacid;
        $arr['school_id']   = $this->school_id;
        if(pdo_fieldexists($this->table_name,'add_time')){
            $arr['add_time']   = time();
        }
        if(pdo_fieldexists($this->table_name,'addtime')){
            $arr['addtime']    = time();
        }
        pdo_insert($this->table_name,$arr);
        return pdo_insertid();
    }
    //edit
    public function edit($where,$up=false){
        if($up){
            pdo_update($this->table_name,$up,$where);
        }
        $g = 0;
        foreach ($where as $key => $value) {
            $params[":".$key] = $value;
            if(is_array($value)){
                $in_params[":".$key] = $value[1];
            }else{
                $in_params[":".$key] = $value;
            }
        }
        if($this->field_str){
            $field_str = $this->field_str;
        }else{
            $field_str = '*';
        }
        if(pdo_fieldexists($this->table_name,'add_time')){
            $field = 'add_time';
        }elseif(pdo_fieldexists($this->table_name,'addtime')){
            $field = 'addtime';
        }elseif(pdo_fieldexists($this->table_name,'uniacid')){
            $field = 'uniacid';
        }
        $where_str = S("fun",'composeParamsToWhere',array($params));
        $result    = pdo_fetch("select ".$field_str." from ".$this->table." where ".$where_str ." order by ".$field." desc",$in_params);
        return $result;
    }
    //delete
    public function delete($where,$force=false){
        //非强制则需要加学校id来删除
        if(!$force){
            $where['school_id'] = $this->school_id;
        }
        if($where){
            return   pdo_delete($this->table_name,$where);
        }
    }
    //statusDelete
    public function statusDelete($where){
        $up["status"] = -1;
        pdo_update($this->table_name,$up,$where);
    }
    //获取列表 
    public function getList($params,$in_where=false,$pages=1,$docount=false){
        if($this->school_id){
            $params[":school_id"]   = $this->school_id;
        }
        $where                  = S("fun","composeParamsToWhere",array($params));
        //判断array
        foreach ($params as $key => $value) {
            if(is_array($value)){
                $params[$key] = $value[1];
            }
        }
        if($in_where){
            $where              = $where." and ".$in_where;
        }
        $start                  = $pages>0 ? $pages : 1;
        $limit_sql              = ($start-1)*$this->each_page.','.$this->each_page;
        if(pdo_fieldexists($this->table_name,'add_time')){
            $field = 'add_time';
        }elseif(pdo_fieldexists($this->table_name,'addtime')){
            $field = 'addtime';
        }elseif(pdo_fieldexists($this->table_name,'uniacid')){
            $field = 'uniacid';
        }
        $field_str = '*';
        $count                  = pdo_fetchcolumn("select count(".$field.") num from ".$this->table." where ".$where."  ",$params);
        if(!$docount){
            $list               = pdo_fetchall("select ".$field_str."  from ".$this->table." where ".$where." order by ".$field." desc limit ".$limit_sql,$params);
        }
        return array('count'=>$count,'list'=>$list);
    }
    //sql 获取列表
    public function getSqlList($params,$in_where,$pages=1){
        $where                  = $in_where;
        $start                  = $pages>0 ? $pages : 1;
        $limit_sql              = ($start-1)*$this->each_page.','.$this->each_page;
        if(pdo_fieldexists($this->table_name,'add_time')){
            $field = 'add_time';
        }elseif(pdo_fieldexists($this->table_name,'addtime')){
            $field = 'addtime';
        }elseif(pdo_fieldexists($this->table_name,'uniacid')){
            $field = 'uniacid';
        }
        if($this->group_by){
            $group_by = " group by ".$this->group_by;
        }else{
            $group_by = '';
        }
        $count                  = pdo_fetchcolumn("select count(".$field.") num from ".$this->table." where ".$where."  ",$params);
        $list                   = pdo_fetchall("select *  from ".$this->table." where ".$where."  ".$group_by." order by ".$field." desc limit ".$limit_sql,$params);
        return array('count'=>$count,'list'=>$list);      
    }


}