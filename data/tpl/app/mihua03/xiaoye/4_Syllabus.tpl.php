<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main">
 <div class="head-kc">
     <?php  $count = count($out_weeks);?>
        <?php  if(is_array($out_weeks)) { foreach($out_weeks as $row) { ?>
                <a style="width:<?php  echo 100/$count?>%" href="<?php  echo $this->createMobileUrl('syllabus',array("week"=>$row) )?>" <?php  if($now_week == $row) { ?> class="pp" <?php  } ?>><p>周<?php  echo $cclass_week->weeks[$row];?></p></a>
        <?php  } } ?>
 </div>
<?php  if(is_array($ams)) { foreach($ams as $row) { ?>
    <div class="KC">
        <li>
        <p>第<?php  echo $row['sort'];?>节<br />
            <span><?php  echo $row['times'];?></span></p>
        </li>
        <div class="KR">
        <p><?php  echo $row['course'];?>（<?php  echo $row['teacher'];?>）</p>
        </div>
    </div>
<?php  } } ?>
<div class="WXX">
	<p class="WXX-1">午休</p>
    <p class="WXX-2"></p>
</div>
<?php  if(is_array($pms)) { foreach($pms as $row) { ?>
    <div class="KC">
        <li>
        <p>第<?php  echo $row['sort'];?>节<br />
            <span><?php  echo $row['times'];?></span></p>
        </li>
        <div class="KR">
        <p><?php  echo $row['course'];?>（<?php  echo $row['teacher'];?>）</p>
        </div>
    </div>
<?php  } } ?>

</div>
<?php  $footer_type = 'center';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
