<?php 
namespace myclass\src;

class neiMsg extends common{
    public $msg_id      = 'msg_id';
    public $msg_title   = 'msg_title';
    public $msg_content = 'msg_content';
    public $status      = 'status';
    public $img         = 'img';
    public $db_admin_id = 'db_admin_id';
    public $images      = 'images';
    public function __construct(){
        $this->setTable('lianhu_msg');
        $this->setGlobal();                
    }
    public function getAll($status=1,$page=1){
        $params[":status"] = 1;
        $result            = $this->getList($params,false,$page);
        $list              = $result['list'];
        return $list;
    }
        



}