<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<body>
<div class="weui_dialog_alert" id="weui_dialog_alert" style="display: none" >
    <div class="weui_mask" onclick="$('#weui_dialog_alert').hide();"></div>
    <div class="weui_dialog"  >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">切换身份</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access">
                    <?php  if(is_array($teacher_list)) { foreach($teacher_list as $row) { ?>
                    <a class="weui_cell " href="<?php  echo $this->createMobileUrl('teacenter',array('teacher_id'=>$row['teacher_id']) );?>" >
                        <div class="weui_cell_bd weui_cell_primary">
                            <p <?php  if($row['teacher_id'] == $result['teacher_id'] ) { ?> style="color:#ff0033" <?php  } ?>> <?php  echo $row['teacher_realname'];?></p>
                        </div>
                    </a>
                    <?php  } } ?>
                </div>
        </div>
            <div class="weui_dialog_ft">
                <br>
            </div>        
    </div>
</div>
	<div class="main">
		<div class="top" style="background-image:url(<?php  echo $this->imgFrom(D('adv')->getAdvInfoKeyWord('teacher_top_img'))?>)">
			<div class="qhleft" ><a href="<?php  echo $this->createMobileUrl("teacher")?>"   ><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jiahao.png"></a></div>
			<div class="qh"><a href="javascript:;"  onclick="changeDisplay('weui_dialog_alert')" ><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg/qh.png"></a></div>
			<div class="tx">  <div style="background-image: url(<?php  echo $this->imgFrom($result['teacher_img']);?>);width:22vw;height:22vw "  class="home_head_img" ></div> </div>
			<div class="bj"><div class="bj1"><p><?php  echo $result['teacher_realname'];?> </p></div><div class="bj2"><p><?php  echo $this->teacherCourse($result['teacher_id'],'echo')?></p></div></div>
			</div>
			<div class="zt">
		<div class="tz">
			<div class="tz1">通知</div>
			<div class="tz2"><a href="<?php  echo $this->createMobileUrl("neimsg_tea")?>">查看全部通知</a></div> 
		</div>
		</div>
			<div class="tzxq">
				<div class="tzx1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg/lb.png"></div>
				<div class="xx">
				<div class="tzx2">
					<div class="tzxq11"><a href="<?php  echo $this->createMobileUrl('msg_content',array("id"=>$msg_list['0']['msg_id']))?>"><?php  echo $msg_list[0]['msg_title'];?></a></div>
					<div class="tzxq12"><?php  echo  date("m-d H:i",$msg_list[0]['add_time'])?></div>
				</div>
					<div class="tzxx"><?php  echo S('fun','formatLimitContent',array($msg_list[0]['msg_content'],35));?>...</div>
				</div>
		</div>
		<div class="kz"></div>
	<?php  $class_mobile = D('mobile');?>
	<?php  $index_list   = $class_mobile->getIndexNav(false); ?>
	<?php  if(is_array($index_list)) { foreach($index_list as $row) { ?>
		<?php  if($row['top']['name']) { ?>
			<div class="zt">
				<div class="tz">
					<div class="tz1"><?php  echo $row['top']['name'];?></div>
				</div>	
			</div>
		<?php  } ?>
		<ul class="lm">
		<?php  if(is_array($row['list'])) { foreach($row['list'] as $key => $val) { ?>
			<?php  $params = json_decode($val['dis_three'],1);?>
			<?php  $params["token"] = $token;?>
			<?php  if(($key+1)%4==0) { ?>
				<li class="lmn">
			<?php  } else { ?>
				<li class="lmm">
			<?php  } ?>
					<div class="lmt"><a href="<?php  if($val['url']) { ?><?php  echo $val['url'];?><?php  } else { ?><?php  echo $this->createMobileUrl($val['keyword'],$params)?><?php  } ?>">
						<img src="<?php  echo $this->imgFrom($val['img'])?>" style="width:46px;height:31px"></a></div>
					<div class="lmz"><?php  echo $val['name'];?></div>
			</li>
		<?php  } } ?>
		</ul>
	<?php  } } ?>
		<?php  $center_class = 'cde'?>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
		</div>
</body>
</html>
