<?php defined('IN_IA') or exit('Access Denied');?>           <?php  if($_GPC['dev']==1) { ?>
                <div style="color:#ff0033;">
                    <br>
                    <?php  echo sysPerforms(true);?>
                </div>
            <?php  } ?>
        <div class="page-footer">
            <div class="page-footer-inner"> <?php  echo S('base','getKeywordContent',array('yeas'))?> &copy;<?php  echo S('base','getKeywordContent',array('name'))?> By
                <a target="_blank" href="#"><?php  echo S('base','getKeywordContent',array('copyright'))?></a> &nbsp;
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!--[if lt IE 9]>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/respond.min.js"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/excanvas.min.js"></script> 
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="<?php echo MODULE_URL;?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="<?php echo MODULE_URL;?>/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <!--myself-->
            