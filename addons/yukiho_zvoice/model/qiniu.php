<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 3:06
 */
require_once MODULE_ROOT.'/vendor/autoload.php';

use Qiniu\Config;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Processing\PersistentFop;

class qiniu {
    public $auth;
    public $bucketMgr;
    public $bucket;
    public $token;
    public $uploadMgr;
    public $policy;
    public $pfop;
    public $bucket_result;
    public $mps;
    public $access_key;
    public $secret_key;

    public function __construct()
    {
        $this->init();
    }

    public function init(){
        global $_W;
        $setting = M('setting')->getSetting('qiniu');
        $access_key = $setting['access_key'];
        $secret_key = $setting['secret_key'];
        $this->mps = $setting['mps'];

        $this->access_key = $access_key;
        $this->secret_key = $secret_key;

        $bucket = $setting['bucket_name'];
        $bucket_result = $setting['bucket_name_result'];
        $this->url = $setting['url'];

        $this->bucket = $bucket;
        $this->bucket_result = $bucket_result;
        $this->auth = new Auth($access_key, $secret_key);

        $this->bucketMgr = new BucketManager($this->auth);
        $this->token = $this->auth->uploadToken($this->bucket);
        $this->policy = array(
            'callbackUrl' => $_W['siteroot'].'imeepos_print/qiniu.php',
            'callbackBody' => 'filename=$(fname)&filesize=$(fsize)'
        );
        $this->uptoken = $this->auth->uploadToken($this->bucket, null, 3600, $this->policy);
        $this->uploadMgr = new UploadManager();
    }

    public function check(){
        return !empty($this->bucket)?true:false;
    }

    public function getUrl($key){
        return $this->url."/".$key;
    }

    public function urlsafe_base64_encode($str){
        $find = array("+","/");
        $replace = array("-", "_");
        return str_replace($find, $replace, base64_encode($str));
    }
    public function check_file($ext = ''){
        $files = array('doc','docx','odt','rtf','wps','ppt','pptx','odp','dps','xls','xlsx','ods','csv','et');
        foreach ($files as $f){
            if($f == $ext){
                return true;
            }else{
                return false;
            }
        }
    }
    public function toMp3($key,$return){
        $data = 'bucket=' . $this->bucket . '&key=' . $key . '&fops=' . urlencode('avthumb/mp3') . '&notifyURL=' . urlencode($return) . '&pipeline='.$this->mps;
        $sign = hash_hmac('sha1', "/pfop/\n" . $data, $this->secret_key, true);
        $token = $this->access_key . ':' . str_replace(array('+', '/'), array('-', '_'), base64_encode($sign));
        $header = array('Content-Type:application/x-www-form-urlencoded', 'Authorization: QBox ' . $token);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://api.qiniu.com/pfop/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $result;
    }

    public function putFile($key, $filePath){
        list($ret, $err) = $this->uploadMgr->putFile($this->token,$key, $filePath);
        if ($err !== null) {
            return $err;
        } else {
            return $ret;
        }
    }
    public function fetch($url,$key){
        list($ret, $err) = $this->bucketMgr->fetch($url, $this->bucket, $key);
        if ($err !== null) {
            return false;
        } else {
            return $key;
            return $ret;
        }
    }
    public function copy($key,$key2){
        $err = $this->bucketMgr->copy($this->bucket, $key, $this->bucket, $key2);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
    }
    function delete($key){
        $err = $this->bucketMgr->delete($this->bucket, $key);
        if ($err !== null) {
            return false;
        } else {
            return false;
        }
    }
    public function stat($key=""){
        list($ret, $err) = $this->bucketMgr->stat($this->bucket, $key);
        if ($err !== null) {
            return false;
        } else {
            return $ret;
        }
    }
    public function move($key2,$key3){
        $err = $this->bucketMgr->move($this->bucket, $key2, $this->bucket, $key3);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
    }
    public function listFiles($marker,$limit){
        $prefix = '';
        list($iterms, $marker, $err) = $this->bucketMgr->listFiles($this->bucket, $prefix, $marker, $limit);
        if ($err !== null) {
            return false;
        } else {
            return array('iterms'=>$iterms,'marker'=>$marker);
        }
    }


}