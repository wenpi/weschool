<?php
/**
 * 微查询模块定义
 *
 * @author Yoby
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Yoby_chaModule extends WeModule {
public $tablename = 'yoby_cha_reply';
	public function fieldsFormDisplay($rid = 0) {
global $_W;
$weid = $_W['uniacid'];
		if(!empty($rid)){
			$reply = pdo_fetch("SELECT * FROM ".tablename($this->tablename)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			
		}else{
$reply = array(
			'tb'=>1,
'hd_title'=>'查询标题',
			'hd_desc'=>'查询描述!',
			'hd_img'=>$_W['siteroot']."addons/yoby_cha/template/mobile/images/share.jpg",
			'is_show'=>0,
			'is_m'=>0,
);
}
include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
return true;
	}

	public function fieldsFormSubmit($rid) {
global $_GPC, $_W;
	$id = intval($_GPC['reply_id']);
$insert = array(
			'rid' => $rid,
			'tb' => $_GPC['tb'],
'hd_img' => $_GPC['hd_img'],
			'hd_title' => $_GPC['hd_title'],
			'hd_desc' => $_GPC['hd_desc'],
			'is_show' => $_GPC['is_show'],
			'is_m' => $_GPC['is_m'],
);
if (empty($id)) {
			pdo_insert($this->tablename, $insert);
		} else {
			pdo_update($this->tablename, $insert, array('id' => $id));
		}
	}

	public function ruleDeleted($rid=0) {
global $_W;
		$row = pdo_fetchall("SELECT id FROM ".tablename($this->tablename)." WHERE rid = '$rid'");
		$deleteid = array();
 
		if (!empty($row)) {
			foreach ($row as $index => $row) {
				
				$deleteid[] = $row['id'];
			}
		}
		pdo_delete($this->tablename, "id IN ('".implode("','", $deleteid)."')");

		return true;


	}

	public function settingsDisplay($settings) {
				global $_W, $_GPC;
				$weid = $_W['uniacid'];
					if(!isset($settings['guanzhu'])) {
					$settings['guanzhu']="http://mp.weixin.qq.com/s?__biz=MjM5ODI5MzYxMQ==&mid=200348453&idx=1&sn=0e8c72090091d09036d2727af00e9555&scene=1#rd";
					}
if(!isset($settings['pg'])) {
					$settings['pg']=15;
					}
				if(checksubmit()) {
			$cfg = array(
				'guanzhu' =>$_GPC['guanzhu'],
				'pg' =>$_GPC['pg']
			);
			if($this->saveSettings($cfg)) {
				message('保存成功', 'refresh');
			}
		}
		include $this->template('setting');
	}

}