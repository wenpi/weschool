<?php

class member
{
    public $table = 'yukiho_zvoice_member';

    public function __construct()
    {
        $this->install();
    }

    public function getall(){
        global $_W;
        $list = pdo_getall($this->table,array('uniacid'=>$_W['uniacid']));
        return $list;
    }
	
    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where="",$params,$psize=10,$orderbyStr='create_time'){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $nickname = trim($_GPC['nickname']);
        if(!empty($nickname)){
            $where .= " AND nickname like '%{$nickname}%'";
        }
        $openid = trim($_GPC['openid']);
        if(!empty($openid)){
            $where .= " AND openid like '%{$openid}%'";
        }
		$status = -1;
		if(!empty($_GPC['status'])){
			$status = trim($_GPC['status']);
		}
        if($status!='-1'){
            $where .= " AND status = '{$status}'";
        }
        $mobile = trim($_GPC['mobile']);
        if(!empty($mobile)){
            $where .= " AND mobile like '%{$mobile}%'";
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where} ORDER BY {$orderbyStr} DESC limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }
    public function update_or_insert($data){
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
    public function update(){
        global $_W;
        if(empty($_W['openid'])){
            return '';
        }
        load()->model('mc');
        $uid = mc_openid2uid($_W['openid']);
        $user = mc_fetch($uid,array('nickname','avatar','realname','mobile','gender','residecity','resideprovince'));

        if(empty($user['avatar'])){
            $user = mc_oauth_userinfo();
        }
        $member = M('member')->getInfo($_W['openid']);

        if(empty($member)){
            $data = array();
            $data['uniacid'] = $_W['uniacid'];
            $data['openid'] = $_W['openid'];
            $data['nickname'] = $user['nickname'];
            $data['avatar'] = tomedia($user['avatar']);
            $data['create_time'] = time();
            $data['uid'] = $uid;
            if(!empty($_W['openid'])){
                pdo_insert($this->table,$data);
            }
        }else{
            $data = array();
			/**
            if(!empty($user['nickname'])){
                $data['nickname'] = trim($user['nickname']);
            }
            if(!empty($user['avatar'])){
                $data['avatar'] = tomedia(trim($user['avatar']));
            }*/
            if(!empty($uid)){
                $data['uid'] = intval($uid);
            }
            unset($data['id']);
            if(!empty($data)){
                pdo_update($this->table,$data,array('id'=>$member['id']));
            }
        }

        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND openid = :openid";
        $params = array(':uniacid'=>$_W['uniacid'],':openid'=>$_W['openid']);
        $member = pdo_fetch($sql,$params);
        $user = array_merge($user,$member);
        return $user;
    }
    public function getInfoById($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
        return $item;
    }
    public function getInfo($openid){
        global $_W;
        $item = pdo_get($this->table,array('openid'=>$openid,'uniacid'=>$_W['uniacid']));
        return $item;
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
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `openid` varchar(64) DEFAULT '',
              `number` int(11) DEFAULT '0' COMMENT '回答个数',
              `follow` int(11) DEFAULT '0' COMMENT '收听人数',
              `tags` varchar(20) DEFAULT '' COMMENT '头衔',
              `desc` varchar(320) DEFAULT '',
              `credit` int(5) DEFAULT '0' COMMENT '提问费用',
              `avatar` varchar(320) DEFAULT '',
              `nickname` varchar(32) DEFAULT '',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'status')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `status` tinyint(2) DEFAULT '2'");
        }
        if(!pdo_fieldexists($this->table,'subjects')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `subjects` varchar(100) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'realname')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `realname` varchar(32) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'home_cover')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `home_cover` varchar(255) DEFAULT 's:46:\"http://t1.tradestore.cn/1480743894_U9s9jE.jpeg\";'");
        }
        if(!pdo_fieldexists($this->table,'certify')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `certify` varchar(255) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'create_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `create_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'uid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `uid` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'open_free')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `open_free` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'ishot')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `ishot` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'isrecommend')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `isrecommend` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'category_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `category_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'admin')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `admin` tinyint(2) DEFAULT '0'");
        }
    }
}