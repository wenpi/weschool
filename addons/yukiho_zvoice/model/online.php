<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class online
{
    public $table = 'yukiho_zvoice_online';

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
    public function getNew(){
        global $_W;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE to_openid = :to_openid AND uniacid = :uniacid AND status = :status ORDER BY create_time DESC limit 1";
        $params = array(':to_openid'=>$_W['openid'],':uniacid'=>$_W['uniacid'],':status'=>0);
        $item = pdo_fetch($sql,$params);
        return $item;
    }
    public function createMessage($openid,$title="",$content="",$url="",$image="",$type="news"){
        global $_W;
        $data = array();
        $data['to_openid'] = $openid;
        $data['title'] = $title;
        $data['content'] = $content;
        $data['type'] = $type;
        if(empty($image)){
            $member = M('member')->getInfo($_W['openid']);
            $image = $member['avatar'];
        }
        $data['image'] = $image;
        $data['openid'] = $_W['openid'];
        if(empty($url)){
            return '';
        }
        $data['href'] = $url;
        $message = $this->update($data);
        M('common')->mc_notice_consume2($openid,$title,$content,$url);
        return $message;
    }
    public function install(){
        //pdo_query("DROP table ".tablename($this->table));

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
        if(!pdo_fieldexists($this->table,'to_openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `to_openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'title')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'status')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `status` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'href')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `href` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'content')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `content` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'type')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `type` varchar(32) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'image')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `image` varchar(320) DEFAULT ''");
        }
    }
}