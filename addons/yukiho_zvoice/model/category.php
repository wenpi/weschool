<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class category
{
    public $table = 'yukiho_zvoice_category';

    public function __construct()
    {
        $this->install();
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
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY displayorder DESC";
        return pdo_fetchall($sql,$ss);
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
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY displayorder DESC limit ".(($page-1)*$psize).",".$psize;
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

    public function getMyList(){
        global $_W,$_GPC;
        $total = 0;
		$member = M('member')->getInfo($_W['openid']);
        if(!empty($member['subjects']) && strpos($member['subjects'],',')!==false){
            return pdo_fetchall("SELECT * FROM ".tablename($this->table)." WHERE fid='0' AND id in(".$member['subjects']."-1) ORDER BY displayorder DESC");
        }else{
            return M('category')->getall(array('fid'=>'0'));
        }
    }
	
    public function getMySettingList(){
        global $_W,$_GPC;
        $total = 0;
		$member = M('member')->getInfo($_W['openid']);
		$list = M('category')->getall(array('fid'=>'0'));
        if(!empty($member['subjects']) && strpos($member['subjects'],',')!==false){
            $temp = pdo_fetchall("SELECT * FROM ".tablename($this->table)." WHERE id in(".$member['subjects']."-1) ORDER BY displayorder DESC");
			foreach ($temp as &$t) {
				foreach ($list as &$li) {
					if($li['id']==$t['id']){
						$li['checked'] = '1';
					}
				}
			}
		}
		return $list;
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
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(32) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'fid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `fid` int(1) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'displayorder')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `displayorder` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'image')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `image` varchar(320) DEFAULT ''");
        }
    }
}