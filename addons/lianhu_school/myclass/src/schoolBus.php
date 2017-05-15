<?php 
/*  分表机制
    控制粒度一个公众号一个表
    校车
*/
namespace myclass\src;

class schoolBus extends uniacidCommon {
   private $field_sql = "(
                            id          int(11) unsigned auto_increment,
                            uniacid     int(11) unsigned default 0,
                            school_id   int(11) unsigned default 0,
                            device_id   int(11) unsigned default 0,
                            lat         char(15),
                            lon         char(15),
                            baidu_lat         char(15),
                            baidu_lon         char(15),
                            add_time    int(11) unsigned default 0,
                            primary key(id) 
                        )engine=innodb charset=utf8;";
    public $id         = 'id';
    public $uniacid    = 'uniacid';
    public $school_id  = 'school_id';
    public $device_id  = 'device_id';
    public $lat        = 'lat';
    public $lon        = 'lon';
    public $baidu_lat  = 'baidu_lat';
    public $baidu_lon  = 'baidu_lon';
    public $add_time   = 'add_time';
    
    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_schoolbus');
        if(!pdo_tableexists($this->table_name)){
            $sql = "create table ".$this->table."   ".$this->field_sql;
            pdo_run($sql);
        }
    }
    //add 



}
