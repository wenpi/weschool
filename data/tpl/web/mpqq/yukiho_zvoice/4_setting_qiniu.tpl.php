<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('setting_nav', TEMPLATE_INCLUDEPATH)) : (include template('setting_nav', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-default">
    <div class="panel-heading">
        七牛设置
    </div>
    <div class="panel-body">
        <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>文档转换服务 (yifangyun_preview)</strong>
                文档转换 yifangyun_preview 服务能帮您把各种 office 文档转换为 PDF 和 jpg 图片格式。
                同时，该服务也支持把 PDF 格式的文档转换为 jpg 图片格式。
                本服务由亿方云科技（以下简称亿方云）提供。
                启用服务后，您存储在七牛云空间的文件将在您主动请求的情况下被提供给亿方云以供其计算使用。
                费用请您参考具体的服务价格，您使用本服务产生的费用由七牛代收。
                启用服务则表示您知晓并同意以上内容。
            </div>
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>服务价格</strong>
                每千页PPT价格-0.3元	每千页Word-0.1元	每千个Excel的sheet-0.1元
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">Access Key</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="access_key" placeholder="" value="<?php  echo $item['access_key'];?>" class="form-control"/>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">Secret Key</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="secret_key" placeholder="" value="<?php  echo $item['secret_key'];?>" class="form-control"/>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">Bucket Name</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="bucket_name" placeholder="" value="<?php  echo $item['bucket_name'];?>" class="form-control"/>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">域名</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="url" placeholder="" value="<?php  echo $item['url'];?>" class="form-control"/>
                    <span class="help-block">自定义域名,前面不要忘记加http://</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">多媒体处理</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="mps" placeholder="" value="<?php  echo $item['mps'];?>" class="form-control"/>
                    <span class="help-block"></span>
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>