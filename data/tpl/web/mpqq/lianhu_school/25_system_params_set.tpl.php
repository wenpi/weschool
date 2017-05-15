<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading"> 家云参数</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>家云账号</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="jia_passport" id="jia_passport" class="form-control" value='<?php  echo $jiayun_passport;?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>家云密码</label>
					<div class="col-sm-9 col-xs-8">
						<input type="password" name="jia_password" id="jia_password"  class="form-control" value='<?php  echo $jiayun_password;?>' />
					</div>
				</div>                
				</div>
			</div>
		</div>	
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>
</div>	