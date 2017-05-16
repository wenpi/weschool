<?php
/**
 * 微查询模块处理程序
 *
 * @author Yoby
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Yoby_chaModuleProcessor extends WeModuleProcessor {
public function respond() {
 		global $_W;
 		$content = $this->message['content'];
 		$uid = $_W['uid'];
 		if($content=='条形码'){
 		
 		return $this->resptext('条形码识别'.json_encode($this));
 		}else{
       	 $rid = $this->rule;
        	$sql = "SELECT *  FROM " . tablename('yoby_cha_reply') . " WHERE `rid`=:rid LIMIT 1";
        $row = pdo_fetch($sql, array(':rid' => $rid));

		  return $this->respNews(array(
                        'Title' =>$row['hd_title'],
                        'Description' => $row['hd_desc'],
                        'PicUrl' => toimage($row['hd_img']),
                        'Url' =>$this->createMobileUrl('index', array('id' => $rid)),
            ));

		}
	}
}