<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
    <head>
    <meta charset='utf-8'>
    <title>统一打印离校二维码</title>
        </head>
    <body>
        <ul>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li>
            
                姓名：<?php  echo $row['student_name'];?><br>
                <img src="<?php  echo $this->createWebUrl('qrcode', array('id' => $row['student_id'], 'op' => 'student_live_student' ,'print_code'=>1))?>" wdith='200'>
              </li>
            <?php  } } ?>
            </ul>
    </body>
    </html>