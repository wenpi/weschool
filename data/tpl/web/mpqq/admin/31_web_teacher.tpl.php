<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_GPC['print_bd_code']==1) { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/print_bd_code', TEMPLATE_INCLUDEPATH)) : (include template('../admin/print_bd_code', TEMPLATE_INCLUDEPATH));?>
    <?php  exit();?>
<?php  } ?>

   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增老师<?php  } else { ?>修改<?php  } ?> </span>
                                        <?php  if($_GPC['text']) { ?>
                                            <br>
                                            <span class="caption-subject bold uppercase" style="color:#ff0033">【<?php  echo $_GPC['text'];?>】</span>
                                        <?php  } ?>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class='form-group'>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>选择其授课的班级</label>
                                            <div class="col-sm-10">
                                                <?php  $grade_id=0;?>
                                                <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                <?php  $i++;?>
                                                <?php  if($grade_id !=$row['grade_id'] ) { ?> <?php  $grade_id=$row['grade_id'];?> <?php  if($i!=1 ) { ?><br><?php  } ?> 【<?php  echo $this->gradeName($grade_id);?>】<?php  } ?>
                                                <input type='checkbox'
                                                    onchange='teacher_class_change()'
                                                    value='<?php  echo $row['class_id'];?>' 
                                                    class='class_s'
                                                    name='class_s[<?php  echo $i;?>]' 
                                                    <?php  if(@in_array($row['class_id'],$result['class_s'])) echo 'checked' ;?>>
                                                &nbsp;
                                                <span onclick='change_check_status("class_s[<?php  echo $i;?>]")' class='hover_point' ><?php  echo $row['class_name'];?></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php  } } ?>
                                            </div>	
                                        </div>	
                                        <div class='form-group'>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>选择其负责的课程</label>
                                            <div class="col-sm-10" id="course_list">
                                                <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                <input type='checkbox' class='box_type'  value='<?php  echo $row['course_id'];?>' name='course_id[]' <?php  if(@in_array($row['course_id'],$result['course_ids']) ) { ?> checked <?php  } ?>>&nbsp;<?php  echo $row['course_name'];?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php  } } ?>
                                              <div class='btn  btn-primary  ' onclick="allSelect('box_type')">全选</div>
                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>教师姓名</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="teacher_realname" id="teacher_realname" class="form-control" value='<?php  echo $result['teacher_realname'];?>'required />
                                                <?php  if($ac=='edit') { ?>
                                                <input type="hidden" name="id"   value='<?php  echo $result['teacher_id'];?>' />
                                                <input type="hidden" name="uid"   value='<?php  echo $result['uid'];?>' />
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">教师电话</label>
                                            <div class="col-sm-9 col-xs-8">
                                                <input type="text" name="teacher_telphone" id="teacher_telphone" class="form-control" value='<?php  echo $result['teacher_telphone'];?>' />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">教师邮箱</label>
                                            <div class="col-sm-9 col-xs-8">
                                                <input type="text" name="teacher_email" id="teacher_email" class="form-control" value='<?php  echo $result['teacher_email'];?>' />
                                            </div>
                                        </div>								
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>教师照片</label>
                                            <div class="col-sm-9 col-xs-8">
                                                <?php  echo tpl_form_field_image('teacher_img',$result['teacher_img']);?>
                                            </div>
                                        </div>	
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">教师微信二维码</label>
                                            <div class="col-sm-9 col-xs-8">
                                                <?php  echo tpl_form_field_image('weixin_code',$result['weixin_code']);?>
                                            </div>
                                        </div>					
                                                    
                                        <div class='form-group'>
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>教师简介</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <?php  echo tpl_ueditor('teacher_introduce',$result['teacher_introduce']);?>
                                            </div>	
                                        </div>
                                        
                                        <div class='form-group'>
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统账号</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <?php  if($ac=='edit') { ?>
                                                    <input type="text" class="form-control edited" readonly="" value="<?php  echo $result['passport'];?>" required>
                                                <?php  } else { ?>
                                                    <input name='passport' class='form-control' value=''>
                                                <?php  } ?>
                                            </div>	
                                        </div>
                                        <div class='form-group'>
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统密码</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <?php  if($ac=='edit') { ?>
                                                    留空不修改
                                                <?php  } ?>
                                                <input name='password' class='form-control' value=''>
                                            </div>	
                                        </div>								
                                        <?php  if($ac=='edit') { ?>
                                            <div class='form-group'>
                                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                                            <div class="col-sm-9 col-xs-8">
                                            <select name='status'  class='form-control' >
                                                    <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                            </select>
                                            </div>							
                                            </div>
                                        <?php  } ?>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                    </div>
                                                </div>
                                            </div>  

                                     </form>
                                  </div>    
                             </div>            
                      </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选教师</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="teacher" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="aw" value="1" />
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">姓名</label>
                                                            <div class="col-md-4">
                                                                <input name='teacher_realname' class="form-control"  id='teacher_realname' value="<?php  echo $_GPC['teacher_realname'];?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-group last">
                                                            <label class="control-label col-md-3">状态</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control school_class_list" name="status" >
                                                                            <option value='0'>全部</option>
                                                                            <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected <?php  } ?> >正常</option>
                                                                            <option value="2" <?php  if($_GPC['status'] == '2') { ?> selected <?php  } ?> >关闭</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索"></button>
                                                                     <button class="btn btn-default" type="button">总记录数：<?php  echo $num;?></button>		
                                                                     <?php  if($have_up) { ?>
                                                                         <a href="<?php  echo $this->createWebUrl('teacher',array('ac'=>'up_to_new') )?>"><button class="btn red" type="button">请马上点击此处升级到新的账户体系</button></a>	
                                                                     <?php  } ?>
                                                                    <button class="btn btn-default" name='print_bd_code' value='1' >统一打印绑定二维码</button>				
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>
                             </div>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>教师列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th > 教师姓名</th>
                                                <th class="numeric"> 教师电话 </th>
                                                <th > 教师账号 </th>
                                                <th > 课程 </th>
                                                <th > 关联的微信账号 </th>
                                                <th > 状态 </th>
                                                <th > 班主任 </th>
                                                <th > 添加时间 </th>
                                                <th >  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr> 
                                                    <td><?php  echo $item['teacher_realname'];?></td>
                                                    <td><?php  echo $item['teacher_telphone'];?></td>
                                                    <td><?php  echo $item['username'];?></td>
                                                    <td><?php  echo $this->teacherCourse($item['teacher_id'],'echo');?></td>
                                                    <td>
                                                        <?php  if($item['uid']) { ?>
                                                        <?php  $fanid = $this->class_base->mobileGetFanidByUid($item['uid']);?>
                                                        <?php  echo $this->find_user($fanid);?>
                                                        <?php  } ?>
                                                    </td>
                                                    <td>
                                                        <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?>
                                                    </td>
                                                    <td><?php  if($result=$this->classHead($item['teacher_id'])) { ?>
                                                        <a class='a_use_title' href='' title="<?php  echo $this->echoArrOne($result,'class_name');?>">班主任</a>
                                                        <?php  } else { ?>否
                                                        <?php  } ?>
                                                        </td>
                                                    <td><?php  echo date("Y-m-d",$item['addtime']);?></td>
                                                    <td style="text-align:center;">
                                                        <a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'edit','aw'=>1 ))?>"
                                                            class="btn btn-outline btn-circle btn-sm purple" >
                                                            <i class="fa fa-pencil"></i>编辑
                                                        </a>
                                                        <a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'delete' ,'aw'=>1  ))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-outline btn-circle  dark btn-sm black " >
                                                            <i class="fa fa-times"></i>删除
                                                        </a>
                                                        <?php  if($item['uid']) { ?>
                                                            <a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'unbundling' ,'aw'=>1  ))?>"  class="btn btn-outline btn-circle  dark btn-sm black" >
                                                                <i class="fa fa-trash-o"></i>解绑
                                                            </a>
                                                        <?php  } else { ?>
                                                          <a href="<?php  echo $this->createWebUrl('qrcode', array('id' => $item['teacher_id'], 'op' => 'teacher_bd_qr' ))?>" class="btn btn-outline btn-circle red btn-sm " target="_blank" title="打印绑定二维码"><i class="fa fa-barcode"></i>绑定
                                                        <?php  } ?>
                                                   </td>
                                                </tr>
                                                <?php  } } ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>