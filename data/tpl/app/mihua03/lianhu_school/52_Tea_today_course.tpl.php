<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>我的课程-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<style>
	.accordion-heading img {
    padding: 0;
    width: 15px;
    height: 15px;
    float: right;
    margin: 10px 10px 5px 0;
}
	</style>
</head>
<body>
 <div class="top-wrap">
        <div class="fn-clear tr-box top">
            <div class='text_center'>今日课程</div>
        </div>
  </div>    
  <div id="accordion-305683" class="accordion" style='margin-bottom:60px'>
      <?php  if(is_array($list)) { foreach($list as $g => $row) { ?>
            <?php  $old_result = D('classes')->classSyllabus($row['class_id']); ?>
            <div class="accordion-heading" >
                <?php  if($old_result['url'] ) { ?>
                         <a class="accordion-toggle collapsed"  href="<?php  echo $old_result['url'];?>" ><?php  echo $this->classGradeName($row['class_id'])?>-<?php  echo $row['name'];?></a> 
                <?php  } else { ?>
                         <a class="accordion-toggle collapsed"  href="#accordion-element-<?php  echo $g;?>" data-parent="#accordion-<?php  echo $g;?><?php  echo $g;?>" data-toggle="collapse"><?php  echo $this->classGradeName($row['class_id'])?>-<?php  echo $row['name'];?>
						        <img src="<?php echo MODULE_URL;?>template/mobile/style/bottom_blue.png" />
						</a>               
                <?php  } ?>
            </div>      
            <div class="accordion-group">
            <div id="accordion-element-<?php  echo $g;?>" class="accordion-body collapse" style="height: 0px;">
            <div  >
            <table border="1"  bordercolor="#ccc" cellpadding="5" 
                    cellspacing="0" class="table table-bordered" 
                    height="220" style="border-collapse:collapse;width:100%">
                <thead>
                    <tr>
                        <th style='text-align:center'>课程</th>
                        <th style='text-align:center'>上课时间</th>
                        <th style='text-align:center'>结束时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($row['course'])) { foreach($row['course'] as $v) { ?>
                    <?php  if($v) { ?>
                        <?php  if(is_array($v)) { foreach($v as $rw) { ?>
                          <tr>
                              <td><?php  echo $rw['course_name'];?></td>
                              <td><?php  echo $rw['begin_time'];?></td>
                              <td><?php  echo $rw['end_time'];?></td>
                         </tr>      
                         <?php  } } ?>               
                    <?php  } ?>
                    <?php  } } ?>
                        </tbody>
                    </table>
                 </div>
            </div>             
      </div>
      <?php  } } ?>
     </div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
