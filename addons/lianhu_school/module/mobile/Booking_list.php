<?php 
    if($ac=='image'){
        $this->class_base->createValidateCode();
    }
    $id                 = $_GPC['id'];
    $class_booking      = D('booking');
    $class_bookingList  = D('bookingList');
    $cclass_bookingList = C('bookingList');
    $cclass_bookingList->bookind_id = $id;
    $info               = $class_booking->dataEdit($id);
    if(!$info){
        $this->myMessage("没有找到该活动",$this->createMobileUrl("booking",array('school_id'=>$_GPC['school_id'])),'错误');
    }
    $page_title = $info['booking_title'];
    $result     = $cclass_bookingList->getBooKingPeopleList();
    $list       = $result['list'];
    $uid        = getMemberUid();
    $last_record= C("bookingList")->getUserLastRecord($uid);
    if(time()-$last_record['add_time'] < 5*60){
        $this->myMessage("您五分钟内有过报名，无法再报名！",$this->createMobileUrl("booking"),"错误");
    }
    if($_GPC['submit']){
        if($_GPC['input_code'] != $_COOKIE['form_code'] && $info['ask_vacode']){
            $this->myMessage("验证码错误",$this->createMobileUrl("booking"),"错误");
        }
        if($info['ask_phone'] && !$_GPC['list_phone']){
            $this->myMessage("请填写你的手机信息",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }
        if($info['ask_name'] && !$_GPC['list_name']){
            $this->myMessage("姓名未填写",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }
        if($info['ask_id'] && !$_GPC['list_people_id']){
            $this->myMessage("请填写身份证号",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }elseif($info['ask_id']){
            $result = C("bookingList")->getLastById($_GPC['list_people_id']);
            if($result){
                $this->myMessage("此学生身份证号已经参与过预报名！",$this->createMobileUrl("booking"),"错误");
            }
        }
        if($info['ask_parent_id'] && !$_GPC['list_parent_id']){
            $this->myMessage("请填写家长身份证号",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }            
        if($info['list_sex'] && !$_GPC['ask_sex']){
            $this->myMessage("性别未选择",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }  
        if($info['ask_address'] && !$_GPC['list_address']){
            $this->myMessage("请填写家庭住址",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }
        if($info['ask_huji'] && !$_GPC['list_huji']){
            $this->myMessage("请填写户籍",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }    
        if($info['ask_old_school'] && !$_GPC['list_old_school']){
            $this->myMessage("请填写原学校",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }
        if($info['ask_time'] && !$_GPC['list_time']){
            $this->myMessage("请填写预约时间",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        } 

        if($info['ask_localphone'] && !$_GPC['localphone']){
            $this->myMessage("请填写固定电话",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        } 
        if($info['ask_nation'] && !$_GPC['nation']){
            $this->myMessage("请填写学生民族",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        } 

        if($info['ask_birthday'] && !$_GPC['birthday']){
            $this->myMessage("请填写出生年月",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
        }
        //检测入学年级
        if($_GPC['birthday']){
            $unix_time = strtotime($_GPC['birthday']);
            $year      = date("Y",$unix_time);
            if($year>$info['birth_end_time'] || $year<$info['birth_begin_time']){
                $this->myMessage("抱歉孩子未出生在可报名的年份内",$this->createMobileUrl("book_list",array('id'=>$_GPC['id'],'school_id'=>$_GPC['school_id'])),'错误');
            }
        }
        if($_GPC['list_time']){
            $_GPC['list_time'] = strtotime($_GPC['list_time']);
        }  
        $img_arrs	= $_POST['img_value'];
        if($img_arrs){
                foreach ($img_arrs as $key => $value) {
                    $img = $this->getWechatMedia($value);
                    if($img){
                        $img_in[]= $img;
                    }else{
                        $img_in[]= $up_file_name; 
                    }
                }
        }   
        $_GPC['list_imgs']  = json_encode($img_in);
        $_GPC['uid']        = getMemberUid();
        $_GPC['booking_id'] = $id;
        $in                 = getNewUpdateData($_GPC,$class_bookingList);
        $class_bookingList->dataAdd($in);
        $this->myMessage("预报名成功，请等待审核通知!",$this->createMobileUrl("booking",array('school_id'=>$_GPC['school_id'])),'成功');
    }
    