<?php
namespace myclass\src;
/*
`uid`, 
`uniacid`,
 `mobile`,
  `email`, 
  `password`,
   `salt`,
    `groupid`, 
    `credit1`, 
    `credit2`, 
    `credit3`, 
    `credit4`, 
    `credit5`, 
    `createtime`, 
    `realname`, 
    `nickname`, 
    `avatar`, 
    `qq`,
     `vip`,
     `gender`, 
     `birthyear`, 
     `birthmonth`, 
     `birthday`, 
     `constellation`, 
     `zodiac`, 
     `telephone`, 
     `idcard`, 
     `studentid`, 
     `grade`, 
     `address`, 
     `zipcode`, 
     `nationality`, 
     `resideprovince`, 
     `residecity`, 
     `residedist`,
*/
class mcMembers extends common{

    public function __construct(){
        $this->setTable('mc_members');
        $this->setGlobal();          
    }
    public function add($arr){
        global $_W;
        $arr['uniacid'] = $_W['uniacid'];
        $arr['mobile']  = $arr['mobile'];
        $arr['nickname']= $arr['nickname'];
        $arr['salt']    = rand(111,999);
        $arr['password']= substr(user_hash($arr['password'],$arr['salt']),0,32);
        pdo_insert($this->table_name,$arr);
        return pdo_insertid();
    }
    public function update($mobile,$password){
        $result = $this->findPhone($mobile);
        if($result){
            $password    = substr(user_hash($password,$result['salt']),0,32);
            $where["uid"]= $result['uid'];
            $up["password"] = $password;
            $result         = $this->edit($where,$up);
            return $result;
        }
        return false;
    }
    public function check($mobile,$password){
        $result = $this->findPhone($mobile);
        if($result){
            $password    = substr(user_hash($password,$result['salt']),0,32);
            if($password == $result['password']){
                return $result;
            }
        }
        return false;
    }
    public function findPhone($phone){
        global $_W;
        $params["mobile"]  = $phone;
        $params["uniacid"] = $_W['uniacid'];
        $result            = $this->edit($params);
        return $result;
    }

}