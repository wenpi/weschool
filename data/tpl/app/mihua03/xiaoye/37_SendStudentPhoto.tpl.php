<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
<body>
    <div class="z_main">
        <form  enctype="multipart/form-data" id="new_article" method="post" class="post-form" > 
            <input name="title" placeholder="此处输入标题" style="height: 50px;" class="z_xas"  >
            <?php  $video='no'?>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upimg', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upimg', TEMPLATE_INCLUDEPATH));?>
            <input  type="submit"  name="submit" id="pingl3" value="发布"  class="pinglun44">
        </form>
    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
