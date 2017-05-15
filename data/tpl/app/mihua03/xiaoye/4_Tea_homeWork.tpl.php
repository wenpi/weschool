<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="main">
  <div class="ft">
    <div class="ft1"><a href="<?php  echo $this->createMobileUrl("tea_homeWork")?>">发布作业</a></div>
    <div class="ft2"><a href="<?php  echo $this->createMobileUrl("tea_homeWorkHistory")?>">作业记录</a></div>
  </div>
  <form method="post">
  <div class="cn">
    <div class="z_hcz33">
        <?php  if(is_array($result)) { foreach($result as $item) { ?>
		        <div class="asd"> <input type='checkbox' name="class_list[]" id='check<?php  echo $item;?>' value='<?php  echo $item;?>'><label for='check<?php  echo $item;?>'><?php  echo $this->classGradeName($item)?><br><?php  echo $this->className($item);?></label></div>
        <?php  } } ?>
    </div>
  </div>
  <div class="xk">
	  <div class="xk1">课程</div>
	  <div class="xl">
	     <select name='course_id'>
                        <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                            <option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
                        <?php  } } ?>
        </select>
      </div>
	</div>
		<div class="ssc">
            <span><textarea class="zxx1 mmm" placeholder="请输入详细作业内容。" name="content"></textarea></span>
       </div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH));?>
    <div class="qjyy">
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH));?>
    </div>
    <input type="hidden" value="<?php  echo $token;?>"  name='token'>
    <div class="mf"><a href="#"><input type="submit"  name="submit" value="马上发布" /></a></div>   
  </form>
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</div>
</body>
</html>
