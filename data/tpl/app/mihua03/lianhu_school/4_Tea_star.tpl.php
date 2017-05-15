<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>星星评价-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<body>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>星星评价-<?php  if($model=='class') { ?>班级列表<?php  } else if($model=='student') { ?>选择学生<?php  } else if($model=='someone') { ?>发送<?php  } ?></div>
        </div>
 </div> 
<div class="main">
	<?php  if($model!='someone') { ?>
	<div class="panel-body table-responsive">
		<?php  if($model=='class') { ?>
		<table class="table table-hover">
			<tbody>
				<?php  if(is_array($result)) { foreach($result as $item) { ?>
				<tr>
					<td style="box-shadow: 3px 3px 3px rgba(0,0,0,0.2);">
                        <a href="<?php  echo $this->createMobileUrl('tea_star',array('cid'=>$item,'model'=>'student'));?>">
                            <span style='display:inline-block;width:60%'><?php  echo $this->classGradeName($item)?>-<?php  echo $this->className($item);?></span>
					        <img src="<?php echo MODULE_URL;?>template/mobile/style/right.png" />
					</a>
                    </td>
				</tr>
				<?php  } } ?>
				<?php  if($model!='class') { ?>
				<tr>
					<td><a href="javascript:;" onclick="window.history.back() ">返回</td>
				</tr>
				<?php  } ?>
			</tbody>
		</table>
		<?php  } ?>
		<?php  if($model=='student') { ?>
        <?php  $class_student = D('student');?>
			<ul>
				<?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
					<li style='float:left;width:30%;text-align:center;height:25px;line-height:25px;box-shadow: 3px 3px 3px rgba(0,0,0,0.2);border:1px solid #fff;<?php  if($key%3 ==0) { ?> margin-left:5%<?php  } ?>'>
						<?php  $have_parent  =$class_student->returnEfficeOpenid($item,3);?>
						<?php  if(!$have_parent['f_openid']  && !$have_parent['s_openid'] && !$have_parent['t_openid']) { ?>
						<span class='red'>
							<?php  echo $this->result_result($item,$model,'name','work');?>
						</span>
						<?php  } else { ?>
						<a href="<?php  echo $this->createMobileUrl('tea_star',array('sid'=>$item['student_id'],'model'=>'someone'));?>" class="Tstudentname">
							<?php  echo $this->result_result($item,$model,'name','work');?>
					    </a>
						<?php  } ?>
					</li>
				<?php  } } ?>
			</ul>
		<?php  } ?>
	</div>
	<?php  } ?>
	<?php  if($model=='someone') { ?>
	<div class="panel panel-info">
	<div class="panel-body ">
	<form   method="post"  id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				添加新的星星记录【<?php  echo $result['student_name'];?>】
			</div>
			<div class="panel-body">
				<div class="tab-content">
                    <div class='form-group'>
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">简述下</label>
                            <textarea name='content' class='form-control' style='width:80%;margin-left:5%'></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">星星数</label>
                            <div id="starBg" class="star_bg">                    	
                                <input type="radio" id="starScore1" class="score score_1" value="1" name="star_num">
                                <a href="#starScore1" class="star star_1" title="差"><label for="starScore1">差</label></a>
                                <input type="radio" id="starScore2" class="score score_2" value="2" name="star_num">
                                <a href="#starScore2" class="star star_2" title="较差"><label for="starScore2">较差</label></a>
                                <input type="radio" id="starScore3" class="score score_3" value="3" name="star_num">
                                <a href="#starScore3" class="star star_3" title="普通"><label for="starScore3">普通</label></a>
                                <input type="radio" id="starScore4" class="score score_4" value="4" name="star_num">
                                <a href="#starScore4" class="star star_4" title="较好"><label for="starScore4">较好</label></a>
                                <input type="radio" id="starScore5" class="score score_5" value="5" name="star_num">
                                <a href="#5" class="star star_5" title="好"><label for="starScore5">好</label></a>
                            </div>
                    </div>
				</div>
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="hidden" value="<?php  echo $token;?>"  name='token'>
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>	
</div>

</div>
<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<style>
    .star_bg {
    width: 120px; height: 20px;
    background: url(<?php echo MODULE_URL;?>images/star.png) repeat-x;
    position: relative;
    overflow: hidden;
    margin-left:10px;
}
.star {
    height: 100%; width: 24px;
    line-height: 6em;
    position: absolute;
    z-index: 3;
}
.star:hover {    
    background: url(<?php echo MODULE_URL;?>images/star.png) repeat-x 0 -20px!important;
    left: 0; z-index: 2;
}
.star_1 { left: 0; }
.star_2 { left: 24px; }
.star_3 { left: 48px; }
.star_4 { left: 72px; }
.star_5 { left: 96px; }
.star_1:hover { width: 24px; }
.star_2:hover { width: 48px; }
.star_3:hover { width: 72px; }
.star_4:hover { width: 96px; }
.star_5:hover { width: 120px; }

label { 
    display: block; _display:inline;
    height: 100%; width: 100%;
    cursor: pointer;
}

/* 幕后的英雄，单选按钮 */
.score { position: absolute; clip: rect(0 0 0 0); }
.score:checked + .star {    
    background: url(star.png) repeat-x 0 -20px;
    left: 0; z-index: 1;
}
.score_1:checked ~ .star_1 { width: 24px; }
.score_2:checked ~ .star_2 { width: 48px; }
.score_3:checked ~ .star_3 { width: 72px; }
.score_4:checked ~ .star_4 { width: 96px; }
.score_5:checked ~ .star_5 { width: 120px; }

.star_bg:hover .star {  background-image: none; }

/* for IE6-IE8 JS 交互 */
.star_checked {    
    background: url(<?php echo MODULE_URL;?>images/star.png) repeat-x 0 -20px;
    left: 0; z-index: 1;
}
</style>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>