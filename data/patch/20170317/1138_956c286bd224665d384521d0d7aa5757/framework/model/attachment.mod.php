<?php
function attachment_alioss_datacenters() {
	$bucket_datacenter = array(
		'oss-cn-hangzhou' => '杭州数据中心',
		'oss-cn-qingdao' => '青岛数据中心',
		'oss-cn-beijing' => '北京数据中心',
		'oss-cn-hongkong' => '香港数据中心',
		'oss-cn-shenzhen' => '深圳数据中心',
		'oss-cn-shanghai' => '上海数据中心',
		'oss-us-west-1' => '美国硅谷数据中心',
	);
	return $bucket_datacenter;
}


function attachment_newalioss_auth($key, $secret, $bucket){
	require_once(IA_ROOT.'/framework/library/alioss/autoload.php');
	$buckets = attachment_alioss_buctkets($key, $secret);
	$url = 'http://'.$buckets[$bucket]['location'].'.aliyuncs.com';
	$filename = 'MicroEngine.ico';
	try {
		$ossClient = new \OSS\OssClient($key, $secret, $url);
		$ossClient->uploadFile($bucket, $filename, ATTACHMENT_ROOT.'images/global/'.$filename);
	} catch (\OSS\Core\OssException $e) {
		return error(1, $e->getMessage());
	}
	return 1;
}

function attachment_alioss_buctkets($key, $secret) {
	require_once(IA_ROOT.'/framework/library/alioss/autoload.php');
	$url = 'http://oss-cn-beijing.aliyuncs.com';
	try {
		$ossClient = new \OSS\OssClient($key, $secret, $url);
	} catch(\OSS\Core\OssException $e) {
		return error(1, $e->getMessage());
	}
	try{
		$bucketlistinfo = $ossClient->listBuckets();
	} catch(OSS\OSS_Exception $e) {
		return error(1, $e->getMessage());
	}
	$bucketlistinfo = $bucketlistinfo->getBucketList();
	$bucketlist = array();
	foreach ($bucketlistinfo as &$bucket) {
		$bucketlist[$bucket->getName()] = array('name' => $bucket->getName(), 'location' => $bucket->getLocation());
	}
	return $bucketlist;
}

function attachment_qiniu_change_district($district) {
	if ($district == 2) {
		$zonge = IA_ROOT.'/framework/library/qiniu/src/Qiniu/Zone.php';
		$zonge = file_get_contents($zonge);
		$zonge = str_replace('http://up.qiniu.com', 'http://up-z1.qiniu.com', $zonge);
		$zonge = str_replace('http://upload.qiniu.com', 'http://upload-z1.qiniu.com', $zonge);
		file_put_contents(IA_ROOT.'/framework/library/qiniu/src/Qiniu/Zone.php', $zonge);
		$config = IA_ROOT.'/framework/library/qiniu/src/Qiniu/Config.php';
		$config = file_get_contents($config);
		$config = str_replace('http://iovip.qbox.me', 'http://iovip-z1.qbox.me', $config);
		file_put_contents(IA_ROOT.'/framework/library/qiniu/src/Qiniu/Config.php', $config);
	} else {
		$zonge = IA_ROOT.'/framework/library/qiniu/src/Qiniu/Zone.php';
		$zonge = file_get_contents($zonge);
		$zonge = str_replace('http://up-z1.qiniu.com', 'http://up.qiniu.com', $zonge);
		$zonge = str_replace('http://upload-z1.qiniu.com', 'http://upload.qiniu.com', $zonge);
		file_put_contents(IA_ROOT.'/framework/library/qiniu/src/Qiniu/Zone.php', $zonge);
		$config = IA_ROOT.'/framework/library/qiniu/src/Qiniu/Config.php';
		$config = file_get_contents($config);
		$config = str_replace('http://iovip-z1.qbox.me', 'http://iovip.qbox.me', $config);
		file_put_contents(IA_ROOT.'/framework/library/qiniu/src/Qiniu/Config.php', $config);
	}
	return true;
}

function attachment_qiniu_auth($key, $secret,$bucket, $district) {
	require_once(IA_ROOT . '/framework/library/qiniu/autoload.php');
	attachment_qiniu_change_district($district);
	$auth = new Qiniu\Auth($key, $secret);
	$token = $auth->uploadToken($bucket);
	$uploadmgr = new Qiniu\Storage\UploadManager();
	list($ret, $err) = $uploadmgr->putFile($token, 'MicroEngine.ico', ATTACHMENT_ROOT.'images/global/MicroEngine.ico');
	if ($err !== null) {
		$err = (array)$err;
		$err = (array)array_pop($err);
		$err = json_decode($err['body'], true);
		return error(-1, $err);
	} else {
		return true;
	}
}
function attachment_cos_auth($bucket,$appid, $key, $secret) {
	require_once(IA_ROOT.'/framework/library/cos/include.php');
	$con = file_get_contents(IA_ROOT.'/framework/library/cos/Qcloud_cos/Conf.php');
	$con = preg_replace('/const[\s]APPID[\s]=[\s]\'.*\';/', 'const APPID = \''.$appid.'\';', $con);
	$con = preg_replace('/const[\s]SECRET_ID[\s]=[\s]\'.*\';/', 'const SECRET_ID = \''.$key.'\';', $con);
	$con = preg_replace('/const[\s]SECRET_KEY[\s]=[\s]\'.*\';/', 'const SECRET_KEY = \''.$secret.'\';', $con);
	file_put_contents(IA_ROOT.'/framework/library/cos/Qcloud_cos/Conf.php', $con);
	$uploadRet = \Qcloud_cos\Cosapi::upload($bucket, ATTACHMENT_ROOT.'images/global/MicroEngine.ico', '/MicroEngine.ico','',3 * 1024 * 1024, 0);
	if ($uploadRet['code'] != 0) {
		switch ($uploadRet['code']) {
			case -62:
				$message = '输入的appid有误';
				break;
			case -79:
				$message = '输入的SecretID有误';
				break;
			case -97:
				$message = '输入的SecretKEY有误';
				break;
			case -166:
				$message = '输入的bucket有误';
				break;
		}
		return error(-1, $message);
	}
	return true;
}
