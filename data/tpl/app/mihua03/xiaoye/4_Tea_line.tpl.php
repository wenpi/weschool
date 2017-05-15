<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
        <div class="bl">班级公告-<?php  if($ac == 'edit') { ?>编辑<?php  } else { ?>发送<?php  } ?></div>
        <form method="post">
        <div class="fsx">
            <?php  if($ac == 'edit') { ?>
                    <div class="f_hcz33">
                        <input type=checkbox id='check<?php  echo $result['class_id'];?>' value='<?php  echo $result['class_id'];?>' name="have[]"  checked ><label for='check<?php  echo $result['class_id'];?>'><a href="<?php  echo $this->createMobileUrl('Tea_lineHistory',array('cid'=>$result['class_id']))?>"><?php  echo $this->classGradeName($result['class_id'])?><?php  echo $this->className($item['class_id'])?> [记录]</a></label>
                    </div>
            <?php  } else { ?>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <div class="f_hcz33">
                        <input type=checkbox id='check<?php  echo $item['class_id'];?>' value='<?php  echo $item['class_id'];?>' name="have[]" ><label for='check<?php  echo $item['class_id'];?>'><a href="<?php  echo $this->createMobileUrl('Tea_lineHistory',array('cid'=>$item['class_id']))?>"><?php  echo $item['grade_name'];?><?php  echo $item['class_name'];?> [记录]</a></label>
                    </div>
                <?php  } } ?>
            <?php  } ?>
        
        </div>
        <div class="fsnr">
            <div class="fs1 ttt"><p>标题</p><input style="width: 80%;" type="text" name='line_title' value="<?php  echo $result['line_title'];?>" ></div>
            <div class="fs1"><p>类型</p>
                <select name='line_type'  class="bba" style="width: 80%!important;" id="selectAge" >
							<?php  if(is_array($line_type_cfg)) { foreach($line_type_cfg as $key => $row) { ?>
								<option value='<?php  echo $key;?>' <?php  if($result['line_type']==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
							<?php  } } ?>
                </select>
            </div>
            <div class="ssc">
                 <p class="ooo">详细内容</p>
                 <span><textarea class="zxx1 mmm" placeholder="请输入资料内容"  name='line_content'><?php  echo $result['line_content'];?></textarea></span>
             </div>
            <?php  if($ac=='new' || $ac=='list') { ?>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH));?>
            <div class="qjyy">
                <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH));?>
            </div>
                <input type="hidden" value="new"  name='ac'>
            <?php  } else { ?>
                <input type="hidden" value="edit"  name='ac'>
            <?php  } ?>
            <input type="hidden" value="<?php  echo $token;?>"  name='token'>
            <div class="mf"><a href="#"><input type="submit"  name="submit" value="提交" /></a></div>   
            </form>
    </div>
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    </div>
</body>
</html>
