<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  echo $result['teacher_realname'];?>-教学中心-<?php  echo $_SESSION['school_name'];?></title>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <script src="<?php echo MODULE_URL;?>style/js/city-picker.min.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/jquery-weui.min.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/swiper.min.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/router.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/jquery-weui.min.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/weui.min.css">    
    
    <script src="<?php echo MODULE_URL;?>/style/teacher/bositang.js" type="text/javascript"></script>
	<link href="<?php echo MODULE_URL;?>/style/teacher/style.css" type="text/css" rel="stylesheet" />  
	<link href="<?php echo MODULE_URL;?>template/mobile/style/user.min.css" rel="stylesheet" type="text/css" />
	<style>
     .button-box {
        border-radius:50px; 
    }
    .button-wx, .button-action-flat {
        background-color: #3eb135;
        border-color:#3eb135;
        color: #FFF;
    }
    .button-file, .button-action-flat {
        background-color: #e1da05;
        border-color:#e1da05;
        color: #FFF;
    }
	 .font-up{
                display: block;
                font-size: 1.0em;
                font-style: normal;
				width: 70px;
				text-align:center;				
				margin:0 auto;
        }
		.row_left{
		padding: 0;
		margin:0;
		
		}
		.col-md-3{
		padding: 0 7% 18px 7%;
		width:33.3%;
		text-align:center;
		margin:0 auto;
		}
	.name_edit, .name_edit1 {
	width:50%;
	}
	.icon-level-p1 {
    width: 100%;
    border-radius: 50px;
    border-radius: 100px;
    border: none;
    overflow: hidden;
   -webkit-box-shadow:none;
    box-shadow:none;
	margin:20px auto 10px auto;
}
.stu_name img {
    width: 30px;
	
}
</style>
</head>
<body style="background:#fff;" >
 <div class="home_bg2">
        <div class="id_box user_bg">
            <a href="<?php  echo $this->createMobileUrl('tea_data');?>">
			<div class="icon-level-p1"><img src="<?php  echo $_W['attachurl'];?><?php  echo $result['teacher_img'];?>"/> </div>
			<div class="stu_name"><?php  echo $result['teacher_realname'];?><img src="<?php echo MODULE_URL;?>template/mobile/style/info.png" /></div>
            <div class="name_bg">
			<div class="name_edit" id="div_about"><span class="name_sm"></span><span class="dji">授课：<?php  echo $this->teacherCourse($result['teacher_id'],'echo')?></span></div>  
			<div class="name_edit" id="div_about" style="border:none;"><span class="name_sm"></span><span class="dji">班主任：<?php  echo $class_s;?></span></div>  
			</div>
            </a>
</div>	
</div>
    <div style="clear:both;"></div>
		<div style="margin-bottom:60px;margin-top:20px;">
		<div class="row row_left">
		<div class="col-md-3">
                                <a href="<?php  echo $this->createMobileUrl('tea_data');?>">
                                    <button class="button button-highlight button-box button-giant ">
                                        <i class="fa fa-file" style="color:#fff"></i>
                                </button> 
                                <i class='font-up'>教师资料</i>
                                </a>    
		</div>
		<div class="col-md-3">
                         <a href="<?php  echo $this->createMobileUrl('tea_today_course');?>">
                        <button class="button button-primary button-box button-giant ">
                                <i class="fa fa-building-o"></i>
                        </button>    
                                <i class='font-up'> 今日课程</i>
                        </a> 
                        
		</div>
		
  		<div class="col-md-3">
                                <a href="<?php  echo $this->createMobileUrl('tea_work_record');?>">
                                    <button class="button button-royal button-box button-giant ">
                                        <i class="fa fa-tasks"></i>
                                </button>            
                                <i class='font-up'>学生记录</i>
                                </a>    
		</div>      
		</div>
		<div class="row row_left">
		<div class="col-md-3">                 
                            <a href="<?php  echo $this->createMobileUrl('tea_homeWork');?>">
                                    <button class="button button-caution button-box button-giant ">
                                        <i class="fa fa-bars"></i>
                                </button>
                                <i class='font-up'>
                                发布作业</i>
                                </a>   
		</div>
		
		<div class="col-md-3">
                                <a href="<?php  echo $this->createMobileUrl('tea_score_in');?>">
                                <button class="button button-highlight button-box button-giant " >
                                        <i class="fa fa-table"></i>
                                </button>     
                                
                                <i class='font-up'>成绩登记</i>
                                </a> 
		</div>
 		<div class="col-md-3">                 
                                 <a href="<?php  echo $this->createMobileUrl('tea_msg');?>">								
                                    <button class=" button  button-box button-giant "  style="background-color:#8bc220;" >
                                       <i class="fa fa-comments" style="color:#fff"></i>

                                </button> 
                                <i class='font-up'> 消息发送</i>
                                </a>            
		</div>       
	</div>
	<div class="row row_left">
		<div class="col-md-3"   id="showDialog1" >
                                <a href="<?php  echo $this->createMobileUrl('tea_school_free',array('line'=>'no'));?>" >
                                    <button class="button button-royal button-box button-giant " >
                                        <i class="fa fa-paper-plane-o" style="color:#fff"></i>
                                    </button> 
                                <i class='font-up'> 一键放学</i>
                                </a>    
		</div>
		<div class="col-md-3">
                                <a href="<?php  echo $this->createMobileUrl('tea_line',array('line'=>'no'));?>">
                                    <button class="button  button-box button-giant"style="background-color: #FF5722;">
                                        <i class="fa fa-star" style="color:#fff"></i>
                                </button> 
                                <i class='font-up'>班级公告</i>
                                </a>    
		</div>
	<div class="col-md-3">
                                <a href="<?php  echo $this->createMobileUrl('tea_leave',array('line'=>'no'));?>">
                                    <button class="button button-highlight button-box button-giant">
                                        <i class="fa fa-info-circle" style="color:#fff"></i>
                                </button> 
                                <i class="font-up">请假管理</i>
                                </a>    
	</div>
    </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="icon_bottom"></div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo MODULE_URL;?>/style/teacher/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>/style/teacher/touchslider.dev.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
var active=0,
as=$('#pagenavi').find('a');
for(var i=0;i<as.length;i++){
	(function(){
		var j=i;
		as[i].onclick=function(){
			t2.slide(j);
			return false;
		}
	})();
}
$("#")
var t1=new TouchScroll({id:'wrapper','width':5,'opacity':0.7,color:'#555',minLength:20});
var t2=new TouchSlider({id:'slider', speed:1000, timeout:6000, before:function(index){
		jQuery('.li_a_info').hide();
		jQuery('.li_a_info[index='+index+']').show();
}});
 
})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>
</body>
</html>