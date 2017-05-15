<?php 
    $this->checkAdminWeb();
    require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_msg';
    $left_nav     = 'booking';
    $title        = '校外活动报名';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'校务管理'),
            array('fun_str'=>'booking','fun_name'=>'校外报名'),
    );
    $top_action = array(
            array('action_name'=>'活动列表','action'=>'booking' ),
    );
    $cclass_bookinglist = C('bookingList');
    $class_bookinglist  = D('bookingList');
    $class_booking      = D('booking');
    if($ac == 'list' && $_GPC['id']){
        $we7_js = 'no';
        $booking_re = $class_booking->dataEdit($_GPC['id']);
        $cclass_bookinglist->booking_id = $_GPC['id'];
        $result     = $cclass_bookinglist->getBooKingPeopleList();
        $count      = $result['count'];
        $list       = $result['list'];
        foreach ($list as $key => $value) {
            $list[$key]['nickname'] = $this->class_base->mobileGetNicknameByUid($value['uid']);
        }
        if($_GPC['out']=='excel'){
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '微信昵称')
                        ->setCellValue('B1', '报名时间')
                        ->setCellValue("C1",'内容')
                        ->setCellValue("D1",'报名人')
                        ->setCellValue("E1",'学生姓名')
                        ->setCellValue("F1",'性别')
                        ->setCellValue("G1",'户籍')
                        ->setCellValue("H1",'地址')
                        ->setCellValue("I1",'是否住校')
                        ->setCellValue("J1",'预约时间')
                        ->setCellValue("K1",'电话')
                        ->setCellValue("L1",'身份证')
                        ->setCellValue("M1",'回复时间')
                        ->setCellValue("N1",'回复内容');
            $i=2;
            foreach ($list as $kv=> $v) {
                if($v['list_sex']==1){
                    $sex = '男';
                }elseif($v['list_sex']==2){
                    $sex = '女';
                }else{
                    $sex = '';
                }
                if($v['list_live']==1){
                    $live = '住';
                }elseif($v['list_live']==2){
                    $live = '不住';
                }else{
                    $live = '';
                }
                if($v['list_time']){
                    $time = date("Y-m-d H:i:s",$v['list_time']);
                }else{
                    $time = '';
                }
                if($v['re_time']){
                    $re_time = date("Y-m-d H:i:s",$v['re_time']);
                }else{
                    $re_time = '';
                }
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $v['nickname'])
                ->setCellValue('B' . $i, date("Y-m-d H:i:s",$v['add_time']))
                ->setCellValue('C' . $i, $v['list_content'])
                ->setCellValue('D' . $i, $v['list_name'])
                ->setCellValue('E' . $i, $v['my_name'])
                ->setCellValue('F' . $i, $sex)
                ->setCellValue('G' . $i, $v['list_huji'])
                ->setCellValue('H' . $i, $v['list_address'])
                ->setCellValue('I' . $i, $live)
                ->setCellValue('J' . $i, $time)
                ->setCellValue('K' . $i, $v['list_phone'])
                ->setCellValue('L' . $i, $v['list_people_id'])
                ->setCellValue('M' . $i, $re_time)
                ->setCellValue('N' . $i, $v['re_content']);
                $i++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setTitle('报名列表');		
            $objPHPExcel->setActiveSheetIndex(0);
            $base_name = "booking_list".time().'.xlsx';
            $file_name = MODULE_ROOT.'/file/'.$base_name;
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($file_name);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$base_name.'"');
            header('Cache-Control: max-age=0');
            readfile($file_name);
            exit;
        }
        if($_GPC['have'] && $_GPC['content']){
            //后台处理
            $up['re_time']      = time();
            $up['re_content']   = $_GPC['content'];
            $up["pass_status"]  = $_GPC['pass_status'];
            foreach ($_GPC['have'] as  $value) {
                $result  = $class_bookinglist->dataEdit($value,$up);
                //发送通知
                $title   = "您的报名申请校方审核了！";
                $key2    = $admin_result['info']['admin_name'] ? $admin_result['info']['admin_name'] :"管理员";
                $key4    = $_GPC['pass_status']==1 ? "审核通过":"未通过";
                $remark  = $_GPC['content'];
                $mu_info = $this->decodeMsg($title,$key2,$key4,$remark); 
                $openid  = $this->class_base->uid2openid($result['uid']);
                $record_url = $_W['siteroot'].'app/'.$this->createMobileUrl("booking",array("school_id"=>getSchoolId()) );
                $que_num    = D('msg')->insertMsgQueueMu($openid,$mu_info['data'],$mu_info['mu_id'],$record_url,$que_num);
            }
            $this->myMessage("回复成功",$this->createWebUrl('booking_list',array("id"=>$_GPC['id'])),'成功');
        }
    }
    if($ac=='delete'){
        $booking_re = $class_booking->dataEdit($_GPC['id']);
        $where["list_id"] = $_GPC['id'];
        D("bookingList")->delete($where);
        $this->myMessage("删除成功",$this->createWebUrl('booking_list',array("id"=>$booking_re['booking_id'])),'成功');
    }
    include $this->template('../admin/booking_list');
    exit();