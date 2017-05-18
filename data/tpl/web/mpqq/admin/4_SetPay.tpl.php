<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> 
                            <small> 调用支付设置[<?php  echo $_SESSION['school_name'];?>] </small> 
                    </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 参数设置</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-body">
                                                        <div class="panel panel-default">
                                                                <div class="panel-heading">支付配置（多校共用）</div>
                                                                <div class="panel-body">
                                                                  <div class="form-group form-md-radios form-md-line-input ">
                                                                        <label class="col-md-2 control-label"  >是否开启其他账号支付</label>
                                                                        <div class="md-radio-inline">
                                                                            <div class="md-radio">
                                                                               <input type='radio' value='0'  id= 'radiolgr' name='pay_do' class="md-radiobtn" <?php  if($settings['pay_do']==0) { ?> checked <?php  } ?>/> 
                                                                                <label for="radiolgr">
                                                                                    <span></span>
                                                                                    <span class="check"></span>
                                                                                    <span class="box"></span>不开启</label>
                                                                            </div>
                                                                            <div class="md-radio">
                                                                            <input type='radio' value='1' name='pay_do'  id= 'radiolg1' class="md-radiobtn"  <?php  if($settings['pay_do']==1) { ?> checked <?php  } ?>/> 
                                                                                <label for="radiolg1">
                                                                                    <span></span>
                                                                                    <span class="check"></span>
                                                                                    <span class="box"></span>开启</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                           
                                                                    <div class="form-group  form-md-line-input ">
                                                                        <label class=" col-md-2 control-label">选择公众号</label>
                                                                        <div class="col-sm-10">
                                                                        <select name='pay_uniacid' class="form-control">
                                                                            <?php  if(is_array($uniacid_list)) { foreach($uniacid_list as $row) { ?>
                                                                                <option value="<?php  echo $row['uniacid'];?>" <?php  if($settings['pay_uniacid']==$row['uniacid']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                                                                            <?php  } } ?>
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </div>        
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                                                <input type="submit" name="submit" class="btn blue" value="确认">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    </div>
             </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
         </div>
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     </body>
    </html>
           