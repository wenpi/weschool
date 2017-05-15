<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>统一打印绑定二维码</title>
        <link href="<?php echo MODULE_URL;?>admin/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <ul>
            <?php  if($module=='Student') { ?>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="print_list_code">
                
                    姓名：<?php  echo $row['student_name'];?><br>
                    <img  src="<?php  echo $this->createWebUrl('qrcode', array('id' => $row['student_id'], 'op' => 'student_bd_student' ,'print_code'=>1))?>" wdith='100'>
                </li>
                <?php  } } ?>            
            <?php  } else if($module=='Teacher') { ?>
                  <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="print_list_code">
                
                    教师姓名：<?php  echo $row['teacher_realname'];?><br>
                    <img  src="<?php  echo $this->createWebUrl('qrcode', array('id' => $row['teacher_id'], 'op' => 'teacher_bd_qr' ,'print_code'=>1))?>" wdith='100'>
                </li>
                <?php  } } ?>            
            <?php  } ?>
            </ul>
    </body>
    </html>