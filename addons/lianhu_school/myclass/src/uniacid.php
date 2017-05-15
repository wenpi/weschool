<?php 
namespace myclass\src;

class uniacid {
    public $table_name ='account_wechats';

    public $table;
    public function __construct(){
        $this->table = tablename($this->table_name);
    }
    public function getMpName($uniacid){
        if($uniacid){
            $name = pdo_fetchcolumn("select  name from ".$this->table."  where uniacid=:uniacid",array(":uniacid"=>$uniacid));
            return $name;
        }
    }

}
