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
                <script>
                    $(function(){
                        $("#checkAction").click(function(){
                            obj=$(".class_ids");
                            if(obj.prop("checked"))
                                obj.prop('checked',false);
                            else 
                                obj.prop('checked',true);
                        });
                    });
                </script>
 <?php  if($ac=='ac_list' || $ac=='ac_new'||$ac=='ac_edit') { ?>
        <?php  if($ac=='ac_list') { ?>
                  <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 具体可预约活动 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>活动列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>课程名</th>
                                                <th>可选几个</th>
                                                <th>可报名人数</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>                                           
                                        </thead>
                                            <tbody>
                                                  <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                            <tr>
                                                                <td><?php  echo $row['course_name'];?></td>
                                                                <td><?php  echo $row['course_type'];?></td>
                                                                <td><?php  echo $row['course_num'];?></td>
                                                                <td><?php  if($row['status']==1) { ?>可报名<?php  } else { ?>关闭<?php  } ?></td>
                                                                <td><a class="btn btn-outline btn-circle dark btn-sm black"  href="<?php  echo $this->createWebUrl('appointment',array('aid'=>$row['course_id'],'ac'=>'ac_edit','aw'=>1 ) )?>"><i class="fa fa-edit"></i>编辑</a></td>
                                                            </tr>
                                                   <?php  } } ?>
                                            </tbody>
                                    </table>
                                     <?php  echo $pager;?>
                                </div>
                            </div>
                        </div>
                    </div>               
        <?php  } ?>
        <?php  if($ac=='ac_edit' || $ac=='ac_new') { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">  <?php  if($ac=='ac_new') { ?>新增<?php  } else { ?>修改<?php  } ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                            <div class="portlet-body form">
                            <form method="post" class="form-horizontal form" >
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label"><span style='color:red'>*</span>课程名</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="course_name" id="course_name" class="form-control" value='<?php  echo $result['course_name'];?>'/>
                                            <?php  if($ac=='ac_edit') { ?>
                                            <input type="hidden" name="aid"  class="form-control" value='<?php  echo $result['course_id'];?>' />
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>同类型课程可以报名数(如大课一个，小课两个)</label>
                                        <div class="col-sm-10">
                                            <input type='radio' name='course_type' value='2' <?php  if($result['course_type']==2) { ?> checked <?php  } ?>>小课（同时选择2个）
                                            <input type='radio' name='course_type' value='1'  <?php  if($result['course_type']==1) { ?> checked <?php  } ?>>大课（可选择1个）
                                        </div>
                                    </div>   
                                    <div class="form-group form-md-line-input">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>课程时间点安排</label>
                                        <div class="col-sm-10">
                                        时间点为同一天内会安排两场相同时间的课程（A,B），而学生只能选择其中一场
                                            <br>
                                            A场开始时间：<input type='text' name="timea[begin]" value="<?php  echo $time['a']['begin'];?>" placeholder="08:00" class="mask_date3">
                                            A场结束时间：<input type='text' name="timea[end]" value="<?php  echo $time['a']['end'];?>" placeholder="13:00" class="mask_date3">
                                            <br>
                                            B场开始时间：<input type='text' name="timeb[begin]" value="<?php  echo $time['b']['begin'];?>" placeholder="14:00" class="mask_date3">
                                            B场结束时间：<input type='text' name="timeb[end]" value="<?php  echo $time['b']['end'];?>" placeholder="15:00" class="mask_date3">
                                        </div>
                                    </div> 
                                    <div class="form-group form-md-line-input">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>课程可以报名人数</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="course_num" id="course_num" class="form-control" value='<?php  echo $result['course_num'];?>'/>
                                        </div>
                                    </div>     
                                    <div class="form-group form-md-line-input">
                                        <label class=" col-md-2 control-label"><span style='color:red'></span>课程介绍</label>
                                        <div class="col-sm-10">
                                            <?php  echo tpl_ueditor("course_content",$result['course_content']);?>
                                        </div>
                                    </div>                                 
                                        <div class='form-group'>
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                        <div class="col-sm-10">
                                        <select name='status' class='form-control'>
                                                <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                        </select>
                                        </div>							
                                        </div>
                                    </div>
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
        <?php  } ?>
<?php  } else { ?>

                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 学校的预约活动列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>活动列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                                <tr>
                                                    <th >类目</th>
                                                    <th >名称</th>
                                                    <th >简要</th>
                                                    <th >发布时间</th>
                                                    <th >起始时间</th>
                                                    <th >申请人数</th>
                                                    <th >状态</th>
                                                    <th ></th>
                                                </tr>                                            
                                        </thead>
                                            <tbody>
                                                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                    <tr>
                                                        <td><?php  echo $appointment[$row['appointment_type']];?></td>
                                                        <td><?php  echo $row['appointment_name'];?></td>
                                                        <td><?php  echo $row['appointment_intro'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$row['appointment_addtime'])?></td>
                                                        <td><?php  echo date("Y-m-d ",$row['appointment_start'])?>--<?php  echo date("Y-m-d",$row['appointment_end'])?></td>
                                                        <td><span class='red'><?php  echo $row['appointment_join_num'];?></span></td>
                                                        <td><?php  if($row['status']==1) { ?> 正常<?php  } else { ?> 关闭<?php  } ?></span></td>
                                                        <td><a  class="btn btn-outline btn-circle dark btn-sm black" href="<?php  echo $this->createWebUrl('appointment',array('aid'=>$row['appointment_id'],'ac'=>'edit' ,'aw'=>1) )?>"><i class="fa fa-edit"></i>编辑</a>
                                                        <a   class="btn btn-outline btn-circle dark btn-sm black"    href="<?php  echo $this->createWebUrl('applist',array('aid'=>$row['appointment_id'],'ac'=>'list' ,'aw'=>1 ) )?>"><i class="fa fa-edit"></i> 管理报名</a></td>
                                                    </tr>
                                                <?php  } } ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                <?php  if($ac=='new' || $ac=='edit') { ?>
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                        <input type="hidden" name="cid"   value='<?php  echo $class['class_id'];?>' />
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                <div class='form-group'>
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
                                    <div class="col-sm-10">
                                        <select name='limit_type' id="limit_type" class="form-control" >
                                            <?php  if($teacher!='teacher' ) { ?>
                                            <?php  if(is_array($appointment_limit)) { foreach($appointment_limit as $key => $row) { ?>
                                                <option value='<?php  echo $key;?>' <?php  if($limit_type==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                            <?php  } } ?>
                                            <?php  } else { ?>
                                                <option value='class' >班级限制</option>
                                            <?php  } ?>
                                        </select>
                                    </div>	
                                </div>	
                                <div class="form-group">
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制具体</label>
                                    <div class="col-sm-10" id='limit_content' data-type='<?php  echo $limit_type;?>'>
                                        <?php  if($limit_type==0) { ?>无<?php  } ?>
                                        <?php  if($limit_type==1) { ?>
                                            <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                <input  name='grades[]' type='checkbox' value='<?php  echo $row['grade_id'];?>' <?php  if(in_array($row['grade_id'],$limit_arr)) { ?> checked <?php  } ?>><?php  echo $row['grade_name'];?>&nbsp;&nbsp;
                                            <?php  } } ?>
                                        <?php  } ?>
                                        <?php  if($limit_type==2) { ?>
                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                <?php  $grade_info = D('grade')->getGradeInfo($row['grade_id']);?>
                                                <input name='class[]' type='checkbox' value='<?php  echo $row['class_id'];?>' <?php  if(in_array($row['class_id'],$limit_arr)) { ?> checked <?php  } ?>><?php  echo $grade_info['grade_name'];?>~<?php  echo $row['class_name'];?>&nbsp;&nbsp;}&nbsp;&nbsp;
                                            <?php  } } ?>							
                                        <?php  } ?>
                                    </div>
                                </div>								
                                <div class='form-group'>
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>标题</label>
                                    <div class="col-sm-10">
                                        <input type='text' value='<?php  echo $result['appointment_name'];?>' name='aname' class='form-control' >
                                    </div>	
                                </div>
                                <div class="form-group">
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>活动类型</label>
                                    <div class="col-sm-10">
                                        <select name='atype' class="form-control" >
                                            <?php  if(is_array($appointment)) { foreach($appointment as $key => $list) { ?>
                                                <option value='<?php  echo $key;?>' <?php  if($result['appointment_type']==$key) { ?> selected <?php  } ?>><?php  echo $list;?></option>
                                            <?php  } } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"  id='mutex_content'>
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择活动</label>
                                    <div class="col-sm-10">
                                        大课：    
                                        <?php  if(is_array($list_max)) { foreach($list_max as $vo) { ?>
                                            <input type="checkbox" name='appointment_mutex[]'  value="<?php  echo $vo['course_id'];?>" 
                                            <?php  if($ac=='edit') { ?>
                                            <?php  if(in_array($vo['course_id'],$result['appointment_mutex']) ) { ?> checked <?php  } ?>
                                            <?php  } ?>
                                            ><?php  echo $vo['course_name'];?>&nbsp;&nbsp;
                                        <?php  } } ?>
                                        <br>
                                        小课：
                                        <?php  if(is_array($list_min)) { foreach($list_min as $vo) { ?>
                                            <input type="checkbox" name='appointment_mutex[]'  value="<?php  echo $vo['course_id'];?>" 
                                            <?php  if($ac=='edit') { ?>
                                            <?php  if(in_array($vo['course_id'],$result['appointment_mutex']) ) { ?> checked <?php  } ?>
                                            <?php  } ?>
                                            ><?php  echo $vo['course_name'];?>&nbsp;&nbsp;
                                        <?php  } } ?>                        
                                    </div>
                                </div>	
                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">活动时间</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input has-success">
                                                        <div class="input-icon col-md-6">
                                                            <input class="form-control" id="mask_date" type="text"  name="atime[start]" value="<?php  if(!$result['appointment_start'] ) { ?><?php  $result['appointment_start'] =time();?><?php  } ?><?php  echo date("Y-m-d H:i",$result['appointment_start'])?>"/>
                                                            <label for="am_much">开始时间</label>
                                                             <span class="help-block">年-月-日</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-6">
                                                        <input class="form-control" id="mask_date1" type="text" name="atime[end]" value="<?php  if(!$result['appointment_end'] ) { ?><?php  $result['appointment_end'] =time();?><?php  } ?><?php  echo date("Y-m-d H:i",$result['appointment_end'])?>" />
                                                        <label for="pm_much">结束时间</label>
                                                             <span class="help-block">年-月-日</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                      </div>                     
                                <div class="form-group">
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>简介</label>
                                    <div class="col-sm-10">
                                        <textarea name='aintro' class='form-control'><?php  echo $result['appointment_intro'];?></textarea>
                                    </div>
                                </div>					
                                <div class="form-group">
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>预约内容</label>
                                    <div class="col-sm-10">
                                        <?php  echo tpl_ueditor('acontent',$result['appointment_content']);?>	
                                    </div>
                                </div>	
                                <?php  if($ac=='edit') { ?>
                                    <div class='form-group'>
                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                        <div class="col-sm-10">
                                            <select name='status' class="form-control"  >
                                                    <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
                                                    <option value='3' <?php  if($result['status']==3) { ?> selected <?php  } ?>>删除</option>
                                            </select>
                                        </div>							
                                    </div>
                                <?php  } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                            </div>
                            </div>
                        </div>		
                    </form>		
                    <script>
                        $(function(){
                            <?php  if($teacher!='teacher') { ?>
                                var grade_html='';
                                <?php  if(is_array($grade_list)) { foreach($grade_list as $key => $row) { ?>
                                    grade_html +="<input value='<?php  echo $row['grade_id'];?>' type='checkbox' onclick='checkbox(this)' name='grades[]'><?php  echo $row['grade_name'];?>&nbsp;&nbsp;";
                                <?php  } } ?>
                            <?php  } ?>
                            var class_html='';
                            <?php  if(is_array($class_list)) { foreach($class_list as $key => $row) { ?>
                                <?php  $grade_info = D('grade')->getGradeInfo($row['grade_id']);?>
                                class_html +="<input value='<?php  echo $row['class_id'];?>' type='checkbox' onclick='checkbox(this)'name='class[]'><?php  echo $grade_info['grade_name'];?>~<?php  echo $row['class_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;";
                            <?php  } } ?>
                                var data_type=new Array();
                            $('#limit_type').change(function(){
                                var val=$(this).val();
                                    var limit_type=$('#limit_content').attr('data-type');
                                    limit_type=limit_type ? limit_type :0;
                                    data_type[limit_type]=$('#limit_content').html();
                                    $('#limit_content').attr('data-type',val);
                                    if(!data_type[val]){
                                        if(val==1){
                                            var content=grade_html;
                                        }else if(val==2){
                                            var content=class_html;
                                        }else if(val==0){
                                            var content='无';
                                        }
                                        $('#limit_content').html(content);
                                    }else{
                                        $('#limit_content').html(data_type[val]);
                                    }
                            });
                        });
                    function checkbox(obj){
                            if($(obj).is(":checked")){
                                $(obj).attr('checked','checked');
                            }else{
                                $(obj).attr('checked',false);
                            }
                        }
                    </script>
                <?php  } ?>     
        <?php  } ?>          
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
          <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
            <script>
                        var FormInputMask = function () {
                            var handleInputMasks = function () {
                                $("#mask_date").inputmask("y-m-d h:s", {
                                    autoUnmask: true
                                }); //direct mask 
                                $("#mask_date1").inputmask("y-m-d h:s", {
                                    autoUnmask: true
                                }); //direct mask  
                                 $(".mask_date3").inputmask("h:s", {
                                    autoUnmask: true
                                }); //direct mask  

                            }                                 
                            return {
                                //main function to initiate the module
                                init: function () {
                                    handleInputMasks();
                                }
                            };
                        }();
                        if (App.isAngularJsApp() === false) { 
                            jQuery(document).ready(function() {
                                FormInputMask.init(); // init metronic core componets
                            });
                        }                
                </script>
         </body>
    </html>