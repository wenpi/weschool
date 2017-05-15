<?php 
namespace myclass\src;
class repair{
    private $table_name;
    private $table;
    private $table_name_reply;
    private $table_reply;
    public $school_id;
    public $every_page = 20;
    
    public $reply_status= array(
        0=>'无效',
        1=>'已收到反馈',
        2=>'已处理好',
        3=>'无法修复'
    );

    public function __construct(){
        $this->table_name = "lianhu_repair";
        $this->table      = tablename($this->table_name); 
        $this->table_name_reply = "lianhu_repair_reply"; 
        $this->table_reply      = tablename($this->table_name_reply); 
        $this->school_id        =  getSchoolId();
    }
    //添加报修
    public function addRepair($arr){
        global $_W;
        $in['uniacid']          = $_W['uniacid'];
        $in['school_id']        = $this->school_id;
        $in['add_time']         = time();
        $in['status']           = 1;
        $in['teacher_id']       = $_SESSION['teacher_id'] ? $_SESSION['teacher_id'] :0;
        $in['student_id']       = $_SESSION['student_id'] ? $_SESSION['student_id'] :0;
        $in['repair_title']     = $arr['repair_title'];
        $in['repair_img']       = $arr['repair_img'];
        $in['repair_content']   = $arr['repair_content'];
        $in['department_id']    = $arr['department_id'];
        pdo_insert($this->table_name,$in);
        return pdo_insertid();
    }
    //获取报修列表
    public function getList($params,$page){
        global $_W;
        $start                = ($page-1)*$this->every_page;
        $start                = $start>0 ? $start:0;
        $params[':uniacid']   = $_W['uniacid'];
        $params[":school_id"] = $this->school_id;
        $where                = S("fun",'composeParamsToWhere',array($params,'repair'));
        $limit_sql            = $start.",".$this->every_page;
        $count                = pdo_fetchcolumn("select count(repair_id) num from ".$this->table." repair where ".$where,$params);
        $list                 = pdo_fetchall("select repair.*,depart.department_name from ".$this->table." repair 
                                left join ".tablename("lianhu_department")." depart on depart.department_id = repair.department_id
                                where ".$where." 
                                order by repair_id desc limit  ".$limit_sql,$params);
        return array('count'=>$count,'list'=>$list);
    }
    //更新报修
    public function updateRepair($repair_id,$up=false){
        $params[":repair_id"] = $repair_id;
        $where                = S("fun",'composeParamsToWhere',array($params));
        if($up){
            pdo_update($this->table_name,$up,array("repair_id"=>$repair_id) );
        }
        $result               = pdo_fetch("select repair.*,depart.department_name from ".$this->table." repair 
                                left join ".tablename("lianhu_department")." depart on depart.department_id = repair.department_id
                                where ".$where."
                                ",$params);
        return $result;
    }
    //获取某个报修的有效处理
    public function getRepairReply($repair_id){
        $params[":repair_id"] = $repair_id;
        $where                = S("fun",'composeParamsToWhere',array($params));     
        $where               .= " and status !=0 ";  
        $list                 = pdo_fetchall("select reply.*,admin.admin_name,depart.department_name from ".$this->table_reply." reply 
                                left join ".tablename("lianhu_db_admin")." admin on admin.admin_id = reply.repair_admin_id
                                left join ".tablename("lianhu_department")." depart on depart.department_id = reply.department_id
                                where ".$where."  order by reply_id desc",$params);
        return $list;
    }
    //新增报修的有效处理
    public function addRepairReply($arr){
        global $_GPC;
        $in['reply_time']           = time();
        $in['db_admin_id']          = $_GPC['_admin_id'] ? $_GPC['_admin_id'] :0;
        $in['repair_id']            = $arr['repair_id'];
        $in['reply_content']        = $arr['reply_content'];
        $in['reply_img']            = $arr['reply_img'];
        $in['department_id']        = $arr['department_id'];
        $in['repair_admin_id']      = $arr['repair_admin_id'];
        $in['status']               = $arr['status'];
        pdo_insert($this->table_name_reply,$in);
        return pdo_insertid();
    }
    //更新报修回复
    public function updateReply($reply_id,$up=false){
        $params[":reply_id"] = $reply_id;
        $where                = S("fun",'composeParamsToWhere',array($params));        
        if($up){
            pdo_update($this->table_name_reply,$up,array("repair_id"=>$repair_id) );
        }
        $result               = pdo_fetch("select reply.*,admin.admin_name,depart.department_name from ".$this->table_reply." reply 
                                left join ".tablename("lianhu_db_admin")." admin on admin.admin_id = reply.repair_admin_id
                                left join ".tablename("lianhu_department")." depart on depart.department_id = reply.department_id
                                where ".$where."  ",$params);
        return $result;
    }
    //删除回复
    public function deleteReply($reply_id){
        pdo_delete($this->table_name_reply,array("reply_id"=>$reply_id));
    }
    //删除报修
    public function deleteRepair($id){
        pdo_delete($this->table_name,array("repair_id"=>$id));
    }
    //报修回复处理统计
    public function countReply($params,$in_where=false){
        $where   = S("fun",'composeParamsToWhere',array($params));        
        $where  .= $in_where;
        $count   = pdo_fetchcolumn("select count(reply_id) num from ".$this->table_reply." where ".$where." ",$params);
        return $count;
    }
}