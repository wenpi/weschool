<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class chart
{
    public $table = 'yukiho_zvoice_chart';

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

    public function getMyList($page,$openid){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a LEFT JOIN ".tablename("yukiho_zvoice_chart_log_thumb")." b "
			."ON a.id=b.logid WHERE b.openid='".$openid."' AND a.uniacid='".$_W['uniacid']."' ORDER BY a.create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
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
		$sql = "SELECT COUNT(*) FROM ".tablename("yukiho_zvoice_chart_log_thumb")." WHERE catalog='chart' and type='1' and logid='".$item['id']."'";
		$item['up'] = pdo_fetchcolumn($sql,$params);
		$sql = "SELECT COUNT(*) FROM ".tablename("yukiho_zvoice_chart_log_thumb")." WHERE catalog='chart' and type='2' and logid='".$item['id']."'";
		$item['down'] = pdo_fetchcolumn($sql,$params);
        return $item;
    }
    public function getNow(){
        global $_W;
        $item = pdo_get($this->table,array('status'=>1,'uniacid'=>$_W['uniacid']));
		$sql = "SELECT COUNT(*) FROM ".tablename("yukiho_zvoice_chart_log_thumb")." WHERE catalog='chart' and type='1' and logid='".$item['id']."'";
		$item['up'] = pdo_fetchcolumn($sql,$params);
		$sql = "SELECT COUNT(*) FROM ".tablename("yukiho_zvoice_chart_log_thumb")." WHERE catalog='chart' and type='2' and logid='".$item['id']."'";
		$item['down'] = pdo_fetchcolumn($sql,$params);
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
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'status')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `status` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'user_group')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `user_group` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'follow')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `follow` tinyint(2) DEFAULT '0'");
        }
    }
}