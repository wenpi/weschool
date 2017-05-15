<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '签到活动详情';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css?<?php  echo time()?>">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/framework.js"></script>
<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;background-color:#fff;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
            <div class="teaqd_head">
                <span><?php  echo $result['activity_name'];?></span>
                <a href="<?php  echo $this->createMobileUrl("TeaqdInfo",array("id"=>$result['activity_id']))?>" style='color:#18b4ed'> <i class=" fa fa-refresh"></i>刷新</a>
            </div>

            <div class="w-tab-content tabs-content" style="background-color:#fff;">
                <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                        <div class="weui_panel weui_panel_access" >
                            <div>
                                <div class="shintext">
                                     应到：<?php  echo $allcount;?>人
                                </div>
                                <?php  $re =$scan_re['count']/$allcount*100?>
                                <span class="shin"></span>
                                <span class="hain" style="width: <?php  echo $re;?>%;"></span>
                                <div class="haintext" style="margin-left: <?php  if($re>90) { ?>90<?php  } else { ?><?php  echo $re;?><?php  } ?>%;">
                                    签到：<?php  echo $scan_re['count'];?>人
                                </div>
                            </div>
                        </div>
                        <?php  if(is_array($class_ids)) { foreach($class_ids as $row) { ?>
                                    <div class="weui_panel weui_panel_access"  style="border-top: 0px;">
                                            班级：<?php  echo $class_listre[$row]['info']['class_name'];?>
                                            <div>
                                                <div class="shintext">
                                                    应到：<?php  echo $class_listre[$row]['all'];?>人
                                                </div>
                                                <?php  $re =$class_listre[$row]['scan']/$class_listre[$row]['all']*100?>
                                                <span class="shin"></span>
                                                <span class="hain" style="top:50px;width: <?php  echo $re;?>%;"></span>
                                                <div class="haintext" style="margin-left: <?php  if($re>90) { ?>90<?php  } else { ?><?php  echo $re;?><?php  } ?>%;">
                                                    签到：<?php  echo $class_listre[$row]['scan'];?>人
                                                </div>
                                            </div>
                                            <ul>
                                                <?php  if(is_array($class_listre[$row]['student'])) { foreach($class_listre[$row]['student'] as $val) { ?>
                                                    <?php  $re= D("qdPerson")->edit(array("class_id"=>$row,'student_id'=>$val['student_id'])); ?>
                                                    <li <?php  if($re ) { ?> class='studenthavein' <?php  } ?>><?php  echo $val['student_name'];?></li>
                                                <?php  } } ?>
                                                <div style="clear:both"></div>
                                            </ul>   
                                        </div>
                     
                        <?php  } } ?>
                </div>
		    </div>
	    </div>
        <div class='end_text' id='end_text'></div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>