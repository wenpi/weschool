<?php 
defined('IN_IA') or exit('Access Denied');
$op=$_GPC['op'];
$hash_add_str='asdas;#sdf';
require(IA_ROOT.'/framework/library/qrcode/phpqrcode.php');

if($op=='student_live_student'){
    $id=$_GPC['id'];
    $student_re=pdo_fetch("select * from {$table_pe}lianhu_student where  student_id=:id ",array(':id'=>$id));
    $hash_str=sha1(md5($student_re['class_id'].$student_re['grade_id'].$student_re['xuhao'].$hash_add_str));
    $url=$this->createMobileUrl('studentlLive',array('hash'=>$hash_str,'sid'=>$id));
    $base_dir=$this->insertDir();
    $file_name=$base_dir.time().rand(111111,999999).'.png';
    
    if($_GPC['print_code']==1)
        echo QRcode::png($_W['siteroot'].'app/'.$url,false,'',10,2);
    else{
    	echo QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);

        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        echo "<img src='{$_W['siteroot']}/attachment/{$up_file_name}' >";
    }
}
exit();