<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<?php  if($op == 'list') { ?>
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('systemFix')?>">功能列表</a>
	</li>
	<?php  } else if($op=='fix_file') { ?>
		<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo $this->createWebUrl('systemFix')?>">文件更新列表</a>
		</li>	
	<?php  } else if($op=='update_school_grade_class_student') { ?>
		<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo $this->createWebUrl('systemFix')?>">打卡数据更新进度</a>
		</li>	
	<?php  } ?>
</ul>

<div class="main">
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<?php  if($op == 'list') { ?>
				<tr>
					<th>功能名</th>
					<th>功能关键字</th>
					<th>操作</th>
				</tr>
				<?php  } else if($op=='fix_file') { ?>
				<tr>
					<th>文件</th>
					<th>路径</th>
					<th>最新版本</th>
					<th>状态</th>
				</tr>				
				<?php  } else if($op=='update_school_grade_class_student') { ?>
				<tr>
					<th>班级</th>
					<th>状态</th>
				</tr>						
				<?php  } ?>
			</thead>
			<tbody>
				<?php  if($op =='list') { ?>
				<tr>
					<td>数据库升级</td>
					<td>每日都可点击</td>
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'fix_table' ))?>">点击升级</a>
					</td>
				</tr>
				<?php  if($count>100) { ?>
				<tr>
					<td>文件升级</td>
					<td>每日都可点击</td>
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'fix_file' ))?>">点击升级</a>
					</td>
				</tr>		
				<?php  } else { ?>
				<tr>
					<td>文件初始化</td>
					<td>第一次必点</td>
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'init_file' ))?>">初始化</a>
					</td>
				</tr>				
				<?php  } ?>
				<tr>
					<td>打卡数据更新(班级)</td>
					<td>无打卡设备不需点击</td>
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'update_school_grade_class_student' ))?>">点击升级</a>
					</td>
				</tr>	
				<tr>
					<td>学校管理人员权限更新</td>
					<td>会补充家校通新增功能</td>	
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'up_school_admin' ))?>">点击更新</a>
					</td>				
				</tr>
				<tr>
					<td>教师权限更新</td>
					<td>会补充家校通新增功能</td>	
					<td>
                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'up_teacher' ))?>">点击更新</a>
					</td>				
				</tr>							
				<?php  } else if($op=='fix_file') { ?>
					<?php  if($file_list) { ?>
						<?php  if(is_array($file_list)) { foreach($file_list as $row) { ?>
							<tr>
								<td class='file_name' data-id="<?php  echo $row['id'];?>" data-status='1' ><?php  echo $row['file_name'];?></td>
								<td><?php  echo $row['file_local'];?></td>
								<td><?php  echo $row['version'];?></td>
								<td id='status<?php  echo $row['id'];?>'>未更新</td>
							</tr>
						<?php  } } ?>
					<?php  } ?>
				<?php  } else if($op=='update_school_grade_class_student') { ?>
						<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
							<tr class='class_list' data-status='0' data-id= "<?php  echo $row['class_id'];?>" >
								<td ><?php  echo $row['class_name'];?></td>
								<td > 未更新</td>
							</tr>
						<?php  } } ?>													
				<?php  } ?>	
			</tbody>
		</table>
	</div>
	</div>
</div>
<?php  if($op=="update_school_grade_class_student") { ?>
	<script>
		var page=0;
		var count=4;		
		$(function(){
		if(count>0){
			if(confirm("确认将进入更新数据进程，未更新完请勿关闭此网页"))
				ajaxUp();
		}
		});
		//班级数据
		function ajaxUp(){
			var obj;
			var class_id;
			$.each($(".class_list"),function(i,e){
				status=$(this).attr("data-status");
				if(status==0){
						obj 	 = $(this);
						class_id = obj.attr("data-id");	
						$.ajax({
							type:"POST",
							url:'<?php  echo $this->createWebUrl("ajax");?>',            
							async:'false',
							dataType:'json',
							data:{class_id:class_id,ac:'update_school_grade_class_student'},
							success:function(dataJson){
								changeStatus(dataJson,obj);
								return false;
							} 
						});					
					return false;					
				}
			});

		}    
		function changeStatus(dataJson,obj){
			if(dataJson.errcode==1)
			{
				alert(dataJson.msg);
				return false;
			}else{
				obj.attr("data-status",1);
				obj.find("td").eq(1).html(dataJson.add_time+"&nbsp;更新了");
				ajaxUp();
			}
		}		
	</script>
<?php  } ?>
<?php  if($op=='fix_file') { ?>
	<script>
		var page=0;
		var xid=0;
		var count=<?php  echo count($file_list);?>;
		$(function(){
		if(count>0){
			if(confirm("确认将进入更新进程，未更新完请勿关闭此网页")){
				xid=setInterval("getNextSend()",2000);
			}
		}
		});
		function getNextSend(){
		var send = false;
		all_list = $('.file_name');
		$.each(all_list,function(i,e){
			if($(this).attr('data-status')==1){
				ajaxUp($(this).attr("data-id"),$(this));
				send=true;
				return false;
			}
		});
		if(!send){
				clearInterval(xid);
				alert("已经全部更新完毕！");     
			}
		}
		function ajaxUp(file_id,obj){
			$.ajax({
			type:"POST",
			url:'<?php  echo $this->createWebUrl("ajax");?>',            
			async:'false',
			dataType:'json',
			data:{file_id:file_id,ac:'update_file'},
			success:function(dataJson){
				changeStatus(dataJson.status,dataJson.end_time,obj,file_id,dataJson.msg);
			} 
		});
		}    
		function changeStatus(status,end_time,obj,file_id,msg){
			obj.attr('data-status',status);
			if(status==2){
				$("#status"+file_id+"").html('<code>更新了</code>');     
		    }
			if(status==1){
				$("#status"+file_id+"").html(msg);     
		    }			
			if(status==10){
				clearInterval(xid);
			}
		}
	</script>
<?php  } ?>
