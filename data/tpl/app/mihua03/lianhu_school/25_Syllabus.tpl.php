<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>课程表-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<!-- <div class="top-wrap">
        <div class="fn-clear tr-box top">
            <div class='text_center'>班级课程表</div>
        </div>
  </div>   --> 
  <div id="accordion-305683" class="accordion" style='margin-bottom:60px'>
        <?php  $g=1;?>
        <?php  if(is_array($loop)) { foreach($loop as $row) { ?>
        <?php  if($g >$old_result['on_school']) { ?><?php  break;?><?php  } ?>
             <?php  if($begin_course ) { ?>
                   <?php  $begin_week=$begin_course+$g-1;?>
             <?php  } else { ?>
                   <?php  $begin_week=$g;?>
             <?php  } ?>
                <div class="accordion-heading" <?php  if($g%2==0) { ?> style='background-color:#00ADFF'<?php  } ?>>
                        <a class="accordion-toggle collapsed"  href="#accordion-element-<?php  echo $g;?>" data-parent="#accordion-<?php  echo $g;?><?php  echo $g;?>" data-toggle="collapse">星期<?php  echo $begin_week;?></a>
                </div>      
            <div class="accordion-group">
            <div id="accordion-element-<?php  echo $g;?>" class="accordion-body collapse" style="height: 0px;">
            <div class="accordion-inner" >
            <table border="1"  bordercolor="#ccc" cellpadding="5" 
                    cellspacing="0" class="table table-bordered" 
                    height="220" style="border-collapse:collapse;width:100%">
                <thead>
                    <tr>
                        <th style='text-align:center'>节数</th>
                        <th style='text-align:center'>时间</th>
                        <th style='text-align:center'>课程</th>
                        <th style='text-align:center'>老师</th>
                    </tr>
                </thead>
                <tbody>
                                <?php  if($old_result['am_much']>0) { ?>
                                    <?php  $i_am=0;?>
                                    <?php  if(is_array($data['am'][$g])) { foreach($data['am'][$g] as $row) { ?>
                                    <?php  $i_am++;?>
                                        <tr>
                                            <td>第<?php  echo $i_am;?>节</td>
                                            <td><?php  echo $time_result['begin_time'][$i_am];?>--<?php  echo $time_result['end_time'][$i_am];?></td>
                                            <td><?php  echo $row;?></td>
                                           <td><?php  if($data['teacher_am'][$g][$i_am]) { ?><?php  echo $this->teacherName($data['teacher_am'][$g][$i_am]);?><?php  } else { ?>no<?php  } ?></td>
                                        </tr>                         
                                    <?php  } } ?>
                                <?php  } ?> 
                                
                            <?php  if($old_result['pm_much']>0) { ?>
                                    <?php  $i_pm=0;?>
                                    <?php  if(is_array($data['pm'][$g])) { foreach($data['pm'][$g] as $row) { ?>
                                    <?php  $i_pm++;?>
                                        <tr class="warning">
                                            <?php  $hj= $i_pm+$i_am?>
                                            <td>第<?php  echo $hj;?>节</td>
                                            <td><?php  echo $time_result['begin_time'][$hj];?>--<?php  echo $time_result['end_time'][$hj];?></td>
                                            <td><?php  echo $row;?></td>
                                            <td><?php  if($data['teacher_pm'][$g][$i_pm]) { ?><?php  echo $this->teacherName($data['teacher_pm'][$g][$i_pm]);?><?php  } else { ?>no<?php  } ?></td>
                                        </tr>                         
                                    <?php  } } ?>
                                <?php  } ?>  
                                
                             <?php  if($old_result['ye_much']>0) { ?>
                                    <?php  $i=0;?>
                                    <?php  if(is_array($data['ye'][$g])) { foreach($data['ye'][$g] as $row) { ?>
                                    <?php  $i++;?>
                                        <tr class="info">
                                            <?php  $hjj=$i+$i_pm+$i_am?>
                                            <td>第<?php  echo $hjj;?>节</td>
                                            <td><?php  echo $time_result['begin_time'][$hjj];?>--<?php  echo $time_result['end_time'][$hjj];?></td>
                                            <td><?php  echo $row;?></td>
                                            <td><?php  if($data['teacher_ye'][$g][$i]) { ?><?php  echo $this->teacherName($data['teacher_ye'][$g][$i]);?><?php  } else { ?>no<?php  } ?></td>
                                        </tr>                         
                                    <?php  } } ?>
                                <?php  } ?>                      
                        </tbody>
                    </table>
                 </div>
                        </div>             
                        </div>
                        <?php  $g++?>
        <?php  } } ?>
        </div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>

