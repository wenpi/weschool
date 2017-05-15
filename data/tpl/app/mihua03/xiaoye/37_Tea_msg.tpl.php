<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="main">
  <div class="ft">
    <div class="ft1"><a href="<?php  echo $this->createMobileUrl("tea_msg")?>">消息发送</a></div>
    <div class="ft2"><a href="<?php  echo $this->createMobileUrl("tea_msgHistory")?>">发送记录</a></div>
  </div>
    <?php  if($model!='student') { ?>
    <form method="post" >
    <div class="fsx">
        <?php  if(is_array($result)) { foreach($result as $item) { ?>
          <div class="f_hcz33">
            <input type=checkbox id='check<?php  echo $item;?>' value='<?php  echo $item;?>' name='have[]' ><label for='check<?php  echo $item;?>'><a href="<?php  echo $this->result_result($item,$model,'url','tea_msg');?>"><?php  echo $this->classGradeName($item)?><?php  echo $this->className($item);?> >></a></label>
        </div>
        <?php  } } ?>
    </div>
    <?php  } else { ?>
    <form method="post" class="l_bjpk" >
     <?php  if(is_array($result)) { foreach($result as $item) { ?>
        <input id="sss<?php  echo $item['student_id'];?>" type="checkbox" value="<?php  echo $item['student_id'];?>"  name='have[]' />
        <label class="l_sss" for="sss<?php  echo $item['student_id'];?>"><?php  echo $this->result_result($item,$model,'name','tea_msg');?></label>
     <?php  } } ?>
        <input type="hidden" value="student"  name='model'>
    <?php  } ?>
        <div class="fsnr">
            <div class="csc">
                <p>通知标题【不填写为默认】</p>
                <input name='mu_id' class='form-control' value="<?php  echo $this->module['config']['msg']?>" type='hidden'>
                <input type="text"  placeholder="[学生姓名]你好,这是个新的消息" name='title' style="display: block;visibility:visible" >
            </div>
            <div class="ssc">
                <p>简要内容【或者短信内容】</p>
                <span><textarea class="zxx1 mmm" name='intro' placeholder="内容简短，120字以内！"></textarea></span>
            </div>
            <div class="ssc">
                <p>详细内容</p>
                <span><textarea class="zxx1 mmm" placeholder="请输入详细内容" name="content"></textarea></span>
            </div>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH));?>
            <div class="qjyy">
                <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH));?>
            </div>
            <input type="hidden" value="<?php  echo $token;?>"  name='token'>
            <div class="mf"><a href="#"><input type="submit"  name="submit_weixin" value="提交" /></a></div>   
        </div>
    </form>
<?php  $center_class = 'cde'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
</div>
</body>
</html>
