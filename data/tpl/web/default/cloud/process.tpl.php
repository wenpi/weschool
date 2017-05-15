<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li class=""><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">一键更新</li>
</ol>
<ul class="nav nav-tabs">
	<li<?php  if($step == 'files') { ?> class="active"<?php  } ?>><a href="<?php  echo url('cloud/upgrade');?>">自动更新</a></li>
	<?php  if($step == 'schemas') { ?><li class="active"><a href="javscript:;">升级处理</a></li><?php  } ?>
</ul>

<div class="clearfix">
	<?php  if($step == 'files') { ?>
	<?php  if(empty($packet['files'])) { ?>
		<script type="text/javascript">
			<?php  if($type == 'module') { ?>
			location.href = '<?php  echo url("cloud/process", array("step" => "schemas", "m" => $m, "is_upgrade" => $is_upgrade, "type" => $type));?>';
			<?php  } else { ?>
			location.href = '<?php  echo url("cloud/process", array("step" => "schemas", "t" => $m, "is_upgrade" => $is_upgrade, "type" => $type));?>';
			<?php  } ?>
		</script>
	<?php  } ?>
	<div class="alert alert-warning">
		正在更新系统文件, 请不要关闭窗口.
	</div>
	<div class="alert alert-warning">
		如果下载文件失败，可能造成的原因：写入失败，请仔细检查写入权限是否正确。
	</div>
	<div class="alert alert-info form-horizontal ng-cloak" ng-controller="processor">
		<dl class="dl-horizontal">
			<dt>整体进度</dt>
			<dd>{{pragress}}</dd>
			<dt>正在下载文件</dt>
			<dd>{{file}}</dd>
		</dl>
		<dl class="dl-horizontal" ng-show="fails.length > 0">
			<dt>下载失败的文件</dt>
			<dd>
				<p class="text-danger" ng-repeat="file in fails" style="margin:0;">{{file}}</p>
			</dd>
		</dl>
	</div>
	<script>
		require(['angular'], function(angular){
			angular.module('app', []).controller('processor', function($scope, $http){
				$scope.files = <?php  echo json_encode($packet['files']);?>;
				$scope.fails = [];
				var total = $scope.files.length;
				var i = 1;
				var errormsg = '';
				var proc = function() {
					var path = $scope.files.pop();
					if(!path) {
						if($scope.fails.length == 0 || confirm('有部分文件未成功更新, 错误信息：' + errormsg + ', 是否继续下一步？')) {
							setTimeout(function(){
								<?php  if($packet['type'] == 'theme') { ?>
								location.href = '<?php  echo url("cloud/process/", array("step" => "schemas", "t" => $m, "is_upgrade" => $is_upgrade));?>';
								<?php  } else { ?>
								location.href = '<?php  echo url("cloud/process/", array("step" => "schemas", "m" => $m, "is_upgrade" => $is_upgrade));?>';
								<?php  } ?>
								
							}, 2000);
						}
						return;
					}
					$scope.file = path;
					$scope.pragress = i + '/' + total;
					var params = {path: path, type : '<?php  echo $packet['type']?>'};
					$http.post(location.href, params).success(function(dat){
						i++;
						if(dat != 'success') {
							$scope.fails.push('['+dat+'] ' + path);
							errormsg = dat;
						}
						proc();
					}).error(function(){
						i++;
						$scope.fails.push(path);
						proc();
					});
				}
				proc();
			});
			angular.bootstrap(document, ['app']);
		});
	</script>
	<?php  } ?>
	<?php  if($step == 'schemas') { ?>
		<?php  if(empty($packet['schemas'])) { ?>
			<!-- 如果是安装模块,数据库操作完成后,不处理script,直接跳转到extension/module/install -->
			<?php  if(!empty($packet['install'])) { ?>
				<?php  if($packet['type'] == 'theme') { ?>
				<script>
					location.href = '<?php  echo url("extension/theme/install", array("templateid" => $m, "flag" => 1));?>';
				</script>
				<?php  } else { ?>
				<script>
					location.href = '<?php  echo url("extension/module/install", array("m" => $m, "flag" => 1));?>';
				</script>
				<?php  } ?>
			<?php  } ?>
			<?php  if($packet['type'] == 'theme') { ?>
			<script>
				location.href = '<?php  echo url("cloud/process", array("step" => "scripts", "t" => $m, "is_upgrade" => $is_upgrade));?>';
			</script>
			<?php  } else { ?>
			<script>
				location.href = '<?php  echo url("cloud/process", array("step" => "scripts", "m" => $m, "is_upgrade" => $is_upgrade));?>';
			</script>
			<?php  } ?>
			
		<?php  } ?>
		<div class="alert alert-warning">
			正在更新数据库, 请不要关闭窗口.
		</div>
		<div class="alert alert-info form-horizontal ng-cloak" ng-controller="processor">
			<dl class="dl-horizontal">
				<dt>整体进度</dt>
				<dd>{{pragress}}</dd>
				<dt>正在处理数据表</dt>
				<dd>{{schema}}</dd>
			</dl>
			<dl class="dl-horizontal" ng-show="fails.length > 0">
				<dt>处理失败的数据表</dt>
				<dd>
					<p class="text-danger" ng-repeat="schema in fails" style="margin:0;">{{schema}}</p>
				</dd>
			</dl>
		</div>
		<script>
			require(['angular', 'util'], function(angular, u){
				angular.module('app', []).controller('processor', function($scope, $http){
					$scope.schemas = <?php  echo json_encode($schemas);?>;
					$scope.fails = [];
					var is_m_install = "<?php  echo $packet['install']?>";
					var total = $scope.schemas.length;
					var i = 1;
					var error = function() {
						require(['util'], function(u){
							u.message('未能成功执行处理数据库, 请联系开发商解决. ');
						});
					}
					var proc = function() {
						var schema = $scope.schemas.pop();
						if(!schema) {
							if($scope.fails.length > 0) {
								error();
								return;
							} else {
								setTimeout(function(){
									if(is_m_install == 1) {
										location.href = '<?php  echo url("extension/module/install", array("m" => $m, "flag" => 1));?>';
									} else {
										location.href = '<?php  echo url("cloud/process", array("step" => "scripts", "m" => $m, "is_upgrade" => $is_upgrade, "is_confirm" => 1));?>';
									}
								}, 2000);
								return;
							}
						}
						$scope.schema = schema;
						$scope.pragress = i + '/' + total;
						var params = {table: schema};
						$http.post(location.href, params).success(function(dat){
							i++;
							if(dat != 'success') {
								$scope.fails.push(schema)
							}
							if (dat['message']) {
								u.message(dat['message']);
								return;
							}
							proc();
						}).error(function(){
							i++;
							$scope.fails.push(schema);
							proc();
						});
					}
					proc();
				});
				angular.bootstrap(document, ['app']);
			});
		</script>
	<?php  } ?>
	<?php  if($step == 'scripts') { ?>
		<?php  if(empty($packet['scripts']) || !empty($packet['type'])) { ?>
			<!-- 如果是更新模块,跳转到extension/module/upgrade -->
			<?php  if($is_upgrade == 1) { ?>
				<?php  if($packet['type'] == 'theme') { ?>
				<script>
					location.href = '<?php  echo url("extension/theme/upgrade", array("templateid" => $m, "flag" => 1));?>';
				</script>
				<?php  } else { ?>
				<script>
					location.href = '<?php  echo url("extension/module/upgrade", array("m" => $m, "flag" => 1));?>';
				</script>
				<?php  } ?>
				
			<?php  } ?>
			<script>
				var is_confirm = "<?php  echo $_GPC['is_confirm']?>";
				if(is_confirm == 1) {
					if(confirm('已经成功执行升级操作! '+"\n"+' 由于数据库更新, 可能会产生多余的字段. 你可以按照需要删除')) {
						location.href = '<?php  echo url("system/database/trim");?>';
					} else {
						location.href = '<?php  echo url("cloud/upgrade");?>';
					}
				} else {
					require(['util'], function(u){
						u.message('已经成功执行升级操作! '+"\n"+' 由于数据库更新, 可能会产生多余的字段. 你可以按照需要删除.', '<?php  echo url("system/database/trim");?>');
					});
				}
			</script>
		<?php  } ?>
		<div class="alert alert-warning">
			正在数据迁移及清理操作, 请不要关闭窗口.
		</div>
		<div class="alert alert-info form-horizontal ng-cloak" ng-controller="processor">
			<dl class="dl-horizontal">
				<dt>整体进度</dt>
				<dd>{{pragress}}</dd>
				<dt>正在处理</dt>
				<dd>{{script}}<br />{{message}}</dd>
			</dl>
			<dl class="dl-horizontal" ng-show="fails.length > 0">
				<dt>处理失败的操作</dt>
				<dd>
					<p class="text-danger" ng-repeat="script in fails" style="margin:0;">{{script}}</p>
				</dd>
			</dl>
		</div>
		<script>
			require(['angular'], function(angular){
				angular.module('app', []).controller('processor', function($scope, $http){
					$scope.scripts = <?php  echo json_encode($scripts);?>;
					$scope.fails = [];
					
					var is_upgrade = "<?php  echo $is_upgrade?>";
					var total = $scope.scripts.length;
					var i = 1;
					var error = function() {
						require(['util'], function(u){
							u.message('未能成功执行清理升级操作, 请联系开发商. ');
						});
					}
					var proc = function() {
						var script = $scope.scripts.shift();
						if(!script) {
							if($scope.fails.length > 0) {
								error();
							} else {
								if(is_upgrade == 1) {
									location.href = '<?php  echo url("extension/module/upgrade", array("m" => $m, "flag" => 1));?>';
									return;
								}
								
								var is_confirm = "<?php  echo $_GPC['is_confirm']?>";
								if(is_confirm == 1) {
										if(confirm('已经成功执行升级操作! '+"\n"+' 由于数据库更新, 可能会产生多余的字段. 你可以按照需要删除')) {
										location.href = '<?php  echo url("system/database/trim");?>';
									} else {
										location.href = '<?php  echo url("cloud/upgrade");?>';
									}
								} else {
									require(['util'], function(u){
										u.message('已经成功执行升级操作! '+"\n"+' 由于数据库更新, 可能会产生多余的字段. 你可以按照需要删除.', '<?php  echo url("system/database/trim");?>');
									});
								}
								return;
							}
						}
						$scope.script = script.fname;
						$scope.message = script.message;
						$scope.pragress = i + '/' + total;
						var params = {fname: script.fname};
						$http.post(location.href, params).success(function(dat){
							i++;
							if(dat != 'success') {
								$scope.fails.push(script.fname)
								error();
								return;
							}
							proc();
						}).error(function(){
							i++;
							$scope.fails.push(script.fname);
							error();
						});
					}
					proc();
				});
				angular.bootstrap(document, ['app']);
			});
		</script>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
