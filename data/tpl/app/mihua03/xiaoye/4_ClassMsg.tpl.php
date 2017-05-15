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
    <div class="head">
        <?php  $width = 100/count($line_types);?>
        <?php  if(is_array($line_types)) { foreach($line_types as $row) { ?>
                <a href="<?php  echo $this->createMobileUrl('classMsg',array('op'=>$row));?>" style="width:<?php  echo $width;?>% !important" <?php  if($op == $row) { ?>class="pp"<?php  } ?>  ><p> <?php  echo $row;?></p></a>
        <?php  } } ?>
    </div>
    <div class="MD" id='list'>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/ClassMsg_content', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/ClassMsg_content', TEMPLATE_INCLUDEPATH));?>
    </div>
    <?php  if($list) { ?>
          <h1 id='add_msg' style="text-align:center;color:#333;font-size:1em;margin-top:10px;">...</h1>  
    <?php  } else { ?>
          <h1 id='add_msg' style="text-align:center;color:#333;font-size:1em;margin-top:10px;">暂无信息</h1>  
    <?php  } ?>
</div>
   <script>
        var pager    = 1;
        var send_id  = '';
        var content  = '';    
        $(function(){
            $(window).scroll(function(){
                if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                    if(pager==0){
                        return false;
                    }
                    pager++;       
                    $.ajax({
                        url:'<?php  echo $this->createMobileUrl('classMsg')?>',
                        type:'post',
                        data:{page:pager,op:'<?php  echo $op;?>',ac:'ajax'},
                        dataType:'text',
                        async:'false',
                        success:function(html){
                                if(html =='all' ){
                                    $("#add_msg").html("已经全部查看！");
                                    pager = 0;
                                }else{
                                    $('#list').append(html);   
                                }
                            }
                    });
                }
            });
        });
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>