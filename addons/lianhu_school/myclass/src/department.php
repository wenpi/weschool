<?php 
namespace myclass\src;

class department{
    private $table_name;
    private $table;
    private $table_name_admin;
    private $table_admin;
    public  $school_id;
    public  $level=array(
        1=>'成员',
        2=>'副主管',
        3=>'主管【接收通知消息】'
    );


    public function __construct(){
        $this->table_name       = 'lianhu_department';
        $this->table_name_admin = 'lianhu_admindepart';
        $this->table            = tablename($this->table_name);
        $this->table_admin      = tablename($this->table_name_admin);
        $this->school_id        = getSchoolId();
    }
    //删除部门
    public function delete($de_id){
        $where["department_id"] = $de_id;
        $where["school_id"]     = $this->school_id ;
        pdo_delete($this->table_name,$where);
        pdo_delete($this->table_name_admin,$where);
    }
    //新建部门
    public function add($arr){
        global $_W;
        $in['uniacid']  = $_W['uniacid'];
        $in['school_id']= $this->school_id;
        $in['add_time'] = time();
        $in['department_name'] = $arr['department_name'];
        $in['repair_fix']      = $arr['repair_fix'] ? $arr['repair_fix']:0;
        pdo_insert($this->table_name,$in);
        return pdo_insertid();
    }
    //编辑部门
    public function edit($id,$up=false){
        if($up){
            pdo_update($this->table_name,$up,array("department_id"=>$id) );
        }
        $result = pdo_fetch("select * from ".$this->table." where department_id=:id ",array(":id"=>$id));
        return $result;
    }
    //获取部门
    public function getDeList($params=false){
        $params[":school_id"] = $this->school_id;
        $where                = S("fun","composeParamsToWhere",array($params));
        $list                 = pdo_fetchall("select * from ".$this->table." where ".$where,$params);
        return $list;
    }
    //删除部门人员
    public function deleteAd($deadmin_id){
        $where["admindepart_id"] = $deadmin_id;
        $where["school_id"]      = $this->school_id ;
        pdo_delete($this->table_name_admin,$where);       
    }
    //给部门添加人员
    public function addAdminDe($arr){
        global $_W;
        $in['uniacid']  = $_W['uniacid'];
        $in['school_id']= $this->school_id;
        $in['add_time'] = time();
        $in['department_id'] = $arr['department_id'];
        $in['db_admin_id']   = $arr['db_admin_id'];
        $in['level']         = $arr['level'];
        pdo_insert($this->table_name_admin,$in);
    }
    //调整部门人员
    public function editAdminDe($id,$up=false){
        if($up){
            pdo_update($this->table_name_admin,$up,array("admindepart_id"=>$id));
        }
        $result = pdo_fetch("select * from ".$this->table_admin." where admindepart_id=:id ",array(":id"=>$id));
        return $result;
    }
    //获取部门人员列表
    public function getDepartmentAdminList($de_id,$params=false){
        $params[":department_id"] = $de_id;
        $where                    = S("fun","composeParamsToWhere",array($params));
        $list = pdo_fetchall("select de.*,de.add_time de_add_time ,admin.* from  ".$this->table_admin." de left join 
                              ".tablename("lianhu_db_admin")." admin on de.db_admin_id = admin.admin_id 
                            where ".$where,$params);
        return $list;
    }
    
    //部门性质
    public function getDepartProperty($de_id){
        $result = $this->edit($de_id);
        if($result['repair_fix']){
            $str = '负责报修';
        }
        return $str;
    }
    //获取部门的主管成员
    public function getDepartMainAdmin($de_id){
        $params[":level"] = 3;
        $list = $this->getDepartmentAdminList($de_id,$params);
        if($list){
            $admin_name_arr = S("fun","zuHeArr",array($list,'admin_name'));
            $admin_name_str = implode(',',$admin_name_arr);
        }
        return array("list"=>$list,'admin_name_str'=>$admin_name_str);
    }

}