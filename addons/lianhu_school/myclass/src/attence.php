<?php 
namespace myclass\src;

class attence extends common{
     public function __construct(){
        $this->setTable('lianhu_card_record');
        $this->setGlobal();
    }
    

}