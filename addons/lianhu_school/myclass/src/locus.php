<?php 
namespace myclass\src;

class locus extends uniacidCommon{
    private $field_sql = "(
                            id                  int(11) unsigned auto_increment,
                            uniacid             int(11) unsigned default 0,
                            school_id           int(11) unsigned default 0,
                            student_id          int(11) unsigned default 0 comment '学生id',
                            locus_info          text,
                            year                char(10),
                            month               char(10),
                            date                char(10),
                            last_time           int(11) unsigned default 0,
                            add_time            int(11) unsigned default 0,
                            primary key(id) 
                        )engine=innodb charset=utf8;";    
    public $id         = 'id';
    public $student_id = 'student_id';
    public $locus_info = 'locus_info';
    public $year       = 'year';
    public $month      = 'month';
    public $date       = 'date';
    public $last_time  = 'lat_time';

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_student_locus');
        if(!pdo_tableexists($this->table_name)){
            $sql = "create table ".$this->table."   ".$this->field_sql;
            pdo_run($sql);
        }
    }     
    public function action($arr){
        $time = time();
        list($year,$month,$date) = explode('-',date("Y-m-d",$time));
        $params["year"]          = $year;
        $params["month"]         = $month;
        $params["date"]          = $date;
        $params["student_id"]    = $arr['student_id'];
        $re = $this->edit($params); 
        if($re){
            $this->contentAdd($arr,$re);
        }else{
            $this->contentInsert($params,$arr);
        }
        return $re;
    }
    public function contentAdd($arr,$re){
        $now_time             = time();
        $params['locus_info'] = $re['locus_info'].','.date("H:i:s",$now_time).'=>'.$arr['device_name'];
        $params['last_time']  = time();
        $this->edit(array("id"=>$re['id']),$params);
    }
    public function contentInsert($params,$arr){
        $params['last_time']  = time();
        $params["locus_info"] = date("H:i:s",time()).'=>'.$arr['device_name'];
        $this->add($params);
    }


} 