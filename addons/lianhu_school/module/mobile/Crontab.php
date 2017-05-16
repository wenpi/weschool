<?php 
    //教师第二条上课提醒
    $now_time = date("His",time());
    if($now_time >"190000" && $now_time< "190025" ){
        $lado_time    = cache_load("lado_time");
        if($lado_time == date("Y-m-d",time()).'2' && $_GET['come_from'] != 'myself'   ){
          return false;  
        }
        if($_GET['come_from'] != 'myself'  ){
            $uniacid_list = C("cron")->getUseUniacidList();
            if($uniacid_list){
                foreach ($uniacid_list as $key => $value) {
                    if($value != $_W['uniacid']){
                        $url  = $_W['siteroot'].'app/index.php?i='.$value.'&c=entry&do=crontab&m=lianhu_school&come_from=myself'; 
                        $r    = $this->http_get($url);
                    }
                }
            }
            echo 'in';
            D('cron')->add();
            cache_write("lado_time",date("Y-m-d",time()).'2' );
        }
        C("cron")->doSendToTeacher($this);
        return false;
    }
    
    if($_GET['come_from'] != 'myself'){
        $uniacid_list = C("cron")->mainRecord();
        if($uniacid_list){
            foreach ($uniacid_list as $key => $value) {
                if($value != $_W['uniacid']){
                    $url  = $_W['siteroot'].'app/index.php?i='.$value.'&c=entry&do=crontab&m=lianhu_school&come_from=myself'; 
                    $r    = $this->http_get($url);
                }
            }
        }
        echo 'in';
        D('cron')->add();
    }
    //以下只处理本公众号
    C("cron")->sendMsgQueue($this);
    //检测自己接入的机器
    $class_doAction = Au("jiacard/doAction");
    if($class_doAction){
        $class_doAction->send();
    }
    //检测电子学生证
    $class_doAction = Au("studentCard/rfidRead");
    if($class_doAction){
        $class_doAction->actionDo();//学生证考勤
        Au("studentCard/battery")->doAction();//学生证电量
    }
    C("cardRecord")->class_base = $this->class_base;
    C("cardRecord")->cardSendToTeacher();
    //优化表
    if($_GET['come_from'] != 'myself'){
         C("tableUp")->doAction();
    }
