<?php

/**
 * used:
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class advs
{
    public $table = 'yukiho_zvoice_advs';

    public function __construct()
    {
        $this->install();
    }

    public function getPosition(){
        $postions = array();
        $postions['swiper'] = '滑动广告';
        return $postions;
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

    public function getList($page,$where =""){
        global $_W;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where} ORDER BY time DESC limit ".(($page-1)*$psize).",".$psize;
        $params = array(':uniacid'=>$_W['uniacid']);
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
              `title` varchar(64) DEFAULT '',
              `image` varchar(300) DEFAULT '',
              `time` int(11) DEFAULT '0',
              `link` varchar(320) DEFAULT '',
              `status` tinyint(2) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'activeid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `activeid` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'position')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `position` varchar(32) DEFAULT ''");
        }
    }
}