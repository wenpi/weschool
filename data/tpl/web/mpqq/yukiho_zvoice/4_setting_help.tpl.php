<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('setting_nav', TEMPLATE_INCLUDEPATH)) : (include template('setting_nav', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-default">
    <div class="panel-heading">
        帮助设置
    </div>
    <div class="panel-body">
        <form action="" method="post"  class="form-horizontal">
          
			<div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">发布规则标题</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <input type="text" name="title1" value="<?php  echo $item['title1'];?>" class="form-control"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">发布规则内容</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <textarea type="text" name="content1" class="form-control"><?php  echo $item['content1'];?></textarea>
                </div>
            </div>         
			<div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">使用帮助标题</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <input type="text" name="title2" value="<?php  echo $item['title2'];?>" class="form-control"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">使用帮助内容</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <textarea type="text" name="content2" class="form-control"><?php  echo $item['content2'];?></textarea>
                </div>
            </div>    
			<div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">联系方式标题</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <input type="text" name="title3" value="<?php  echo $item['title3'];?>" class="form-control"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">联系方式内容</label>
                <div class="col-sm-8 col-lg-9 col-xs-10">
                    <textarea type="text" name="content3" class="form-control"><?php  echo $item['content3'];?></textarea>
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