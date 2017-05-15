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
                <?php  if($ac!='list') { ?>
                 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/department_edit', TEMPLATE_INCLUDEPATH)) : (include template('../admin/department_edit', TEMPLATE_INCLUDEPATH));?>
                <?php  } else { ?>
                <div class='row'>
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                 	 <input type='hidden' value='<?php  echo $model;?>' name='model'>
                          <div class="col-md-12 col-sm-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-navicon"></i><?php  if($op!='add_admin') { ?>选择需要管理的部门<?php  } else { ?><?php  echo $result['department_name'];?><?php  } ?></div>
                                       <div class="tools">
                                        <?php  if($op=='add_admin') { ?>
                                            <a href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'], 'op' => 'add_admin','ac'=>'new'))?>" data-toggle="modal" style="color:#fff"><i class="fa fa-plus"></i>添加成员 </a>
                                        <?php  } ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <?php  if($op=='add_admin') { ?>
                                                <tr>
                                                    <th> 姓名 </th>
                                                    <th> 添加时间 </th>
                                                    <th> 角色 </th>
                                                    <th> 账号 </th>
                                                    <th></th>
                                                </tr>
                                            <?php  } else { ?>
                                                <tr>
                                                    <th> 部门名 </th>
                                                    <th> 添加时间 </th>
                                                    <th> 部门性质 </th>
                                                    <th> 部门主管 </th>
                                                    <th></th>
                                                </tr>
                                            <?php  } ?>
                                        </thead>
                                        <tbody>
                                            <?php  if($op=='add_admin') { ?>
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php  echo $item['admin_name'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$item['de_add_time']);?></td>
                                                        <td><?php  echo $class_department->level[$item['level']]?></td>
                                                        <td><?php  echo $item['passport'];?></td>
                                                        <td style="text-align: center" > 
                                                            <a  href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'],'peadmin_id'=>$item['admindepart_id'], 'op' => 'add_admin','ac'=>'edit'))?> " class="btn blue">
                                                                        <i class="fa fa-edit"></i> 编辑 </a>
                                                            <a href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'],'peadmin_id'=>$item['admindepart_id'],'op' => 'add_admin','ac'=>'delete'))?>" 
                                                                onclick="return confirm('此操作不可恢复，确认删除？');"
                                                                class="btn red" title="删除"><i class="fa fa-trash-o"></i>
                                                                删除
                                                            </a>  
                                                        </td>
                                                    </tr>                                           
                                                <?php  } } ?>
                                            <?php  } else { ?>
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php  echo $item['department_name'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                        <td><?php  echo $item['property'];?></td>
                                                        <td><?php  echo $item['main_admin'];?></td>
                                                        <td style="text-align: center">
                                                                <a  href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'department','ac'=>'edit'))?> " class="btn blue">
                                                                            <i class="fa fa-edit"></i> 编辑
                                                                </a>
                                                                <a href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'department','ac'=>'delete'))?>" 
                                                                    onclick="return confirm('此操作不可恢复，确认删除？');"
                                                                    class="btn red" title="删除"><i class="fa fa-trash-o"></i>
                                                                    删除
                                                                </a>  
                                                                <a href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'add_admin','ac'=>'list' ))?>" class="btn yellow " target="_blank" >
                                                                    <i class="fa fa-eye"></i>查看成员
                                                                </a>
                                                        </td>
                                                    </tr>                                           
                                                <?php  } } ?>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
                       <div style="clear:both"></div>
                    </form>
                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
            <script>
                function checkBox(){
                    $(".teacher_checkbox").prop("checked",true);
                }
            </script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <!--筛选表格-->
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>        
    </body>
    </html>
    <?php  } ?>