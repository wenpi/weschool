<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('appointment',array('aid'=>$aid));?>">申请列表</a>
	</li>
	<?php  if($aname) { ?>
		<li>
			<a href=""><?php  echo $aname;?></a>
		</li>
	<?php  } ?>
</ul>
<div class='main'>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<?php  if(!$aname) { ?>
					<th style="width:10%">名称</th>
					<?php  } ?>
					<th>学生名</th>
					<th>年级班级</th>
					<th>添加时间</th>
					<th>申请理由</th>
					<th>项目</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>			
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
						<tr>
							<?php  if(!$aname) { ?>
							<td><?php  echo $row['appointment_name'];?></td>
							<?php  } ?>
							<td><?php  echo $row['student_name'];?></td>
							<td><?php  echo  $this->className($row['class_id']);?></td>
                            <td><?php  echo date('Y-m-d H:i:s',$row['addtime'])?></td>
							<td><?php  echo $row['reason'];?></td>
							<td><?php  echo $row['my_course'];?></td>
							<td><?php  if($row['status']==0) { ?>默认通过<?php  } else if($row['status']==2) { ?>不通过<?php  } ?></td>
							<td><a href="javascript:;" onclick="apply_no(<?php  echo $row['list_id'];?>)">不通过</a></td>
						</tr>		
				<?php  } } ?>
			</tbody>
			</table>
		</div>
</div>
<a class='btn btn-primary' href="<?php  echo $this->createWebUrl('applist',array('excel_out'=>'yes','aid'=>$_GPC['aid']));?>">数据导出 </a>
<div id='black_mu' style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;background:rgba(0,0,0,0.5);z-index:300">
	<form method="post" action="<?php  echo $this->createWebUrl('applist')?>">		
	<div style="width:300px;margin:20% auto; height:400px;">
		<b style="color:#fff">理由：</b>
			<textarea name='content' id="content" class='form-control'></textarea>
			<input type='hidden' name='list_id' id="list_id">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-3" id="submit" style="margin-top:10px;margin-left:100px;" />
			<button class="btn btn-primary col-lg-3" onclick="hide_button()" style="margin-top:10px;margin-left:20px;">关闭</button>
</form>
</div>
</div>
<script>
 var list_id=0;
	function apply_no(list_id){
		$('#black_mu').show();
		list_id=list_id;
		$('#list_id').val(list_id);
	}
	function hide_button(){
		$('#black_mu').hide();
	}
</script>
