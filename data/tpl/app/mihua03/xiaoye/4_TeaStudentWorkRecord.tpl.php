<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
		<div class="bl">学生记录-选择学生</div>
        <form method="post" ><div  class="l_bjpk" >
              <?php  if(is_array($student_list)) { foreach($student_list as $row) { ?>
                <input name="student_ids[]" id='sss<?php  echo $row['student_id'];?>'  type="checkbox" value="<?php  echo $row['student_id'];?>" />
                <label class="l_sss" for="sss<?php  echo $row['student_id'];?>"><?php  echo $row['student_name'];?><a href="<?php  echo $this->createMobileUrl("teaStudentAddWorkRecord",array("sid"=>$row['student_id']))?>">>></a></label>             
              <?php  } } ?>
              <div class="clear"></div>
              </div>
                <div class="fsgg" style="margin-top:20px;">点击学生名字选择学生</div>
                        <div class="fss1"><p>记录类型</p>
                            <input type="hidden" name="sid" value="<?php  echo $student_info['student_id'];?>">
                            <select name="record_class_id" id="selectAge">
                                <?php  if(is_array($recore_class_list)) { foreach($recore_class_list as $row) { ?>
                                    <option value="<?php  echo $row['class_id'];?>"><?php  echo $row['class_name'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <div class="sfs1"><p> 记录名</p> <input type="text" name="record_title" required></div>
                        <div class="ssc">
                            <p>文字描述内容</p>
                            <span>
                                <textarea class="zxx1 mmm" placeholder="请输入资料内容" name="record_content" ></textarea>
                            </span>
                        </div>
                        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH));?>
                        <div class="qjyy">
                        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH));?>
                        </div>
                <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                <div class="mf"><a href="#"><input type="submit"  name="submit" value="提交" /></a></div>              
         </form>	
        <?php  $center_class = 'cde'?>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    </div>
</body>
</html>
