<?php
/**
 * 家校通模块处理程序
 *
 * @author zhuhuan
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') || exit('Access Denied');
require("myclass/autoLoad.php");
class Lianhu_schoolModuleProcessor extends WeModuleProcessor {
    public $table_pe;
    
    public function __construct(){
        $table_pe = tablename('lianhu');
        $table_pe = trim($table_pe,'`');
        $table_pe = str_ireplace('lianhu','',$table_pe); 
        $this->table_pe=$table_pe;
    }
	public function respond() {
		global $_W;
		$content  = $this->message;
		if($content['content']=='lianhu_school_channel'){
			return $this->schoolChannel($content);
		}
	}
	public function schoolChannel($content){
		global $_W;
		$school_id    = $content['scene'];
		setSchoolId($school_id);
		$openid        = $content['from'];
		$arr['openid'] = $openid;
		D('careChannelLog')->add($arr);
		//用户分组
		D("school")->school_id = $school_id;
		$school_name = D("school")->getSchoolInfo('school_name');
		addgroup($school_name,$this->get_weixin_token(),$openid);
		
		$str = S("system",'getSetContent',array('care_str',$school_id));
		$str = $str ? $str :"欢迎关注";
		$img = S("system",'getSetContent',array('care_img',$school_id));
		if($img){
			$base_dir     = $this->insertDir();
			$img 	      = $_W['attachurl'].$img; 
			$file_name    = $base_dir.time().rand(111111,999999).".jpg";
			$this->getImg($img,$file_name);
         	$up_file_name = $file_name;
			$media_id     = $this->uploadRes($up_file_name,'image');
			$this->sendcustomIMG($this->message['from'],$media_id);			
		}
		return $this->respText($str);
	}
	public function sendcustomIMG( $from_user, $msg) {
		$access_token = $this->get_weixin_token();
		$url          = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
		$post         = '{"touser":"' . $from_user . '","msgtype":"image","image":{"media_id":"' . $msg . '"}}';
		$this->curlPost($url, $post);
	}
	public function curlPost($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$info = curl_exec($ch);
		curl_close($ch);
		return $info;
	}
    #创建今日附件文件夹
    public function insertDir(){
         $base_dir=ATTACHMENT_ROOT.'images/'.date("Y/m/d",time()).'/';
         if(!file_exists($base_dir)){
                mkdirs($base_dir);   
		 }
         return $base_dir;
    }
    function getImg($url = "", $filename = ""){
        $hander = curl_init();
        $fp 	= fopen($filename,'wb');
        curl_setopt($hander,CURLOPT_URL,$url);
        curl_setopt($hander,CURLOPT_FILE,$fp);
        curl_setopt($hander,CURLOPT_HEADER,0);
        curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($hander,CURLOPT_TIMEOUT,60);
        curl_exec($hander);
		curl_close($hander);
        fclose($fp);
        Return true;
    }
	public function get_weixin_token() {
		global $_W;
		load()->classs('account');
		$accObj= WeixinAccount::create($_W['acid']);
		$access_token = $accObj->fetch_token();
		return $access_token;		
	}	
	private function uploadRes($img, $type) {
		$access_token = $this->get_weixin_token();
		$url  = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";
		$post = array(
			'media' => '@' . $img
		);
		$ret 	  = $this->http_request($url,$post);
		$ret['content'] = json_decode($ret['content'],1);
		$media_id = $ret['content']['media_id'];
		return $media_id;
  	}

   public  function http_request($url, $post = '', $extra = array(), $timeout = 60000){
		$timeout = intval($timeout / 1000);
		$timeout = (0 == $timeout) ? 1 : $timeout;
		$urlset  = parse_url($url);
		if(empty($urlset['path'])) {
		$urlset['path'] = '/';
		}
		if(!empty($urlset['query'])) {
		$urlset['query'] = "?{$urlset['query']}";
		}
		if(empty($urlset['port'])) {
		$urlset['port'] = $urlset['scheme'] == 'https' ? '443' : '80';
		}
		if (strexists($url, 'https://') && !extension_loaded('openssl')) {
			if (!extension_loaded("openssl")) {
				message('请开启您PHP环境的openssl');
			}
		}
		if(function_exists('curl_init') && function_exists('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $urlset['scheme']. '://' .$urlset['host'].($urlset['port'] == '80' ? '' : ':'.$urlset['port']).$urlset['path'].$urlset['query']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			if($post) {
				curl_setopt($ch, CURLOPT_POST, 1);
				if (is_array($post)) {
					$filepost = false;
					foreach ($post as $name => $value) {
						if (substr($value, 0, 1) == '@') {
						$filepost = true;
						$post[$name] = class_exists('CURLFile', false) ? new CURLFile(substr($value, 1)) : $value;
						break;
						}
					}
					if (!$filepost) {
						$post = http_build_query($post);
					}
				}
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			}
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
			if (defined('CURL_SSLVERSION_TLSv1')) {
				curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
			}
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
			if (!empty($extra) && is_array($extra)) {
				$headers = array();
				foreach ($extra as $opt => $value) {
				if (strexists($opt, 'CURLOPT_')) {
					curl_setopt($ch, constant($opt), $value);
				} elseif (is_numeric($opt)) {
					curl_setopt($ch, $opt, $value);
				} else {
					$headers[] = "{$opt}: {$value}";
				}
				}
				if(!empty($headers)) {
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				}
			}
			$data   = curl_exec($ch);
			$status = curl_getinfo($ch);
			$errno = curl_errno($ch);
			$error = curl_error($ch);
			curl_close($ch);
			if($errno || empty($data)) {
				return error(1, $error);
			} else {
				load()->func('communication');
				return ihttp_response_parse($data);
			}
			}
			$method = empty($post) ? 'GET' : 'POST';
			$fdata = "{$method} {$urlset['path']}{$urlset['query']} HT"."TP/1.1\r\n";
			$fdata .= "Host: {$urlset['host']}\r\n";
			if(function_exists('gzdecode')) {
			$fdata .= "Accept-Encoding: gzip, deflate\r\n";
			}
			$fdata .= "Connection: close\r\n";
			if (!empty($extra) && is_array($extra)) {
			foreach ($extra as $opt => $value) {
				if (!strexists($opt, 'CURLOPT_')) {
				$fdata .= "{$opt}: {$value}\r\n";
				}
			}
			}
			$body = '';
			if ($post) {
			if (is_array($post)) {
				$body = http_build_query($post);
			} else {
				$body = urlencode($post);
			}
			$fdata .= 'Content-Length: ' . strlen($body) . "\r\n\r\n{$body}";
			} else {
			$fdata .= "\r\n";
			}
			if($urlset['scheme'] == 'https') {
			$fp = fsockopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
			} else {
			$fp = fsockopen($urlset['host'], $urlset['port'], $errno, $error);
			}
			stream_set_blocking($fp, true);
			stream_set_timeout($fp, $timeout);
			if (!$fp) {
			return error(1, $error);
			} else {
			fwrite($fp, $fdata);
			$content = '';
			while (!feof($fp))
				$content .= fgets($fp, 512);
			fclose($fp);
			load()->func('communication');
			return ihttp_response_parse($content, true);
    	}

  }
	  	

  



}