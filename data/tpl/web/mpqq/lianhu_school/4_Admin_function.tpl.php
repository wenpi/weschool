<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_GPC['print_code']==1) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('print_code', TEMPLATE_INCLUDEPATH)) : (include template('print_code', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('admin_function')?>">功能列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('admin_function', array( 'ac' => 'edit'))?>">编辑功能</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('admin_function', array('ac' => 'new'))?>">升级必点（还原）</a>
	</li>	
</ul>

<?php  if($ac=='list') { ?>
<div class="main">
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>ID</th>
					<th>功能名</th>
					<th>功能关键字</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['eid'];?></td>
					<td><?php  echo $item['title'];?></td>
					<td><?php  echo $item['do'];?></td>
					<td><?php  if($item['module']=='lianhu_school' ) { ?>正常<?php  } else { ?>隐藏<?php  } ?></td>
					<td>
                        <?php  if($item['module']=='lianhu_school' ) { ?>
                        <span><a  class='red'  href="<?php  echo $this->createWebUrl('admin_function',array('eeid'=>$item['eid'],'change'=>'lianhu_school_display','ac'=>'edit'))?>">隐藏它</a></span>
                        <?php  } else { ?>
                        <a href="<?php  echo $this->createWebUrl('admin_function',array('eeid'=>$item['eid'],'change'=>'lianhu_school','ac'=>'edit'))?>">显示它</a>
                        <?php  } ?>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<?php  } ?>

<?php  } ?>