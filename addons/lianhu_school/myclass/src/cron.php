<?php 
namespace myclass\src;

class cron {
    public $cron_id;
    public $uniacid;
    public $add_time;

    public function add(){
        global $_W;
        $in['add_time'] = time();
        pdo_run("delete from  ".tablename('lianhu_cron')." where add_time <".($in['add_time']-3600*24*7));
        $in["uniacid"]  = $_W['uniacid'];
        pdo_insert("lianhu_cron",$in);
    }
    public function getBeginTime(){
        $re  = pdo_fetchcolumn("select add_time from ".tablename('lianhu_cron')." order by add_time asc ");
        return $re;
    }
}