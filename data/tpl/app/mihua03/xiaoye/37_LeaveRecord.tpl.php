<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<script>
$( function(){
    $( 'audio' ).audioPlayer();
});
</script>
<div class="z_main">
    <div class="headqj">
        <a href="<?php  echo $this->createMobileUrl('leave')?>"><p>请假申请</p></a>
        <a href="<?php  echo $this->createMobileUrl('leaveRecord')?>"  class="pp"><p>申请记录</p></a>
    </div>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/LeaveRecord_content', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/LeaveRecord_content', TEMPLATE_INCLUDEPATH));?>
</div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
