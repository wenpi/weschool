<?php

class setting
{
    public $table = 'yukiho_zvoice_setting';

    public function __construct()
    {
        $this->install();
    }

    public function getSetting($code){
        $item = $this->getInfo($code);
        if(!empty($item)){
            return iunserializer($item['value']);
        }else{
            return array();
        }
    }
    /**
    删除某设置
     */
    public function delete($code){
        global $_W;
        if(empty($code)){
            return '';
        }
        pdo_delete($this->table,array('uniacid'=>$_W['uniacid'],'codename'=>$code));
    }

    public function update($data){
        global $_W;
        $item = $this->getInfo($data['codename']);
        $data['uniacid'] = $_W['uniacid'];
        if(empty($item)){
            pdo_insert($this->table,$data);
        }else{
            pdo_update($this->table,$data,array('uniacid'=>$_W['uniacid'],'codename'=>$data['codename']));
        }
    }
    public function getInfo($codename){
        global $_W;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND codename = :codename";
        $params = array(':uniacid'=>$_W['uniacid'],':codename'=>$codename);
        $item = pdo_fetch($sql,$params);
        return $item;
    }
    public function install(){
        global $_W;
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `codename` varchar(32) DEFAULT '',
              `value` text,
              `uniacid` int(11) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
			
			$data = array();
			$data['uniacid'] = $_W['uniacid'];
			$data['codename'] = 'system';
			$data['value'] = 'a:10:{s:9:"openReask";s:1:"3";s:10:"openVerify";s:1:"1";s:8:"openFree";s:1:"0";s:12:"reward_money";s:2:"80";s:11:"tutor_money";s:8:"contents";s:12:"listen_price";s:1:"1";s:16:"listen_get_price";s:2:"20";s:17:"listen_get_price2";s:2:"30";s:6:"submit";s:6:"提交";s:5:"token";s:8:"d643e519";}';
			M('setting')->update($data);
			
			$data['uniacid'] = $_W['uniacid'];
			$data['codename'] = 'template';
			$data['value'] = 'a:7:{s:8:"userName";s:6:"学生";s:8:"authname";s:6:"老师";s:9:"learnName";s:6:"学习";s:9:"limitFree";s:12:"限时免费";s:10:"rewardName";s:9:"塞红包";s:6:"submit";s:6:"提交";s:5:"token";s:8:"d643e519";}';
			M('setting')->update($data);
        }
    }
}