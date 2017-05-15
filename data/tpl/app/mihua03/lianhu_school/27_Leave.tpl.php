<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>请假申请-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/mobiscroll.custom-2.5.0.min.css">
    <script src="<?php echo MODULE_URL;?>style/js/mobiscroll.custom-2.5.0.min.js"></script>       
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<style>
	.form-signin input{
        width: 100%;
        margin: 0 1.5% 5px 1%;
    }
	</style>
</head>

<body <?php  if($op=='get') { ?> style='min-height:100%;background-color:rgba(0,0,0,0.2);' <?php  } ?>>
<div class="nav">
			<a  href="<?php  echo $this->createMobileUrl('leave');?>" 
                <?php  if($op=='list') { ?> class='active' <?php  } ?> 
                style="width:49%">请假申请</a>
			<a  href="<?php  echo $this->createMobileUrl('leave',array('op'=>'get'));?>" 
                <?php  if($op=='get') { ?> class='active' <?php  } ?> 
                style="width:50%" >请假记录</a>	
 </div>
     <div class="container"<?php  if($op=='get') { ?> style='margin-top:20px; <?php  } else { ?> style='margin-top:30px;<?php  } ?>'>
    <?php  if($op=='list') { ?>
      <form class="form-signin" action=" " method="POST">
        <label for="inputMobile" >请假时间</label>
            <input type="text" id="scroller" name='time_date_begin' class="form-control" placeholder="开始日期:零点"  required >
            至 <input type="text" id="scroller2" name='time_date_end' class="form-control" placeholder="结束日期:零点"  required >
        <br>
        <label for="inputPassword" >请假事由</label>
        <textarea class='form-control' name='leave_reason' rows=5> </textarea>
        <br>
        <input type='hidden' value='1' name='submit' >
        <button class="button button-royal  form-button" type="submit" style='margin:10px 2%;'  ><i class="fa fa-user"></i>&nbsp;&nbsp;提交</button>
      </form>
   <script>
  	    $(function(){
	        $("#scroller").mobiscroll().date();
	        $("#scroller2").mobiscroll().date();
			var currYear = (new Date()).getFullYear();  
	      	//初始化日期控件
			var opt = {
				preset: 'date', //日期，可选：date\datetime\time\tree_list\image_text\select
				theme: 'default', //皮肤样式，可选：default\android\android-ics light\android-ics\ios\jqm\sense-ui\wp light\wp
				display: 'modal', //显示方式 ，可选：modal\inline\bubble\top\bottom
				mode: 'scroller', //日期选择模式，可选：scroller\clickpick\mixed
				lang:'zh',
				dateFormat: 'yy-mm-dd', // 日期格式
				setText: '确定', //确认按钮名称
				cancelText: '取消',//取消按钮名籍我
				dateOrder: 'yyyymmdd', //面板中日期排列格式
				dayText: '日', monthText: '月', yearText: '年', //面板中年月日文字
				showNow: false,  
           		nowText: "今",  
            	startYear:currYear, //开始年份  
            	endYear:currYear + 100 //结束年份  
			};
			$("#scroller").mobiscroll(opt);
			$("#scroller2").mobiscroll(opt);
	    });    
  </script> 
    <?php  } ?>
    <?php  if($op=='get') { ?>
        <ul style='padding-left:0px;'>
         <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li style="padding-left:0px;width:100%;height:50px;margin-bottom:5px;border-radius:5px;background-color:#fff;">
                 <div style="width:70%;float:left;height:45px;margin-top:5px;">
                     <span style="display:inline-block;margin-left:5px;height:20px;line-height:20px;overflow:hidden;width:100%"><?php  echo $row['leave_reason'];?></span>
                     <span style="position:absolute;left:30px;font-size:0.9em" class='red'><?php  echo date("Y-m-d",$row['time_date_begin'])?>--<?php  echo date("Y-m-d",$row['time_date_end'])?></span></div>
                 <div style='width:20%;float:left;margin-left:5%;height:50px;line-height:50px;font-weight:700;'>
                  <?php  if($row['leave_status'] ==1) { ?>申请中 <?php  } else if($row['leave_status'] ==2) { ?><span style='color:green' onclick="alert('<?php  echo $row['teacher_text'];?>')" > 允许</span><?php  } else { ?> <span class='red' onclick="alert('<?php  echo $row['teacher_text'];?>')" >不允许</span><?php  } ?>
                 </div>
            </li>
         <?php  } } ?>
         </ul>
    <?php  } ?>
    </div>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>