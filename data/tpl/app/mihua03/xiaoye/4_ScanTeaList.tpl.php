<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
		<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
	</head>
<body>

<div class="z_main">
    <div class="MD" id='list'>
          <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="dpl">
                    <div class="WZ" >
                         <p style="width: 100%">
                            <span class="just_list"><?php  echo $row['info']['activity_name'];?></span>
                            <span class="just_list address">(<?php  echo $row['info']['activity_address'];?>)</span>
                            <span class="just_list  address time"><b style="color:#ff0033">活动时间：</b><?php  echo date("Y-m-d H:i:s",$row['info']['add_time'])?></span>
                            <span class="just_list  address time"><b style="color:#ff0033">签到时间：</b><?php  echo date("Y-m-d H:i:s",$row['add_time'])?></span>
                        </p>
                    </div>
                    <div style="clear:both"></div>
                </li>
            <?php  } } ?> 
    </div>
    <?php  if(!$list) { ?>
          <h1 id='add_msg' style="text-align:center;color:#333;font-size:1em;margin-top:10px;">暂无信息</h1>  
    <?php  } ?>
<style>
    .just_list{
        display: inline-block;
        width: 100%;
        text-align: left;
        text-indent: 10px;
        font-size: 1em;
        color:#333;
        line-height: 30px;
    }
    .WZ{
        width: 100%;
    }
    .dpl{
        height: 100% !important;
    }
    .address{
        color:#888;
        font-size: 0.8em;
    }

</style>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>