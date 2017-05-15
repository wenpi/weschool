<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('setting_nav', TEMPLATE_INCLUDEPATH)) : (include template('setting_nav', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        支付设置
    </div>
    <div class="panel-body">
        <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <h2>借用支付配置流程</h2>
                功能选项->设置oauth权限->选择借用授权公众账号 <br/>
                功能选项->借用js分享权限->选择借用公众账号 <br/>
                --上传对应公众账号的支付证书 <br/>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">自动到账</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline">
                        <input type="radio" name="open_auto" value="1" <?php  if($item['open_auto']==1) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="open_auto" value="0" <?php  if($item['open_auto']==0) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div id="open_auto_0" style="display:<?php  if($item['open_auto'] == 1) { ?>block;<?php  } else { ?>none;<?php  } ?>">
                <div class="form-group" id="type1" style="display:<?php  if($item['type'] == 1) { ?>block;<?php  } else { ?>none;<?php  } ?>">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">每天</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <?php  echo tpl_form_field_clock('day_time',$item['day_time'])?>
                    </div>
                </div>
            </div>
            <script>
                $('input[name="open_auto"]').on('change keyup',function(){
                    var _val = $(this).val();
                    if(_val == 1){
                        $('#open_auto_0').show();
                    }else{
                        $('#open_auto_0').hide();
                    }
                });
            </script>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">CERT证书文件</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                     <input type="file" name="weixin_cert_file" placeholder="" class="form-control"/>
                    <span class="help-block"><?php  if(!empty($item['weixin_cert_file'])) { ?><label class="label label-info">已上传</label><?php  } ?>下载证书 cert.zip 中的 apiclient_cert.pem 文件</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">KEY密钥文件</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="file" name="weixin_key_file" placeholder="" class="form-control"/>
                    <span class="help-block"><?php  if(!empty($item['weixin_key_file'])) { ?><label class="label label-info">已上传</label><?php  } ?>下载证书 cert.zip 中的 apiclient_key.pem 文件</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">ROOT文件</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="file" name="weixin_root_file" placeholder="" value="<?php  echo $item['weixin_root_file'];?>" class="form-control"/>
                    <span class="help-block"><?php  if(!empty($item['weixin_root_file'])) { ?><label class="label label-info">已上传</label><?php  } ?>下载证书 cert.zip 中的 rootca.pem 文件</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>