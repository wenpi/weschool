<?php

/**
 * used: 
 * User: yukiho_zvoice
 * Qq: 575144101
 */
class code
{
    public $table = 'yukiho_zvoice_code';

    public function __construct()
    {
        $this->install();
    }

    public function getall(){
        global $_W;
        $list = pdo_getall($this->table,array('uniacid'=>$_W['uniacid']));
        return $list;
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where =""){
        global $_W;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $params = array(':uniacid'=>$_W['uniacid']);
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }
    public function update($data){
        global $_W;
        $data['uniacid'] = $_W['uniacid'];
        if(empty($data['id'])){
            pdo_insert($this->table,$data);
            $data['id'] = pdo_insertid();
        }else{
            //更新
            pdo_update($this->table,$data,array('uniacid'=>$_W['uniacid'],'id'=>$data['id']));
        }
        return $data;
    }
    public function getInfo($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
        return $item;
    }

    public function send($mobile){
        //验证码发送
        global $_W;
        $setting = M('setting')->getSetting('sms');
        $this->appkey = $setting['appkey'];
        $this->appsecret = $setting['appsecret'];
        $this->moban_num = $setting['moban_num'];
        $this->type = $setting['sms_api_type'];
        $this->signname = $setting['signname'];
        $member = M('member')->getInfo($_W['openid']);
        $code = random(4,true);

        $data = array();
        $data['uniacid'] = $_W['uniacid'];
        $data['openid'] = $_W['openid'];
        $data['create_time'] = time();
        $data['code'] = $code;
        $data['mobile'] = $mobile;

        $code_item = $this->update($data);
        if($this->type == 2){
            //聚合api
            $sendUrl = 'http://v.juhe.cn/sms/send';
            $smsConf = array(
                'key'   => $this->appsecret,
                'mobile'    => $this->mobile,
                'tpl_id'    => $this->moban_num,
                'tpl_value' =>'#nickname#='.$member['nickname'].'&#code#='.$code_item['code']
            );
            $content = $this->juhecurl($sendUrl,$smsConf,1);
            if($content){
                $result = json_decode($content,true);
                $error_code = $result['error_code'];
                if($error_code == 0){
                    return $code_item['id'];
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        if($this->type == 1){
            //阿里大鱼
            include IA_ROOT."/addons/imeepos_fvoice/libs/TopSdk.php";
            $c = new TopClient();
            $c->appkey = $this->appkey;
            $c->secretKey = $this->appsecret;
            $req = new AlibabaAliqinFcSmsNumSendRequest();
            $req->setExtend("123456");
            $req->setSmsType("normal");
            $req->setSmsFreeSignName($this->signname);
            $json = json_encode(array("code"=>$code_item['code'],'product'=>'米波'));
            $req->setSmsParam($json);
            $req->setRecNum($mobile);
            $req->setSmsTemplateCode($this->moban_num);
            $return = $c->execute($req);
            return $code_item['id'];
        }
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }


    public function sendAli(){
        //阿里大鱼短信
    }

    public function sendJuhe(){
        //聚合短信api
    }

    public function sendMeepo(){
        //米波验证码联盟

    }
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `mobile` varchar(32) DEFAULT '',
              `code` varchar(32) DEFAULT '',
              `time` int(11) DEFAULT '0',
              `content` varchar(320) DEFAULT '',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'uniacid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `uniacid` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'mobile')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `mobile` varchar(12) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'code')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `code` varchar(8) DEFAULT ''");
        }
    }
}