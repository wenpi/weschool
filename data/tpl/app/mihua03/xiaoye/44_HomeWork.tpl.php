<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
        <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
        <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/audioplayer.js"></script>
</head>  
<body>
    <div class="z_main" id='list'>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/HomeWork_ajax', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/HomeWork_ajax', TEMPLATE_INCLUDEPATH));?>
    </div>
    <h1 id='add_msg' style="text-align:center;color:#333;font-size:1em;margin-top:10px;">...</h1>  
<script>
    var pager=1;
    $(function(){
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                pager++;                     
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('homeWork')?>',
                type:'post',
                data:{page:pager,ac:'ajax'},
                dataType:'html',
                success:function(html){
                        if(html=='yes'){
                            $("#add_msg").html('没有啦');
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
