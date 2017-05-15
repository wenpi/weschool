<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('setting_nav', TEMPLATE_INCLUDEPATH)) : (include template('setting_nav', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class="panel panel-default">
    <div class="panel-heading">模版文字设置</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">普通用户称呼</label>
				<div class="col-sm-12 col-lg-10 col-xs-10">
					<input type="text" placeholder="比如：学生/患者/观众..." name="userName" value="<?php  echo $item['userName'];?>" class="form-control"/>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">认证用户称呼</label>
				<div class="col-sm-12 col-lg-10 col-xs-10">
					<input type="text" placeholder="比如：老师/医生/律师..." name="authname" value="<?php  echo $item['authname'];?>" class="form-control"/>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">偷听文字</label>
				<div class="col-sm-12 col-lg-10 col-xs-10">
					<input type="text" placeholder="比如：学习/偷听/旁听..." name="learnName" value="<?php  echo $item['learnName'];?>" class="form-control"/>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">限时免费文字</label>
				<div class="col-sm-12 col-lg-10 col-xs-10">
					<input type="text" placeholder="比如：限时免费/免费收听..." name="limitFree" value="<?php  echo $item['limitFree'];?>" class="form-control"/>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">打赏文字</label>
				<div class="col-sm-12 col-lg-10 col-xs-10">
					<input type="text" placeholder="比如：打赏/赞助/支持/塞红包..." name="rewardName" value="<?php  echo $item['rewardName'];?>" class="form-control"/>
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
<?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>