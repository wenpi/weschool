<?php
namespace myclass\src;

class blockClass extends common{
    public $class_id   = 'class_id';
    public $class_name = 'class_name';
    public $status     = 'status';

    public function __construct(){
        $this->setTable('lianhu_block_class');
        $this->setGlobal();
    }
    
}