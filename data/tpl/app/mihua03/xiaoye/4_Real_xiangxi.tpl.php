<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
  <form action=" " method="POST">
    <div class="b3-t">
	<div class="kzk"></div>
    <li id='head_img' <?php  if($result['student_img']) { ?> style="background-image: url(<?php  echo $this->imgFrom($result['student_img']);?>);" <?php  } ?>>
		<a href="javascript:;" id='chooseImage'> <img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/zp.png"></a></li>
	</div>
	<div class="sq">
		<div class="sq-tf">
			<p class="sq-11">学生姓名</p>
			<input class="sq-t2f" value='<?php  echo $result['student_name'];?>' readonly >
		</div>
        <div class="sq-tf">
			<p class="sq-11">学生系统号</p>
			<input class="sq-t22" value='<?php  echo $result['student_passport'];?>' readonly >
		</div>
        <div class="sq-tf">
			<p class="sq-11">学生学号</p>
			<input class="sq-t2f"  value='<?php  echo $result['xuehao'];?>' readonly >
		</div>
        <div class="sq-tf">
			<p class="sq-11">学生地址</p>
			<input  class="sq-t2f" name='address'    value='<?php  echo $result['address'];?>' >
		</div>
        <div class="sq-tf">
			<p class="sq-11">联系方式</p>
			<input class="sq-t2f" name='student_link'   value='<?php  echo $result['student_link'];?>'>
		</div>
		<div class="tz-mn"></div>
		<div class="sq-tf">
			<p class="sq-11">家长姓名</p>
			<input class="sq-t2f"  name='parent_name'   value='<?php  echo $result['parent_name'];?>'>
		</div>
		<div class="sq-tf">
			<p class="sq-11">家长电话</p>
			<input class="sq-t2f" name='parent_phone'    value='<?php  echo $result['parent_phone'];?>' >
		</div>
		<div class="sq-tf">
			<p class="sq-11">关系</p>
                <?php  $relation_list = $this->class_base->getRelation(); ?>
				<select name='relation' class="sq-t23" style="-webkit-appearance: none;width:100px;padding:1px;height:auto;padding-left:5px; ">
					<?php  if(is_array($relation_list)) { foreach($relation_list as $row) { ?>
                        <option value="<?php  echo $row;?>" <?php  if($row == $my_relation) { ?> selected <?php  } ?>><?php  echo $row;?></option>
					<?php  } } ?>
				</select>
		</div>
	</div>
	    <div  class='hide' id='img_value'></div>  
        <div class="z_dpt5">
			<input type="submit"   value="提交">
		</div>
  </form>
 </div>
<script>
    $(function(){
        <?php  if($result['student_img']) { ?>
            insertValue('<?php  echo $result['student_img'];?>');
        <?php  } ?>
    });   
    function insertImg(img_src){
        $('#head_img').css('background-image','url('+img_src+')');
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upLoneImg', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upLoneImg', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
