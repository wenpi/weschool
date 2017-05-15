<?php 
namespace myclass\ctl;

class mobileCode extends common{
    public $code_value;
    public $mobile;
    public $global_w;

    public function __construct(){
        global $_W;
        $this->global_w  = $_W;
        $this->use_class = D('mobileCode');
    }
    //查找验证码
    public function findCode(){
        $where["code_value"] = $this->code_value;
        $where["have_use"]   = 0;
        $where["uniacid"]    = $this->global_w['uniacid'];
        $where["add_time"]   = array(">",time()-3600*24);
        $result = $this->use_class->edit($where);
        return $result;
    }
    //生成手机验证码
    public function createCodeValue($len=6){
        $begin = pow(10,$len-1);
        $end   = pow(10,$len)-1;
        do{
            $value = rand($begin,$end);
            $this->code_value = $value;
        }while($this->findCode());
    }
    //生成记录并返回
    public function addCode(){
        $in['code_value'] = $this->code_value;
        $in['mobile']     = $this->mobile;
        $this->use_class->add($in);
    }
    



}