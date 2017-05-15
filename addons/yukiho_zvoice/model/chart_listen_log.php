<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class chart_listen_log
{
    public $table = 'yukiho_zvoice_chart_listen_log';

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
    public function getTotal($chart_id){
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE chart_id = :chart_id";
        $params = array(':chart_id'=>$chart_id);
        $total = pdo_fetchcolumn($sql,$params);
        if(empty($total)){
            $total = 0;
        }
        return $total;
    }
    public function getLogTotal($chart_log_id){
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE chart_log_id = :chart_log_id";
        $params = array(':chart_log_id'=>$chart_log_id);
        $total = pdo_fetchcolumn($sql,$params);
        if(empty($total)){
            $total = 0;
        }
        return $total;
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
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'chart_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `chart_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'chart_log_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `chart_log_id` int(11) DEFAULT '0'");
        }
    }
}