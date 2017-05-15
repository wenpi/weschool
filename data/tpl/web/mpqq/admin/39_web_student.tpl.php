<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_GPC['print_code']==1) { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/print_code', TEMPLATE_INCLUDEPATH)) : (include template('../admin/print_code', TEMPLATE_INCLUDEPATH));?>
    <?php  exit();?>
<?php  } else if($_GPC['print_bd_code']==1) { ?>
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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增学生<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class='form-group  form-md-line-input'>
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>主班级</label>
                                            <div class="col-sm-10">
                                            <?php  if($admin=='teacher') { ?>
                                                <select id="class_id" class="form-control" name="class_id">
                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                        <option value='<?php  echo $row['class_id'];?>'><?php  echo $row['class_name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            <?php  } else { ?>
                                                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('grade_class', TEMPLATE_INCLUDEPATH)) : (include template('grade_class', TEMPLATE_INCLUDEPATH));?>
                                            <?php  } ?>
                                            </div>
                                        </div>
                                        <?php  if(D('school')->getSchoolParams('much_class')) { ?>
                                         <div class='form-group  form-md-line-input'>
                                            <label class="col-md-2 control-label font-red-sunglo"><span class="required" aria-required="true"> * </span>副班级数</label>
                                                <div class="col-sm-10">
                                                       <input type="number" class="form-control"  id="class_much_num"  value="<?php  echo $result['fu_class_num'];?>">
                                                </div>
                                            </div>  
                                            <div id="mu_class">
                                                <?php  if(is_array($result['fu_class_list'])) { foreach($result['fu_class_list'] as $class_val) { ?>
                                                   <div class='form-group  form-md-line-input'>
                                                    <label class="col-md-2 control-label font-red-sunglo"><span class="required" aria-required="true"> * </span>副班级</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control fu_class_id " name="fu_class_id[]">
                                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                <option value='<?php  echo $row['class_id'];?>' <?php  if($class_val['class_id'] == $row['class_id']) { ?> selected <?php  } ?> ><?php  echo $this->classGradeName($row['class_id'])?>-<?php  echo $row['class_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                 </div>                                             
                                                <?php  } } ?>
                                            </div>                                            
                                        <?php  } ?>	  
                                        
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 学生姓名</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="student_name" id="student_name" class="form-control" value='<?php  echo $result['student_name'];?>' />
                                                <?php  if($ac=='edit') { ?>
                                                <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['student_id'];?>' />
                                                <?php  } ?>
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 学号</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="xuehao" id="xuehao" class="form-control" value='<?php  echo $result['xuehao'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">家庭住址</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="address" id="address" class="form-control" value='<?php  echo $result['address'];?>' />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>学生联系方式</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="student_link" id="student_link" class="form-control" value='<?php  echo $result['student_link'];?>' />
                                            </div>
                                        </div>												
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>学生头像</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_image('student_img',$result['student_img']);?>
                                            </div>
                                        </div>				
                                        <div class='form-group'>
                                            <label class="col-md-2 control-label">家长信息</label>
                                            <div class="col-sm-10">
                                                姓名：<input type='text'    name='parent_name' value="<?php  echo $result['parent_name'];?>" class="form-control">
                                                联系电话：<input type='text' name='parent_phone' value="<?php  echo $result['parent_phone'];?>" class="form-control">
                                            </div>	
                                        </div>
                                           <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >是否发送短信</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="sms_status"   value='1' <?php  if($result['sms_status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>发送</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="sms_status"   value='0' <?php  if($result['sms_status']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不发送</label>
                                                </div>
                                            </div>
                                        </div>                                              
                                        <?php  if($ac=='edit') { ?>
                                            <div class='form-group'>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control"  >
                                                    <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='3' <?php  if(3 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                            </select>
                                            </div>							
                                            </div>
                                            <div class='form-group'>
                                            <label class="col-md-2 control-label">绑定的微信账号：</label>
                                            <div class="col-sm-10">
                                                <?php  if($result['fanid']) { ?>
                                                    <input name='fanid'  type='checkbox' value='<?php  echo $result['fanid'];?>' checked> <?php  echo $this->find_user($result['fanid']);?> 【<?php  echo D('student')->getRelation($result['student_id'],$result['fanid']); ?> 】  &nbsp;&nbsp;&nbsp;						
                                                <?php  } ?>
                                                <?php  if($result['fanid1']) { ?>
                                                    <input name='fanid1' type='checkbox' value='<?php  echo $result['fanid1'];?>' checked><?php  echo $this->find_user($result['fanid1']);?>【<?php  echo D('student')->getRelation($result['student_id'],$result['fanid1']); ?>】	&nbsp;&nbsp;&nbsp;	
                                                <?php  } ?>
                                                <?php  if($result['fanid2']) { ?>
                                                    <input name='fanid2' type='checkbox' value='<?php  echo $result['fanid2'];?>' checked><?php  echo $this->find_user($result['fanid2']);?>【<?php  echo D('student')->getRelation($result['student_id'],$result['fanid2']); ?>】	&nbsp;&nbsp;&nbsp;	
                                                <?php  } ?>												
                                            </div>	
                                            </div>
                                            <?php  if($result['student_uid']) { ?>
                                              <div class='form-group'>
                                            <label class="col-md-2 control-label">学生的微信账号：</label>
                                            <div class="col-sm-10">
                                                    <input name='student_uid'  type='checkbox' value='<?php  echo $result['student_uid'];?>' checked> <?php  echo D("base")->mobileGetNicknameByUid($result['student_uid']);?> 					
                                            </div>	
                                            </div>

                                            <?php  } ?>
                                        <?php  } ?>        

                                        <div class='form-group'>
                                            <label class="col-md-2 control-label"> ID卡：</label>
                                            <div class="col-sm-10">
                                                    卡一：<textarea   name='rfid'   class='span2' ><?php  echo $result['rfid'];?></textarea>	<br><br>					
                                                    卡二：<textarea   name='rfid1'  class='span2' ><?php  echo $result['rfid1'];?></textarea>   <br><br>					
                                                    卡三：<textarea   name='rfid2'  class='span2' ><?php  echo $result['rfid2'];?></textarea>						
                                            </div>	
                                        </div>
                                         <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">有源RFID值</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="active_rfid" id="active_rfid" class="form-control" value='<?php  echo $result['active_rfid'];?>' />
                                            </div>
                                        </div>   
                                          <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">消费磁卡</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="ic_card" id="ic_card" class="form-control" value='<?php  echo $result['ic_card'];?>' />
                                            </div>
                                        </div>  
                                      <input type="hidden" name="rgrade_id" value='<?php  echo $_GPC['rgrade_id'];?>' />
                                      <input type="hidden" name="rclass_id" value='<?php  echo $_GPC['rclass_id'];?>' />
                                        <?php  if($class_studentCard) { ?>  
                                            <div class="portlet-body form">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label">电子学生卡IMEI</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="studentCardLogin" id="studentCardLogin" class="form-control" value='<?php  echo $result['studentCardLogin'];?>' placeholder="背面的IMEI码" />
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="portlet-body form">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label">电子学生卡密码</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="studentCardPwd" id="studentCardPwd" class="form-control" value='<?php  echo $result['studentCardPwd'];?>' placeholder="123456" />
                                                    </div>
                                                </div>
                                            </div>  

                                        <?php  } ?>                                                                
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
                      </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选学生</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="student" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="aw" value="1" />
                                                        <?php  if($admin !='teacher') { ?>
                                                            <?php  $result = schoolGradeClass(); ?>                                                     
                                                        <div class="form-group ">
                                                           <label class="control-label col-md-3">年级</label>
                                                             <div class="col-md-4">
                                                                        <select name="grade_id" class="form-control" id="school_grade_list"   onchange="onChangeGrade()" >
                                                                            <option value='0'>全部</option>
                                                                            <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                                                <option value='<?php  echo $row['grade_id'];?>' <?php  if($_GPC['grade_id'] ==$row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                                            <?php  } } ?>
                                                                         </select>
                                                             </div>
                                                        </div>
                                                        <?php  } ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">班级</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control school_class_list" name="class_id" class="form-control"  >
                                                                    <option value="0">全部</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">姓名</label>
                                                            <div class="col-md-4">
                                                                <input name='student_name' class="form-control"  id='student_name' value="<?php  echo $_GPC['student_name'];?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">手机号检索</label>
                                                            <div class="col-md-4">
                                                                <input name='mobile' class="form-control"  id='mobile' value="<?php  echo $_GPC['mobile'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">考勤卡检索</label>
                                                            <div class="col-md-4">
                                                                <input name='card' class="form-control"  id='card' value="<?php  echo $_GPC['card'];?>">
                                                            </div>
                                                        </div>                                                        
                                                         <div class="form-group last">
                                                          <label class="control-label col-md-3">状态</label>
                                                             <div class="col-md-4">
                                                                        <select name="status" class="form-control">
                                                                            <option value='0'>全部</option>
                                                                            <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
                                                                            <option value="3" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>关闭</option>
                                                                        </select>
                                                             </div>
                                                        </div>                                                       
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                     <button class="btn btn-default" type="button">总记录数：<?php  echo $num;?></button>				
                                                                     <button class="btn btn-default" name='print_code' value='1' >统一打印考勤二维码</button>				
                                                                     <button class="btn btn-default" name='print_bd_code' value='1' >统一打印绑定二维码</button>				
                                                                     <button class="btn btn-default" name='excel'    value='1' >导出excel</button>	
                                                                     <button class="btn btn-default" name='excel_no' value='1' >导出未绑定学生名单</button>	
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
                                        <i class="fa fa-cogs"></i>学生列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th class="numeric" > ID</th>
                                                <th>  学生姓名 </th>
                                                <th>  绑定家长数 </th>
                                                <th class="numeric"> 系统编号 </th>
                                                <th class="numeric"> 学号 </th>
                                                <th > 家长姓名 </th>
                                                <th class="numeric"> 家长电话 </th>
                                                <th class="numeric"> 入学年份 </th>
                                                <th > 主班级 </th>
                                                <th > 状态 </th>
                                                <th class="numeric"> 添加时间 </th>
                                                <th >  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  $cclass_student = C('student');?>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <?php  $have_parent  =$cclass_student->checkStudentHaveBd($item['student_id']);?>
                                                <td> <?php  echo $item['student_id'];?></td>
                                            	<td>
                                                    <?php  if(!$have_parent['bd']) { ?>
                                                        <span class='font-red-intense bold'>
                                                            <?php  echo $item['student_name'];?>
                                                        </span>
                                                    <?php  } else { ?>
                                                        <?php  echo $item['student_name'];?>
                                                    <?php  } ?>
                                                </td>
                                                <td><?php  echo D('student')->studentBdCount($item)?> </td>
                                                <td><?php  echo $item['student_passport'];?></td>
                                                <td><?php  echo $item['xuehao'];?></td>
                                                <td><?php  echo $item['parent_name'];?></td>
                                                <td><?php  echo $item['parent_phone'];?></td>
                                                <?php  $grade_info=D('grade')->getGradeInfo($item['grade_id']);?>
                                                <td><?php  echo $grade_info['in_school_year'];?></td>
                                                <td><?php  echo $grade_info['grade_name'];?> <i class="fa fa-toggle-right"></i> <?php  echo $item['class_name'];?></td>
                                                <td>
                                                    <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='font-red-intense bold'>关闭</span><?php  } ?>
                                                </td>
                                                <td><?php  if($item['addtime']) { ?><?php  echo date("Y-m-d",$item['addtime']);?> <?php  } else { ?> <?php  echo date("Y-m-d",$item['add_time'])?> <?php  } ?></td> 
                                                <td style="text-align:center;">
                                                <div class="btn-group btn-group-solid">
                                                     <a  href="<?php  echo $this->createWebUrl('student', array('id' => $item['student_id'], 'op' => 'student','ac'=>'edit','rclass_id'=>$register['class_id'],'rgrade_id'=>$register['grade_id'] ))?> " class="btn  purple">编辑 </a>
                                                     <a href="<?php  echo $this->createWebUrl('student', array('id' => $item['student_id'], 'op' => 'student','ac'=>'delete','rclass_id'=>$register['class_id'],'rgrade_id'=>$register['grade_id'] ))?>" 
                                                        onclick="return confirm('此操作不可恢复，确认删除？');"
                                                        class="btn  blue" title="删除"> 删除 </a>  
                                                     <a href="<?php  echo $this->createWebUrl('qrcode', array('id' => $item['student_id'], 'op' => 'student_live_student' ))?>" class="btn yellow " target="_blank" title="打印考勤二维码">考勤码</a>
                                                     <a href="<?php  echo $this->createWebUrl('qrcode', array('id' => $item['student_id'], 'op' => 'student_bd_student' ))?>" class="btn red " target="_blank" title="打印绑定二维码">绑定码</a>
                                                     <?php  if($class_studentCard) { ?>
                                                     
                                                     <?php  } ?>
                                                     <!--<a href="<?php  echo $this->createWebUrl('locus', array('id' => $item['student_id'], 'op' => 'student') )?>" class="btn green " target="_blank">轨迹</a>-->
                                                </div>
                                                </td>    
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                        <?php  echo $pager;?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <script>
                            $(function(){
                                onChangeGrade(<?php  echo $_GPC['class_id'];?>);
                            });
                            var list = new Array();
                            <?php  if(is_array($result['grade'])) { foreach($result['grade'] as $row) { ?>
                                list[<?php  echo $row['grade_id'];?>] = new Array();
                                <?php  $i=0;?>
                                <?php  if(is_array($row['class'])) { foreach($row['class'] as $v) { ?>
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>]           = new Object();
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>].class_id   = "<?php  echo $v['class_id'];?>";
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>].class_name = "<?php  echo $v['class_name'];?>";
                                    <?php  $i++;?>
                                <?php  } } ?>
                            <?php  } } ?>
                            function onChangeGrade(class_id){
                                var grade_id             = $("#school_grade_list").val();
                                var select_class_obj     = $(".school_class_list");
                                select_class_obj.html('<option value="0">全部</option>');
                                $.each(list[grade_id],function(i,e){
                                    if(e.class_id == class_id){
                                        selected = 'selected';
                                    }else{
                                        selected ='';
                                    }
                                    select_class_obj.append("<option value='"+e.class_id+"' "+selected+"  >"+e.class_name+"</option>");
                                });
                            }
                        </script>                       
                <?php  } ?>
        </div>
        </div>
        <script>
            $(function(){
                $("#class_much_num").change(function(){
                    num = $(this).val();
                    addNum(num);
                });
            });
            function addNum(in_num){
                this_num = $(".fu_class_id").length;
                if(this_num>in_num){
                    $("#mu_class").html('');
                }
                for(i=0;i<in_num-this_num;i++){
                    addClass(0);
                }
            }
            //添加班级
            function addClass(class_id){
                var class_list = new Array;
                var class_list_str='';
                <?php  if(is_array($class_list)) { foreach($class_list as $key => $row) { ?>
                    class_list[<?php  echo $key;?>] = new Object;
                    class_list[<?php  echo $key;?>].id   = '<?php  echo $row['class_id'];?>';
                    class_list[<?php  echo $key;?>].name = '<?php  echo $this->classGradeName($row['class_id'])?>-<?php  echo $row['class_name'];?>';
                <?php  } } ?>
                if(!class_id){
                    class_id = 0;
                }
                $.each(class_list,function(i,e){
                    if(e.id==class_id){
                        select = "selected";
                    }else{
                        select = '';
                    }
                    class_list_str = class_list_str+"<option value='"+e.id+" "+select+" '>"+e.name+"</option>";
                });
                console.log(class_list_str);
                before = '<div class="form-group  form-md-line-input">'+
                         '<label class="col-md-2 control-label font-red-sunglo "><span class="required" aria-required="true"> * </span>副班级</label>'+
                         '<div class="col-sm-10">'+
                         '<select  class="form-control fu_class_id" name="fu_class_id[]">'
                             +class_list_str+
                         '</select>'+
                         '</div>'+
                         '</div>';
              $("#mu_class").append(before);  
            }
        </script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>