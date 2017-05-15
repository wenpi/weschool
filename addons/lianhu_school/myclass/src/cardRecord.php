<?php 
namespace myclass\src;

class cardRecord extends common{
    public $record_id   = 'record_id';
    public $grade_id    = 'grade_id';
    public $class_id    = 'class_id';
    public $student_id  = 'student_id';
    public $device_id   = 'device_id';
    public $rfid_value  = 'rfid_value';
    public $img_url     = 'img_url';
    public $year        = 'year';
    public $month       = 'month';
    public $day         = 'day';
    public $up_low      = 'up_low';
    public $signTemp    = 'signTemp';
    public $play_card_time  = 'play_card_time';
    public $add_time_str    = 'add_time_str';
    public $type            = 'type';
    public $img_url2        = 'img_url2';

    public function __construct(){
        $this->setTable('lianhu_card_record');
        $this->setGlobal();        
    }
    


}