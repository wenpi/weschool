<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class task
{
    public $table = 'yukiho_zvoice_task';

    public function __construct()
    {
        $this->install();
    }

    public function getall($params = array()){
        global $_W,$_GPC;
        $params['uniacid'] = $_W['uniacid'];
        $list = pdo_getall($this->table,$params);
        return $list;
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where ="",$params = array()){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $where .= " AND uniacid = :uniacid";
        
        $p = trim($_GPC['title']);
        if(!empty($p)){
            $where .= " AND title like '%{$p}%'";
        }
        unset($p);
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }
    public function totalid(){
        global $_W,$_GPC;
        $return = array();
        $return['all'] = array();
        $params = array(':uniacid'=>$_W['uniacid']);
        $where = "";
        $p = trim($_GPC['start_time']);
        if(!empty($p)){
            $where .= " AND create_time >= :start_time";
            $params[':start_time'] = strtotime($p);
        }
        unset($p);
        $p = trim($_GPC['end_time']);
        if(!empty($p)){
            $where .= " AND create_time <= :end_time";
            $params[':end_time'] = strtotime($p);
        }
        unset($p);
        $sql = "SELECT SUM(id) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $return['all']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $return['all']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['all']['fee'])){
            $return['all']['fee'] = 0.00;
        }
        if(empty($return['all']['sum'])){
            $return['all']['sum'] = 0;
        }
        $start_time = strtotime(date('Y-m-d',time()));
        $end_time = time();
    
        $return['day'] = array();
        $sql = "SELECT SUM(id) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <=:end_time {$where}";
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
    
        $return['day']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <=:end_time {$where}";
        $return['day']['sum'] = pdo_fetchcolumn($sql,$params);
    
        if(empty($return['day']['fee'])){
            $return['day']['fee'] = 0.00;
        }
        if(empty($return['day']['sum'])){
            $return['day']['sum'] = 0;
        }
        $start_time = strtotime(date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y"))));
        $end_time = strtotime(date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))));
        $return['week'] = array();
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
        $sql = "SELECT SUM(id) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` < :end_time {$where}";
    
        $return['week']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >:star_time AND `create_time` < :end_time {$where}";
        $return['week']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['week']['fee'])){
            $return['week']['fee'] = 0.00;
        }
        if(empty($return['week']['sum'])){
            $return['week']['sum'] = 0;
        }
        $start_time = strtotime(date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y"))));
        $end_time = strtotime(date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y"))));
        $return['month'] = array();
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
        $sql = "SELECT SUM(id) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND create_time >=:star_time AND create_time <=:end_time {$where}";
        $return['month']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND create_time >=:star_time AND create_time <=:end_time {$where}";
        $return['month']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['month']['fee'])){
            $return['month']['fee'] = 0.00;
        }
        if(empty($return['month']['sum'])){
            $return['month']['sum'] = 0;
        }
        return $return;
    }
    public function update($data){
        global $_W;
        $data['uniacid'] = $_W['uniacid'];
        if(empty($data['id'])){
            pdo_insert($this->table,$data);
            $data['id'] = pdo_insertid();
        }else{
            //更新
            pdo_update($this->table,$data,array('uniacid'=>$_W['uniacid'],'id'=>$data['id']));
        }
        return $data;
    }
    public function getInfo($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
        return $item;
    }
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'create_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `create_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'title')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(100) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'images')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `images` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'open')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `open` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'class_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `class_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'answer_num')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `answer_num` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'look_num')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `look_num` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'listen_num')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `listen_num` int(11) DEFAULT '0'");
        }
    }
}