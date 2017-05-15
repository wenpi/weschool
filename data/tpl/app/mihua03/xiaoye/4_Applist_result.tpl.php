<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
     <div class="head-yy">
        <a href="<?php  echo $this->createMobileUrl('applist')?>"><p>预约活动</p></a>
        <a href="<?php  echo $this->createMobileUrl('applist_result')?>"  class="pp"><p>预约结果</p></a>
    </div>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <div class="yy">
                <div class="yy-top">
                    <div class="yy-t-l">
                        <?php  if($row['status']==0) { ?>
                            <img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/pass.png">
                        <?php  } else if($row['status']==2) { ?>
                            <img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/nopass.png">
                        <?php  } ?>
                        <p style="width: 70%"><?php  echo date("Y-m-d H:i:s",$row['addtime']);?> </p>
                        </div>
                        <div class="yy-t-r">
                            <p2></p2>
                        </div>
                </div>
                    <div class="yy-m">
                        <a href=""><p>
                            课程：<?php  $row['my_course'] =  str_replace("a","A" ,$row['my_course'])?> 
                                 <?php  echo  str_replace("b","B", $row['my_course'])?>
                            <?php  if($row['reason']) { ?>
                                <br>理由：<?php  echo $row['reason'];?>
                            <?php  } ?>
                        </p></a>
                    </div>
                <div class="yy-b">
                    <p2></p2>
                </div>
                <div class="y-t"></div>
            </div>
    <?php  } } ?>    
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>