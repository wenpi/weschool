<?php 
namespace myclass\src;

class booking extends common{
    public $booking_id      = 'booking_id';
    public $booking_title   = 'booking_title';
    public $booking_img     = 'booking_img';
    public $booking_intro   = 'booking_intro';
    public $booking_content = 'booking_content';
    public $limit_num       = 'limit_num';
    public $begin_time      = 'begin_time';
    public $end_time        = 'end_time';
    public $ask_phone       = 'ask_phone';
    public $ask_name        = 'ask_name';
    public $ask_id          = 'ask_id';
    public $ask_read        = 'ask_read';

    public $ask_sex         = 'ask_sex';
    public $ask_old_school  = 'ask_old_school';
    public $ask_huji        = 'ask_huji';
    public $ask_address     = 'ask_address';
    public $ask_live        = 'ask_live';
    public $ask_time        = 'ask_time';
    public $ask_birthday    = 'ask_birthday';
    public $ask_parent_id   = 'ask_parent_id';
    public $ask_vacode      = 'ask_vacode';
    public $ask_localphone  = 'ask_localphone';//固话
    public $ask_nation      = 'ask_nation';//民族

    public $birth_begin_time    = 'birth_begin_time';
    public $birth_end_time      = 'birth_end_time';
    public $status;
    

    public function __construct(){
        $this->setTable('lianhu_booking');
        $this->setGlobal();        
    }
    
    public function dataAdd($arr){
        return parent::add($arr);
    }
    
    public function dataEdit($id,$up=false){
        $where["booking_id"] = $id;
        $result              = parent::edit($where,$up);
        return $result;
    }
    
    public function dataList($params){
      $this->_set('each_page',100000);
      $params[":status"] = array("!=",-1);
      return parent::getList($params);
    }
    
}
 