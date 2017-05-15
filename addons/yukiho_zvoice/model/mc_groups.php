<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class mc_groups
{
    public $table = 'mc_groups';
    public function getall($params = array()){
        global $_W,$_GPC;
        $params['uniacid'] = $_W['uniacid'];
        $list = pdo_getall($this->table,$params);
        return $list;
    }
}