<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>

        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
            <?php  if($op == 'list') { ?>
                <?php  if($ac == 'list') { ?>
                    <?php  $page ='功能列表';?>
                <?php  } ?> 
                <?php  if($ac == 'system_params_set') { ?>
                    <?php  $page ='系统参数设置';?>
                <?php  } ?> 
                <?php  if($ac == 'school_type_set') { ?>
                    <?php  $page ='学校类型设置';?>
                <?php  } ?> 
            <?php  } else if($op=='fix_file') { ?>
                    <?php  $page ='文件更新列表';?>
            <?php  } else if($op=='update_school_grade_class_student') { ?>
                    <?php  $page ='打卡数据更新进度';?>
            <?php  } ?>

                <?php  if($op=='list' && $ac=='system_params_set') { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> <?php  echo $page;?> </p>
                            </div>
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> 家云参数【非论坛账号：一般为截图里的账号密码】</div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>家云账号</label>
                                            <div class="col-sm-9 col-xs-8">
                                                <input type="text" name="jia_passport" id="jia_passport" class="form-control" value='<?php  echo $jiayun_passport;?>' />
                                           	  <span class="help-block"> 不是论坛账号 </span>
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
                    </div>
                <?php  } ?>
                <?php  if($op=='list' && $ac=='school_type_set') { ?>
                  <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> <?php  echo $page;?> </p>
                            </div>

                            <ul class="nav nav-tabs">
                                <li <?php  if($method == 'list') { ?>class="active" <?php  } ?>>
                                    <a href="<?php  echo $this->createWebUrl('systemFix',array('ac'=>'school_type_set','method'=>'list') )?>">列表</a>
                                </li>
                                <li <?php  if($method == 'edit') { ?> class="active" <?php  } ?>>
                                    <a href="<?php  echo $this->createWebUrl('systemFix',array('ac'=>'school_type_set','method'=>'edit') )?>">编辑</a>
                                </li>
                                <li <?php  if($method == 'new') { ?> class="active" <?php  } ?>>
                                    <a href="<?php  echo $this->createWebUrl('systemFix',array('ac'=>'school_type_set','method'=>'new') )?>">新增</a>
                                </li>
                            </ul>
                            <?php  if($method=='list') { ?>
                            <div class="main">
                                <div class="panel panel-info">
                                <div class="panel-heading">筛选</div>
                                <div class="panel-body">
                                    <form action="<?php  echo $this->createWebUrl('systemfix',array('ac'=>'school_type_set'))?>" method="post" class="form-horizontal" role="form">
                                        <input type="hidden" name="method" value="list" />
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">学校类型</label>
                                            <div class="  col-sm-10">
                                                <select name='school_type_id' class="form-control">
                                                    <option value='0'>全部</option>
                                                    <?php  if(is_array($type_list)) { foreach($type_list as $row) { ?>
                                                        <option value='<?php  echo $row['id'];?>' <?php  if($_GPC['school_type_id'] ==$row['id']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>
                   
                                             <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                      <input type="submit" name="submit" class="btn blue" value="确认">
                                                    </div>
                                                </div>
                                            </div>                                          
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body table-responsive">
                                    <table class="table table-hover">
                                        <thead class="navbar-inner">
                                            <tr>
                                                <th>学校类型</th>
                                                <th>年级名</th>
                                                <th>入学年份数</th>
                                                <th>时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo S("school","getSchoolTypeName",array($item['school_type']));?></td>
                                                <td><?php  echo $item['grade_name'];?></td>
                                                <td><?php  echo $item['grade_sort'];?></td>
                                                <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                <td >
                                                    <a href="<?php  echo $this->createWebUrl('systemfix', array('id' => $item['type_id'],'method'=>'edit','ac'=>'school_type_set'))?>"
                                                        class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            <?php  } ?>
                            <?php  if($method=='new' || $method=='edit') { ?>
                                <div class="main">
                                <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class='form-group'>
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                    <select name='school_type_id'>
                                                        <?php  if(is_array($type_list)) { foreach($type_list as $row) { ?>
                                                            <option value='<?php  echo $row['id'];?>' <?php  if($row['id'] == $result['school_type']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                    </div>	
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>年级名</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <input type="text" name="grade_name" class="form-control" value='<?php  echo $result['grade_name'];?>'/>
                                                        <?php  if($ac=='edit') { ?>
                                                        <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['type_id'];?>' />
                                                        <?php  } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>入学年份数（数字越大越靠近毕业）</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <input type="number" name="grade_sort" class="form-control" value='<?php  echo $result['grade_sort'];?>' placeholder="数字"/>
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
                            <?php  } ?>
                            </div>
                            </div>
                <?php  } ?>
                <?php  if($ac != 'system_params_set' && $ac !='school_type_set' ) { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> <?php  echo $page;?> </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i><?php  echo $page;?>  </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content" >
                                        <thead class="flip-content">
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
                                        <tbody id='file_list'>
                                                <?php  if($op =='list') { ?>
                                                <tr>
                                                    <td>数据库升级【系统级】</td>
                                                    <td>每日都可点击</td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'fix_table'))?>"><i class="fa fa-cloud-download"></i>点击升级</a>
                                                    </td>
                                                </tr>
                                                <?php  if($count>100) { ?>
                                                <tr>
                                                    <td>文件升级【系统级】</td>
                                                    <td>每日都可点击 <a target="_blank" href="http://bbs.jiaxt.cn/thread-236.htm">（11/7）查看更新日志</a><a target="_blank" href="http://bbs.jiaxt.cn/forum-4.htm">（7/14）查看更新日志</a></td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'fix_file' ))?>"><i class="fa fa-cloud-download"></i>点击升级</a>
                                                    </td>
                                                </tr>		
                                                <?php  } else { ?>
                                                <tr>
                                                    <td>文件初始化【系统级】</td>
                                                    <td>第一次必点</td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'init_file' ))?>">文件版本初始化</a>
                                                    </td>
                                                </tr>				
                                                <?php  } ?>
                                                <!--<tr>
                                                    <td>打卡数据更新(班级)【单公众号】</td>
                                                    <td>无打卡设备不需点击</td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'update_school_grade_class_student' ))?>"><i class="fa fa-cloud-download"></i>点击升级</a>
                                                    </td>
                                                </tr>	-->
                                                <tr>
                                                    <td>本年度年级升级【系统级】</td>
                                                    <td>升年级操作-只可在七八月份操作<code>【务必按教程设置好】</code></td>	
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'up_grade' ))?>"><i class="fa fa-cloud-download"></i>点击升级</a>
                                                        请先阅读：<a href='http://bbs.jiaxt.cn/thread-35.htm'>年级升级设置教程</a> 设置好
                                                    </td>				
                                                </tr>											                                             
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
                    </div>
                    <?php  if($op == 'fix_file') { ?>
                            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/modals', TEMPLATE_INCLUDEPATH)) : (include template('../admin/modals', TEMPLATE_INCLUDEPATH));?>
                            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/fileUpdate', TEMPLATE_INCLUDEPATH)) : (include template('../admin/fileUpdate', TEMPLATE_INCLUDEPATH));?>
                    <?php  } ?>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
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
 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>