<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class question
{
    public $table = 'yukiho_zvoice_question';

    public function __construct()
    {
        $this->install();
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where ="",$params = array(),$psize = 10){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $where .= " AND uniacid = :uniacid";
        $p = trim($_GPC['category_id']);
        if(!empty($p)){
            $where .= " AND category_id = :category_id";
            $params[':category_id'] = $p;
        }
        unset($p);
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
		//自动开启限时免费
		$setting = M('setting')->getSetting('system');
		if(!empty($setting['openFree']) && intval($setting['openFree'])>0){
			foreach ($result['list'] as &$li) {
				if((time()-$item['create_time'])<=(intval($setting['openFree'])*3600)){
					$li['isfree'] = '1';
				}
			}
		}
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }
	


    public function getFeedList($page,$params,$psize = 10,$set){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a"
			." LEFT JOIN ".tablename('yukiho_zvoice_follow')." b"
			." on a.".$set['from']." = b.".$set['to']
			." where a.`status`=2 and a.uniacid=:uniacid "
			." and b.".$set['follow']." = '".$_W['openid']."'"
			." ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
		$result = array();
        $result['list'] = pdo_fetchall($sql,$params);
		//自动开启限时免费
		$setting = M('setting')->getSetting('system');
		if(!empty($setting['openFree']) && intval($setting['openFree'])>0){
			foreach ($result['list'] as &$li) {
				if((time()-$item['create_time'])<=(intval($setting['openFree'])*3600)){
					$li['isfree'] = '1';
				}
			}
		}
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }

    public function getRandomList($id){
        global $_W,$_GPC;
        $where .= " AND uniacid = :uniacid";
        if(!empty($p)){
            $where .= " AND category_id = :category_id";
            $params[':category_id'] = trim($_GPC['category_id']);
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE id<>".$id." and status='2' ORDER BY RAND() LIMIT 5";
		
		//"SELECT * FROM ".tablename($this->table)." AS t1 JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM ".tablename($this->table).")) AS id) AS t2 "
		//	."WHERE t1.id >= t2.id ".$where." ORDER BY t1.id ASC LIMIT 5";
		//SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
		return pdo_fetchall($sql);
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
    public function getInfoSpec($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
		//自动开启限时免费
		$setting = M('setting')->getSetting('system');
		if(!empty($setting['openFree']) && intval($setting['openFree'])>0 && (time()-$item['create_time'])<=(intval($setting['openFree'])*3600)){
			$item['isfree'] = '66';
		}
        return $item;
    }
    public function getall($params = array()){
        global $_W,$_GPC;
		
        $params['uniacid'] = $_W['uniacid'];
        $where = " ";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC";
        return pdo_fetchall($sql,$ss);
    }
    public function getrand($category_id){
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE category_id =:category_id ORDER BY rand() limit 1";
        $params = array('category_id'=>$category_id);
        $item = pdo_fetch($sql,$params);
        return $item;
    }
    public function totalcredit(){
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
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
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
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <=:end_time {$where}";
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
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <= :end_time {$where}";
    
        $return['week']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <= :end_time {$where}";
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
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND create_time >=:star_time AND create_time <=:end_time {$where}";
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
    public function getFreeTotal(){
        global $_W;
        $where = " AND isfree = :isfree AND free_end_time > :free_end_time AND status = :status";
        $params = array(':isfree'=>1,':free_end_time'=>time(),':status'=>2);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $params[':uniacid'] = $_W['uniacid'];
        $count = pdo_fetchcolumn($sql,$params);
        if(empty($count)){
            $count = 0;
        }
        return $count;
    }
    public function getTotal($openid){
        global $_W;
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE openid = :openid AND uniacid = :uniacid ";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        $count = pdo_fetchcolumn($sql,$params);
        return $count;
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
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'category_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `category_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'credit')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `credit` decimal(10,2) DEFAULT '0.00'");
        }
        if(!pdo_fieldexists($this->table,'listen_num')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `listen_num` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'good_num')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `good_num` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'open')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `open` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'voice_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `voice_id` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'to_openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `to_openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'status')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `status` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'isfree')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `isfree` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'free_start_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `free_start_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'free_end_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `free_end_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'timelong')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `timelong` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'hash')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `hash` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'key')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `key` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'isweixin')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `isweixin` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'images')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `images` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'sn')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `sn` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'src')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `src` varchar(320) DEFAULT ''");
        }
    }
}