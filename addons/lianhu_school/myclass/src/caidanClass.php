<?php
namespace myclass\src;

class caidanClass extends common{
    public $class_id   = 'class_id';
    public $class_name = 'class_name';
    public $class_font = 'class_font';
    public $status     = 'status';

    public function __construct(){
        $this->setTable('lianhu_caidan_class');
        $this->setGlobal();
    }
    
    
}