<?php 
namespace myclass\src;

class module extends common {
    public $module_id       = 'module_id';
    public $module_key      = 'module_key';
    public $module_name     = 'module_name';


    public function __construct(){
        $this->setTable('lianhu_module');
    }
    


}