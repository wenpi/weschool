<?php 
namespace myclass\src;

class cookbook extends common{
   public  $cookbook_id          = 'cookbook_id';
   public  $cookbook_week        = 'cookbook_week';
   public  $cookbooK_breakfast   = 'cookbooK_breakfast';
   public  $xiaoye               = 'xiaoye';
   public  $class_name           = 'class_name';
   public  $use_time             = 'use_time';
   public  $imgs                 = 'imgs';

   
   public function __construct(){
       $this->setTable('lianhu_cookbook');
       $this->setGlobal();
   }

    public function edit($where,$up=false){
        $where['school_id'] = $this->school_id;
        $re                 = parent::edit($where,$up);
        return $re;
    }

}