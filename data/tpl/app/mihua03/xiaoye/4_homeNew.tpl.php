<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>/template/xiaoye/css/newcss.css" rel="stylesheet">
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<div class="weui_dialog_alert" id="change_student_area" style="display:none" data-dis='no' onclick="changeDisplay('change_student_area')" >
    <div class="weui_mask"     ></div>
    <div class="weui_dialog"  >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title" style="font-size:0.8em" >切换学生</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access" style="font-size:0.8em" >
                    <?php  if(is_array($studentlist)) { foreach($studentlist as $row) { ?>
                    <a class="weui_cell " href="<?php  echo $this->createMobileUrl('change_student',array('op'=>'post','sid'=>$row['student_id']) );?>" >
                        <div class="weui_cell_bd weui_cell_primary" style="height:1.2em;line-height: 1.2em">
                            <p <?php  if($row['student_id']== $result['student_id']) { ?> style="color:red" <?php  } ?> > <?php  echo $row['student_name'];?></p>
                        </div>
                    </a>
                    <?php  } } ?>
                </div>
        </div>
        <?php  if(D('school')->getSchoolParams('much_class')) { ?>
            <div class="weui_dialog_hd"><strong class="weui_dialog_title" style="font-size:0.8em">切换班级</strong></div>
            <div class="weui_dialog_bd">
                    <div class="weui_cells weui_cells_access" style="font-size: 0.8em;">
                        <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                        <a class="weui_cell " href="<?php  echo $this->createMobileUrl('change_student',array('op'=>'class_post','sid'=>$result['student_id'],'class_id'=>$row['class_id'] ) );?>" >
                            <div class="weui_cell_bd weui_cell_primary" style="height:1.2em;line-height: 1.2em">
                                <p <?php  if($row['class_id']==  $now_class_id ) { ?> style="color:red" <?php  } ?> > <?php  echo $row['class_name'];?></p>
                            </div>
                        </a>
                        <?php  } } ?>
                    </div>
            </div>
        <?php  } ?>
        <div class="weui_dialog_ft">
        </div>        
    </div>
</div>
<div class="weui_dialog_alert"  id="student_code_area" style="display:none"  data-dis='no'onclick="changeDisplay('student_code_area')" >
    <div class="weui_mask"  ></div>
    <div class="weui_dialog"  >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title" style="font-size: 1px;">学生二维码</strong></div>
        <div class="weui_dialog_bd">
            <img src="<?php  echo $class_student->getStudentQrcode($result['student_id']);?>" style="width:80%">
        </div>
        <br>
    </div>
</div>

	<div class="main">
		<div class="jy">
		<div class="gd">
			<div class="top">
				<div class="t1"><a href="<?php  echo $this->createMobileUrl("real_xiangxi")?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/t1.png"></a></div>
				
				<div class="t2"><a href="javascript:;" onclick="changeDisplay('change_student_area')" ><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/t3.png"></a></div>
				<div class="t2"><a href="<?php  echo $this->createMobileUrl("add_student")?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/t2.png"></a></div>
			</div>
			<div class="tx"><a href="javascript:;" onclick="changeDisplay('student_code_area')"  >
                    <div style="background-image: url(<?php  echo $this->imgFrom($result['student_img']);?>) "  class="home_head_img" ></div>
                </a></div>
			<div class="bj"><p><?php  echo $result['student_name'];?></p><span><?php  echo $grade_name;?><?php  echo $class_name;?></span></div>
			<div class="tp">
                
                <img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/t_bj.png"></div>
			</div>
			<div class="cc">
		<ul class="cd">
			<?php  if(is_array($new_list)) { foreach($new_list as $row) { ?>
				<li class="c1"><a href="<?php  if($row['url']) { ?><?php  echo $row['url'];?><?php  } else { ?><?php  echo $this->createMobileUrl($row['keyword'])?><?php  } ?>"><img src="<?php  echo  $this->imgFrom($row['xiaoyeimg'])?>"><p><?php  echo $row['name'];?></p></a></li>
			<?php  } } ?>
				<li class="c1"><a href="<?php  echo $this->createMobileUrl("HomeMore")?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/c8.png"><p>全部</p></a></li>
			</ul>
		<div class="fl">
			<?php  if($cook_list) { ?>
				<div class="f1">
					<div class="fbt">
						<div class="bt1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/sp.png"><p>校园食谱(<?php  echo date("m-d",$cook_list[0]['use_time'])?>)</p></div>
						<div class="bt2"><a href="<?php  echo $this->createMobileUrl("cookbook")?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
					</div>
					<a href="<?php  echo $this->createMobileUrl("cookbook")?>">
					<ul class="fnr">
						<?php  if(is_array($cook_list)) { foreach($cook_list as $row) { ?>
							<li class="fn1">
								<p><?php  echo $row['class_name'];?></p>
								<span><?php  echo $row['cookbooK_breakfast'];?></span>
							</li>
						<?php  } } ?>
					</ul>
					</a>
				</div>
			<?php  } ?>
			<?php  if($line_re) { ?>
				<div class="f1">
						<div class="fbt">
							<div class="bt3">
								 <div style="background-image: url(<?php  if($teacher_result) { ?><?php  echo D('teacher')->teacherImg($teacher_result['teacher_id']);?><?php  } else { ?> <?php  echo $_W['attachurl'];?><?php  echo $student_info['student_img'];?><?php  } ?>);width:30px !important;height:30px !important;background-size: 100% 100%;"  class="home_head_img" >
								 </div>
								 </div>
							<div class="bt4">
								<div class="bbt">
									<?php  if(!$teacher_result) { ?>
										<p><?php  echo $student_info['student_name'];?></p>
										<?php  if($row['relation']) { ?><span>（<?php  echo $row['relation'];?>）</span><?php  } ?>
									<?php  } else { ?>
										<p><?php  echo $teacher_result['teacher_realname'];?></p><span>(教师)</span>
									<?php  } ?>
								</div>
								<div class="ttb"><p><?php  echo date("Y-m-d",$line_re['add_time'])?></p><span><?php  echo date("H:i:s",$line_re['add_time'])?></span></div>
							</div>
							<div class="bt2"><a href="<?php  echo $this->createMobileUrl("line")?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
						</div>
						<a href="<?php  echo $this->createMobileUrl("line")?>">
						<div class="lsnr"><?php  echo $line_re['send_content'];?></div>
						<ul class="lstp">
							<?php  echo $this->decodeLineImgs($line_re['send_image']);?>
						</ul>
						</a>
				</div>
		<?php  } ?>
		<!--<div class="f1">
			<div class="fbt">
				<div class="bt1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/cj.png"><p>考试成绩</p></div>
				<div class="bt2"><a href="#"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
			</div>
			<ul class="cjj">
					<li class="cj1">英语</li>
					<li class="cj1">第三单元</li>
					<li class="cj1">83</li>
			</ul>
			<div class="zxt"><a href="#"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/zxt.png"></a></div>
		</div>-->
	<?php  if($msg_re) { ?>
		<div class="f1">
			<div class="fbt">
				<div class="bt1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/gg.png"><p>校园公告</p></div>
				<div class="bt2"><a href="<?php  echo $this->createMobileUrl('neimsg')?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
			</div>
			<a href="<?php  echo $this->createMobileUrl('neimsg')?>">
			<div class="tzz"><?php  echo $msg_re['msg_title'];?></div>
				<div class="tzgg"><p><?php  echo S('fun','formatLimitContent',array($msg_re['msg_content'],65));?>...</p></div>
				<div class="fbz"><p>发布者：<?php  echo $admin_name;?></p><span><?php  echo date("Y-m-d",$msg_re['addtime'])?></span><span><?php  echo date("H:i:s",$msg_re['addtime'])?></span>
				</div>
			</a>
		</div>
	<?php  } ?>
	<?php  if($class_re) { ?>
			<div class="f1">
			<div class="fbt">
				<div class="bt1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/gg.png"><p>班级公告</p></div>
				<div class="bt2"><a href="<?php  echo $this->createMobileUrl('classMsg')?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
			</div>
			<a href="<?php  echo $this->createMobileUrl('classMsg')?>">
				<div class="tzz"><?php  echo $class_re['line_title'];?></div>
					<div class="tzgg"><p><?php  echo S('fun','formatLimitContent',array($class_re['line_content'],65));?>...</p></div>
					<div class="fbz"><p>发布者：<?php  echo D('teacher')->teacherName($class_re['teacher_id']);?></p><span><?php  echo date("Y-m-d",$class_re['addtime'])?></span><span><?php  echo date("H:i:s",$class_re['addtime'])?></span>
					</div>
			</a>
		</div>
	<?php  } ?>
	<?php  if($work_re) { ?>
		<div class="f1">
			<div class="fbt">
			<div class="bt1"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/dp.png"><p>点评录</p></div>
			<div class="bt2"><a href="<?php  echo $this->createMobileUrl('record')?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/jt.png"></a></div>
			</div>
			<a href="<?php  echo $this->createMobileUrl('record')?>">
			<?php  $class_re = D("record")->edit($work_re['jilv_class']);?>
			<div class="tzz"><?php  echo $class_re['class_name'];?>：<?php  echo D('teacher')->teacherName($work_re['teacher_id']);?></div>
				<div class="gg"><p><?php  echo $work_re["word"];?>：<?php  echo $work_re['content'];?></p></div>
				<?php  if($work_re['img'] && $work_re['img']!='qiniu' ) { ?>
					<div class="bf">
							<img src='<?php  echo  $this->imgFrom($work_re['img']);?>' >
					</div>
				<?php  } ?>	
				<?php  if($work_re['voice']) { ?>
					<div class="bf">
						<audio preload="auto" controls src=" <?php  echo  $this->imgFrom($work_re['voice']);?>">
						</audio>  
					</div> 
        		<?php  } ?>  
			</a>
		</div>
	<?php  } ?>
	</div>
</div>
</div>
<link rel="canonical" href="/examples/audio-player-responsive-and-touch-friendly">
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/audioplayer.js"></script>
<script>
	$( function(){
		$( 'audio' ).audioPlayer();
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</div>
</body>
</html>
