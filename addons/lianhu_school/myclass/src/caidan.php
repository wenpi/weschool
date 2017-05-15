<?php
namespace myclass\src;

class caidan extends common{
    public $caidan_id   = 'caidan_id';
    public $caidan_name = 'caidan_name';
    public $caidan_url  = 'caidan_url';
    public $caidan_font = 'caidan_font';
    public $status      = 'status';
    public $class_id    = 'class_id';

    public function __construct(){
        $this->setTable('lianhu_caidan');
        $this->setGlobal();
    }
    

    
    
}