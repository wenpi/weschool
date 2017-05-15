<?php 
namespace myclass\src;
/*
  msg_id int(11) AUTO_INCREMENT,
  msg_title tinytext,
  msg_content text,
  status tinyint(1) default 1,
  addtime int(11),
  school_id int(11),
  uniacid int(11), 
  primary key(msg_id)
*/
class notice{
    public $school_id;
    public $table_notice;

    public function __construct(){
        $this->school_id    = getSchoolId();
        $this->table_notice = tablename('lianhu_msg');
    }
    //获取一个详情
    public function getNoticeInfo($id){
        $params[':msg_id'] = $id;
        if($this->school_id){
            $params[":school_id"] = $this->school_id;
        }
        $where  = S('fun','composeParamsToWhere',array($params));
        $result = pdo_fetch("select * from ".$this->table_notice." where  ".$where,$params);
        return $result;
    }
    //获取所有的公告列表
    public function getNoticeList($now_page=1){
        $limit = S('fun','decodePages',array($now_page));
        $sql   = " from ".$this->table_notice." where school_id=:school_id  order by msg_id desc";
        $params= array(":school_id"=>$this->school_id);
        $count = pdo_fetchcolumn("select count(msg_id) num ".$sql,$params); 
        $list  = pdo_fetchall("select * ".$sql." limit ".$limit,$params);
        $max_page = S('fun','decodePages',array($now_page,$count));
        return array("list"=>$list,"count"=>$count,'max_page'=>$max_page);
    }
    

}