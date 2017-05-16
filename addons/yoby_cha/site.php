<?php
/**
 * 微查询模块微站定义
 *
 * @author Yoby
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
function is_weixin() {
	$agent = $_SERVER ['HTTP_USER_AGENT'];
	if (! strpos ( $agent, "icroMessenger" )) {
		return false;
	}
	return true;
}

function hidetel($phone){
    $IsWhat = preg_match('/(0[0-9]{2,3}[-]?[2-9][0-9]{6,7}[-]?[0-9]?)/i',$phone); 
    if($IsWhat == 1){
        return preg_replace('/(0[0-9]{2,3}[-]?[2-9])[0-9]{3,4}([0-9]{3}[-]?[0-9]?)/i','$1****$2',$phone);
    }else{
        return  preg_replace('/(1[3587]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
    }
}
function pager($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => '')) {
	global $_W;
	$pdata = array(
		'tcount' => 0,
		'tpage' => 0,
		'cindex' => 0,
		'findex' => 0,
		'pindex' => 0,
		'nindex' => 0,
		'lindex' => 0,
		'options' => ''
	);
	if($context['ajaxcallback']) {
		$context['isajax'] = true;
	}

	$pdata['tcount'] = $tcount;
	$pdata['tpage'] = ceil($tcount / $psize);
	if($pdata['tpage'] <= 1) {
		return '';
	}
	$cindex = $pindex;
	$cindex = min($cindex, $pdata['tpage']);
	$cindex = max($cindex, 1);
	$pdata['cindex'] = $cindex;
	$pdata['findex'] = 1;
	$pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
	$pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
	$pdata['lindex'] = $pdata['tpage'];

	if($context['isajax']) {
		if(!$url) {
			$url = $_W['script_name'] . '?' . http_build_query($_GET);
		}
		$pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
	} else {
		if($url) {
			$pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
			$pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
			$pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
			$pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
		} else {
			$_GET['page'] = $pdata['findex'];
			$pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
			$_GET['page'] = $pdata['pindex'];
			$pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
			$_GET['page'] = $pdata['nindex'];
			$pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
			$_GET['page'] = $pdata['lindex'];
			$pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
		}
	}

	$html = '<div class="pager-left">';

		$html .= "<div class=\"pager-first\"><a {$pdata['faa']} class=\"pager-nav\">首页</a></div>";
		$html .= "<div class=\"pager-pre\"><a {$pdata['paa']} class=\"pager-nav\">上一页</a></div>";
	$html .='</div><div class="pager-cen">
					' .$pindex.'/'.$pdata['tpage'].'
				</div><div class="pager-right">';

		$html .= "<div class=\"pager-next\"><a {$pdata['naa']} class=\"pager-nav\">下一页</a></div>";
		$html .= "<div class=\"pager-end\"><a {$pdata['laa']} class=\"pager-nav\">尾页</a></div>";
	
	$html .= '</div>';
	return $html;
}
class Yoby_chaModuleSite extends WeModuleSite {

	public function doMobileIndex() {
  global $_GPC, $_W;
        $openid = $_W['openid'];
        $id = intval($_GPC['id']);
        $weid = $_W['uniacid'];
$shareurl =  $this->module['config']['guanzhu'];

$pg =  intval($this->module['config']['pg']);
        $yobyurl = $_W['siteroot']."addons/yoby_cha/template/mobile/";
  if(!empty($shareurl)){
        $follow = pdo_fetchcolumn('SELECT follow FROM ' . tablename('mc_mapping_fans')."  where uniacid=".$_W['uniacid']." and openid='$openid' " );
       
      
		if(empty($follow)){header('Location:'.$shareurl);}
		}
		
 $row = pdo_fetch("SELECT * FROM " . tablename('yoby_cha_reply') . " WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $id));
$cid = intval($row['tb']);
$info = json_decode(pdo_fetchcolumn('SELECT s FROM ' . tablename('yoby_cha_table')."  where id=$cid " ),1);

	$pindex = max(1, intval($_GPC['page']));
			$psize =(empty($pg))?15:$pg;//每页面10条
			$condition = '';
			if (!empty($_GPC['keyword'])) {
			if(empty($row['is_show'])){
				$condition .= " AND title LIKE '%".$_GPC['keyword']."%'";
				}else{
				$condition .= " AND title = '".$_GPC['keyword']."'";
				}
				
				
$list = pdo_fetchall("SELECT *  FROM ".tablename('yoby_cha_data')." WHERE cid = $cid $condition ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);//分页
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data') . " WHERE cid = $cid $condition ");
			$pager = pager($total, $pindex, $psize);
			}/*else{
			$list = pdo_fetchall("SELECT *  FROM ".tablename('yoby_cha_data')." WHERE cid = $cid $condition ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);//分页
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data') . " WHERE cid = $cid $condition ");
			$pager = pager($total, $pindex, $psize);
			
			}*/
if(!is_weixin() ){die('<script type="text/javascript">alert("调皮,怎么在电脑上打开呢!");</script>');}			
include $this->template('index');

	}
public function doWebIndex() {//管理字段
			global $_W,$_GPC;
		$weid = $_W['uniacid'];
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		load()->func('tpl'); 
		if('post' == $op){//添加或修改
			$id = intval($_GPC['id']);
			if(!empty($id)){
			$item = pdo_fetch("SELECT * FROM ".tablename('yoby_cha_table')." where id=$id");
			empty($item)?message('亲,数据不存在！', '', 'error'):"";	
			}
			
			
			if(checksubmit('submit')){
				empty ($_GPC['title'])?message('亲,名称不能为空'):$title =$_GPC['title'];
        $desc = $_GPC['desc'];
				$createtime =time();
        if(!empty($_GPC['s'])){
$s = $_GPC['s'];
foreach($s as $k){
if(empty($k['title'])){message('亲,自定义字段名不能为空');}
if(empty($k['var'])){message('亲,自定义变量名不能为空');}
}
}

        $s = json_encode($_GPC['s']);//自定义字段数组
				if(empty($id)){
						pdo_insert('yoby_cha_table', array('weid'=>$weid,'title'=>$title,'desc'=>$desc,'createtime'=>$createtime,'s'=>$s));//添加数据
						message('添加成功！', $this->createWebUrl('index', array('op' => 'display')), 'success');
				}else{
          //dump($_GPC);
						pdo_update('yoby_cha_table', array('title'=>$title,'desc'=>$desc,'createtime'=>$createtime,'s'=>$s), array('id' => $id));
						message('更新成功！', $this->createWebUrl('index', array('op' => 'display')), 'success');
				}
				
				
			}else{
				include $this->template('table');
			}
			
		}else if('del' == $op){//删除
		
		
			if(isset($_GPC['delete'])){
				$ids = implode(",",$_GPC['delete']);
				$sqls = "delete from  ".tablename('yoby_cha_table')."  where id in(".$ids.")"; 
				pdo_query($sqls);
				message('删除成功！', referer(), 'success');
			}
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM ".tablename('yoby_cha_table')." WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				//dump($_GPC);
				message('抱歉，数据已经被删除！', $this->createWebUrl('index', array('op' => 'display')), 'error');
			}
			pdo_delete('yoby_cha_table', array('id' => $id));
			message('删除成功！', referer(), 'success');
			
		}else if('display' == $op){//显示
			$pindex = max(1, intval($_GPC['page']));
			$psize =20;//每页显示
			
			$list = pdo_fetchall("SELECT *  FROM ".tablename('yoby_cha_table') ." where weid=$weid  ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);//分页
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_table')."  where weid=$weid" );
			$pager = pagination($total, $pindex, $psize);
			include $this->template('table');
	}

}

public function doWebGl() {//管理被查询数据
			global $_W,$_GPC;
		$weid = $_W['uniacid'];
$cid = intval($_GPC['cid']);
$info = json_decode(pdo_fetchcolumn('SELECT s FROM ' . tablename('yoby_cha_table')."  where id=$cid " ),1);
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		load()->func('tpl'); 
		if('post' == $op){//添加或修改
			$id = intval($_GPC['id']);

			if(!empty($id)){
			$item = pdo_fetch("SELECT * FROM ".tablename('yoby_cha_data')." where id=$id");
			empty($item)?message('亲,数据不存在！', '', 'error'):"";	
			}
			
			
			if(checksubmit('submit')){
$title=$_GPC['title'];
$title0='';
foreach($info as $k4=>$v4){
if($v4['isok']==1){
    $title0.=$title[$k4]."";
}

}
				$createtime =time();

				if(empty($id)){
						pdo_insert('yoby_cha_data', array('cid'=>$cid,'title'=>$title0,'bl'=>json_encode($title)));//添加数据
						message('添加成功！', $this->createWebUrl('gl', array('op' => 'display','cid'=>$cid)), 'success');
				}else{
          //
						pdo_update('yoby_cha_data', array('cid'=>$cid,'title'=>$title0,'bl'=>json_encode($title)), array('id' => $id));
						message('更新成功！', $this->createWebUrl('gl', array('op' => 'display','cid'=>$cid)), 'success');
				}
     

				
				
			}else{
				include $this->template('gl');
			}
			
		}else if('del' == $op){//删除
		
		
			if(isset($_GPC['delete'])){
				$ids = implode(",",$_GPC['delete']);
				$sqls = "delete from  ".tablename('yoby_cha_data')."  where id in(".$ids.")"; 
				pdo_query($sqls);
				message('删除成功！', referer(), 'success');
			}
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM ".tablename('yoby_cha_data')." WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				//dump($_GPC);
				message('抱歉，数据已经被删除！', $this->createWebUrl('gl', array('op' => 'display','cid'=>$cid)), 'error');
			}
			pdo_delete('yoby_cha_data', array('id' => $id));
			message('删除成功！', referer(), 'success');
			
		}else if('display' == $op){//显示
	$condition=' ';
			if (!empty($_GPC['keyword'])) {
    
$condition .= "  and  title   LIKE '%".$_GPC['keyword']."%' ";

			}
			$pindex = max(1, intval($_GPC['page']));
			$psize =20;//每页显示
			
			$list = pdo_fetchall("SELECT *  FROM ".tablename('yoby_cha_data') ." where cid=$cid $condition ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);//分页
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data')."  where cid=$cid $condition" );
			$pager = pagination($total, $pindex, $psize);
			include $this->template('gl');
	}

}

public function doWebQ() {//清空数据
			global $_W,$_GPC;
		$weid = $_W['uniacid'];
		$cid = $_GPC['cid'];
		pdo_delete('yoby_cha_data', array('cid' => $cid));
		message('清空数据成功！', referer(), 'success');
		}
public function doWebDao() {//导入模板
			global $_W,$_GPC;
		$weid = $_W['uniacid'];
$cid = intval($_GPC['cid']);
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$data = pdo_fetch("SELECT *  FROM ".tablename('yoby_cha_table') ." WHERE id =". $cid);
$s = json_decode($data['s'],1);
if('exe'==$op){

require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';

	
		if(checksubmit('submit')){
			 $filename = $_FILES['teacherx']['name'];
			 if(empty($filename)){
				message('请上传excel文件', '', 'error');
			}
    			$tmp_name = $_FILES['teacherx']['tmp_name'];
			$ext = strtolower(pathinfo($filename,4));
			if($ext !='xls'){
				message('不是excel文件,请上传正确格式', '', 'error');
			}
			$temp = (defined('SAE_TMP_PATH'))?SAE_TMP_PATH : ATTACHMENT_ROOT;//判断是否sae,是的话就上传到临时目录
			$new = $temp."/".time().".".$ext;
			if(is_uploaded_file($tmp_name)) {
			move_uploaded_file($tmp_name,$new );
				
				 $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($new);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();           //取得总行数
        $highestColumn = $sheet->getHighestColumn(); //取得总列数
	
	for($j=2;$j<=$highestRow;$j++){
		for($k='A';$k<=$highestColumn;$k++){
		//$str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';
			$str .=mb_convert_encoding($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue(), "utf-8",'auto').'\\';
		}
		$strs = explode("\\",$str);
array_pop($strs);

$title0='';
foreach($s as $k4=>$v4){
if($v4['isok']==1){
    $title0.=$strs[$k4]."";
}

}


		$data = array(
		'cid'=>$cid,
		'title'=>$title0,
    'bl'=>json_encode($strs)
		);
		pdo_insert('yoby_cha_data',$data);
$str = "";
	}		
		unlink($new);
		message('导入成功！', $this->createWebUrl('gl', array('op' => 'display','cid'=>$cid)), 'success');		
			}
		}else{
			message('没有上传excel！', '', 'error');
		}














}else{
include $this->template('dao');
}
}

public function doWebDaochu() {//导出模板
			global $_W,$_GPC;
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';
		$weid = $_W['uniacid'];
$cid = intval($_GPC['cid']);

$data = pdo_fetch("SELECT *  FROM ".tablename('yoby_cha_table') ." WHERE id =". $cid);
$s = json_decode($data['s'],1);
		$resultPHPExcel = new PHPExcel(); 
$i =1;
$arr =  range('A','Z');

foreach($s as $k=>$v){
$resultPHPExcel->getActiveSheet()->setCellValue($arr[$k] . $i, $v['title']); 
 
}


$obj_Writer = PHPExcel_IOFactory::createWriter($resultPHPExcel,'Excel5');
        $filename = date('Y-m-d',time()).$data['title'].".xls";
        
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); 
        header('Content-Disposition:inline;filename="'.$filename.'"'); 
        header("Content-Transfer-Encoding: binary"); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Pragma: no-cache"); 
        
        $objProps = $resultPHPExcel->getProperties();
        $objProps->setCreator("by-yoby"); 
        $obj_Writer->save('php://output'); 




}

public function doWebChu() {//导出模板
			global $_W,$_GPC;
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
		require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';
		$weid = $_W['uniacid'];
$cid = intval($_GPC['cid']);

$data = pdo_fetch("SELECT *  FROM ".tablename('yoby_cha_table') ." WHERE id =". $cid);
$s = json_decode($data['s'],1);
		$resultPHPExcel = new PHPExcel(); 
$ii =1;
$arr =  range('A','Z');

foreach($s as $k=>$v){
$resultPHPExcel->getActiveSheet()->setCellValue($arr[$k] . $ii, $v['title']); 

}
$data1 = pdo_fetchall("SELECT bl  FROM ".tablename('yoby_cha_data') ." WHERE cid =". $cid);

$i = 2; 
foreach($data1 as $ks=>$item){ 
$bl = json_decode($item['bl'],1);
foreach($bl as $k2=>$a2){
$resultPHPExcel->getActiveSheet()->setCellValue($arr[$k2] . $i, $a2);

}
$i++;
}


$obj_Writer = PHPExcel_IOFactory::createWriter($resultPHPExcel,'Excel5');
        $filename = date('Y-m-d',time()).$data['title'].".xls";
        
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); 
        header('Content-Disposition:inline;filename="'.$filename.'"'); 
        header("Content-Transfer-Encoding: binary"); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Pragma: no-cache"); 
        
        $objProps = $resultPHPExcel->getProperties();
        $objProps->setCreator("by-yoby"); 
        $obj_Writer->save('php://output'); 




}

}