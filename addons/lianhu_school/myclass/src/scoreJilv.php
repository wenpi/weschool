<?php 
namespace myclass\src;
class scoreJilv extends common{
    public $scorejilv_id   = 'scorejilv_id';
    public $scorejilv_name = 'scorejilv_name';
    public $addtime        = 'addtime';
    public $grade_id       = 'grade_id';
    public $status         = 'status';
    
    public function __construct(){
        $this->setTable('lianhu_scorejilv');
        $this->setGlobal();       
    }
    

}