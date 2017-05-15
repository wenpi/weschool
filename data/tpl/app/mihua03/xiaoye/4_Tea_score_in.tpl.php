<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
        <?php  if($model!='student') { ?>
            <div class="bl">发布成绩-选择班级</div>
            <ul class="bll">
                <?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
                <li class="bjlb">
                    <div class="bl1"><a href="<?php  echo $this->createMobileUrl("tea_score_in",array("cid"=>$item,'model'=>'student'))?>"><p><?php  echo $this->classGradeName($item)?></p></a><a href="<?php  echo $this->createMobileUrl("tea_score_in",array("cid"=>$item,'model'=>'student'))?>"><p><?php  echo $this->className($item)?></p></a></div>
                    <div class="bl2"><a href="<?php  echo $this->createMobileUrl("tea_score_in",array("cid"=>$item,'model'=>'student'))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg/jt.png"></a></div>
                </li>
                <?php  } } ?>
            </ul>        
        <?php  } else { ?>
		<div class="bl">发布成绩-填写数据</div>
        <form method="post">
        <div class="sf1"><p style="width: 36%;">选择课程</p>
                	<select style="width: 59%" name='course_id' onChange="ajax_up()" id="course_id" >
						<?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
							<option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
						<?php  } } ?>
					</select>
          </div>
            <div class="sf1"><p style="width: 36%;">选择考试记录</p>
                	<select name='scorejilv_id'  style="width: 59%" onChange="ajax_up()"id="scorejilv_id" >
						<?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
							<option value='<?php  echo $row['scorejilv_id'];?>'><?php  echo $row['scorejilv_name'];?></option>
						<?php  } } ?>
					</select>
            </div>
            <ul id='score_list' class="srcj" >
				<?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
						<li  class='cj'>
						    <div class="cj1"><?php  echo $this->result_result($item,$model,'name','msg');?></div>
                            <div class="cj2"><input type="text"   data-id='0' name='score[<?php  echo $item['student_id'];?>]'  value=""  placeholder="请填入成绩"></div>
                        </li>
				<?php  } } ?>
			</ul>
            <input type="hidden" value="<?php  echo $token;?>"  name='token'>
            <input type='hidden' value='<?php  echo $_GPC['cid'];?>' name='class_id'>
            <div class="mf"><a href="#"><input type="submit"  name="submit" value="提交" /></a></div>   
        </form>
        <?php  } ?>
    </div>
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
</body>
<?php  if($model=='student') { ?>
	<script>
		$(function(){
			ajax_up();
		});
		function ajax_up(){
				var cid=<?php  echo $_GPC['cid'];?>;
				var course_id=$('#course_id').val();
				var scorejilv_id=$('#scorejilv_id').val();
				$.ajax({
					type:'post',
					url:'<?php  echo $this->createMobileUrl('ajax',array('ac'=>'student_score_list'))?>',
					data:{cid:cid,course_id:course_id,scorejilv_id:scorejilv_id},
					dataType:'json',
					success:function(obj){
						if(obj.status=='yes'){
							$("#score_list").find('input').attr("data-id",0);
							$.each(obj.student_score_list,function(i,e){
								$('input[name="score['+e.student_id+']"]').val(e.score);
								$('input[name="score['+e.student_id+']"]').attr("data-id",1);
							});
							$.each($("#score_list").find('input'),function(i,e){
								if($(this).attr('data-id')!=1)
										$(this).val(0);
							});
						}
					}
				});								
		}
	</script>
<?php  } ?>
</html>
