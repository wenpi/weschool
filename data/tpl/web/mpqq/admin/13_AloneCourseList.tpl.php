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
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>课程名</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="course_name" class="form-control" value='<?php  echo $result['course_name'];?>' required />
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>课程分类</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control school_class_list" name="class_id" class="form-control"  >
                                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                        <option value="<?php  echo $row['class_id'];?>" <?php  if($result['class_id']==$row['class_id']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                                    <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>课时数</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nums" class="form-control" value='<?php  echo $result['nums'];?>' required/>
                                                    </div>
                                                </div>
                                                  <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>购买价格</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="price" class="form-control" value='<?php  echo $result['price'];?>' required/>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>购买截止时间</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id='mask_date' name="buy_end" class="form-control" value='<?php  echo date("Y-m-d H:i",$result['buy_end'])?>' required/>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class='font-red'>*</span>可参加的最多学生数</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="max_student_num" class="form-control" value='<?php  echo $result['max_student_num'];?>' required/>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label">封面图</label>
                                                    <div class="col-sm-10">
                                                         <?php  echo tpl_form_field_image('img',$result['img']);?>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label">购买链接</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="buy_url" class="form-control" value='<?php  echo $result['buy_url'];?>'/>
                                                    </div>
                                                </div>
                                                <div class="form-group  form-md-line-input">
                                                    <label class="control-label col-md-2">选择责任教师（只能选择一个）</label>
                                                        <div class="col-md-10">
                                                            <select name="teacher_ids[]" id='pre-selected-options'  multiple="multiple" class="multi-select"  >
                                                                    <?php  if(is_array($teacher_list)) { foreach($teacher_list as $row) { ?>
                                                                        <option value='<?php  echo $row['teacher_id'];?>' <?php  if(in_array($row['teacher_id'],$teacher_ids)) { ?> selected <?php  } ?> ><?php  echo $row['teacher_realname'];?></option>
                                                                    <?php  } } ?>
                                                            </select>
                                                    </div>
                                                </div> 
                                                <div class='form-group'>
                                                  <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>课程简介</label>
                                                   <div class="col-sm-9 col-xs-12">
                                                       <?php  echo tpl_ueditor('course_contet',$result['course_contet']);?>
                                                   </div>	
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='status'  class="form-control" >
                                                            <?php  echo S('fun','statusOut',array($result['status']))?>
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
                        </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选课程</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form action="<?php  echo $this->createWebUrl('aloneCourseList')?>" method="post" class="form-horizontal">
                                                      
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">分类</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control school_class_list" name="class_id" class="form-control"  >
                                                                    <option value="0">全部</option>
                                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                        <option value="<?php  echo $row['class_id'];?>" <?php  if($_GPC['class_id']==$row['class_id']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                                    <?php  } } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">课程名</label>
                                                            <div class="col-md-4">
                                                                <input name='search_name' class="form-control"  id='search_name' value="<?php  echo $_GPC['search_name'];?>">
                                                            </div>
                                                        </div>	
                                                         <div class="form-group">
                                                          <label class="control-label col-md-3">状态</label>
                                                             <div class="col-md-4">
                                                                        <select name="status" class="form-control">
                                                                            <option value='0'>全部</option>
                                                                            <option value="1"  <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
                                                                            <option value="10" <?php  if($_GPC['status'] == '10') { ?> selected<?php  } ?>>注销</option>
                                                                        </select>
                                                             </div>
                                                        </div>
                                                        <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-2 col-md-10">
                                                                        <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                        <button class="btn btn-default" type="button">总记录数：<?php  echo $listre['count'];?></button>				
                                                                    </div>
                                                                </div>
                                                        </div>   
                                                </form>
                                              </div>
                             </div>                
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="note note-success">
                                            <p> 独立课程列表 </p>
                                        </div>
                                        <div class="portlet box green-turquoise">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>独立课程列表 </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body flip-scroll">
                                                <table class="table table-bordered table-striped table-condensed flip-content">
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>课程名</th>
                                                            <th>课时数</th>
                                                            <th>购买价格</th>
                                                            <th>在线购买链接<br>设置会跳转</th>
                                                            <th>购买截止时间</th>
                                                            <th>最多购买人数</th>
                                                            <th>课程分类</th>
                                                            <th>封面图</th>
                                                            <th>状态</th>
                                                            <th>添加时间</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                            <tr>
                                                                <td><?php  echo $item['course_name'];?></td>
                                                                <td><?php  echo $item['nums'];?></td>
                                                                <td><?php  echo $item['price'];?>元</td>
                                                                <td><a href="<?php  echo $item['buy_url'];?>" target="_blank"><?php  echo $item['buy_url'];?></a></td>
                                                                <td><?php  echo date("Y-m-d H:i",$item['buy_end'])?></td>
                                                                <td><?php  echo $item['max_student_num'];?>人</td>
                                                                <td><?php  echo $item['class_name'];?></td>
                                                                <td><img width="80" src="<?php  echo $this->imgFrom($item['img']);?>"></td>
                                                                <td><?php  if($item['status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
                                                                <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                                
                                                                <td  style="text-align:center;"  > 
                                                                 <div class="btn-group btn-group-solid">
                                                                    <a href="<?php  echo $this->createWebUrl('aloneCourseList', array('ac' => 'edit','id'=>$item['course_id']))?>"     class="btn   blue"   >  编辑</a>
                                                                    <a href="<?php  echo $this->createWebUrl('aloneCourseList', array('ac' => 'delete','id'=>$item['course_id']))?>"   class="btn   red"    > 删除</a>
                                                                    <a href="<?php  echo $this->createWebUrl('aloneCourseList', array('ac' => 'student','id'=>$item['course_id']))?>"  class="btn   yellow" >  授权学生</a>
                                                                    <a href="<?php  echo $this->createWebUrl('aloneCourseList', array('ac' => 'code','id'=>$item['course_id']))?>"     class="btn   green"  > 二维码</a>
                                                                    <a href="<?php  echo $this->createWebUrl('aloneCourseList', array('ac' => 'buyHistoryList','id'=>$item['course_id']))?>"     class="btn   purple-medium"  >  购买记录</a>
                                                                  </div>
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
                <?php  if($ac=='code') { ?>
                    <div class="row">
                             <div class="row">
                                    <div class="col-md-12">
                                        <div class="note note-success">
                                            <p> <?php  echo $course_info['course_name'];?>二维码列表 </p>
                                        </div>
                                        <div class="portlet box green-turquoise">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i><?php  echo $course_info['course_name'];?>二维码列表 </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body flip-scroll">
                                                <table class="table table-bordered table-striped table-condensed flip-content">
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>课数</th>
                                                            <th>二维码</th>
                                                            <th>扫码人数</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($qrlist)) { foreach($qrlist as $item) { ?>
                                                            <tr>
                                                                <td><?php  echo $item['qrcode_num'];?></td>
                                                                <td><a href="<?php  echo $_W['siteroot'].'app/'.$this->createMobileUrl('qrImg',array('value'=>$item['qrcode_value'],'ac'=>'course_scan','use_do'=>'courseScan'   )) ?>" target="_blank"><img width="60" src="<?php  echo $_W['siteroot'].'app/'.$this->createMobileUrl('qrImg',array('value'=>$item['qrcode_value'],'ac'=>'course_scan','use_do'=>'courseScan'   )) ?>"></br>点击查看大图</a></td>
                                                                <td> <span class="font-red" ><?php  echo $item['scan_student_num'];?> </span ><br>
                                                                <a target="_blank" class="font-blue"   href="<?php  echo $this->createWebUrl("aloneCourseList",array("ac"=>"code","id"=>$_GPC['id'],"qrcode_num"=>$item['qrcode_num'] ))?>">查看详情</a></td>
                                                            </tr>
                                                        <?php  } } ?>                                                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                    </div>
                <?php  } ?>
                <?php  if($ac=='student') { ?>
                      <div class="row">
                             <div class="row">
                                    <div class="col-md-12">
                                        <div class="note note-success">
                                            <p> <?php  echo $course_info['course_name'];?>学生登记信息列表 </p>
                                        </div>
                                        <div class="portlet box green-turquoise">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i> <?php  echo $course_info['course_name'];?>学生登记信息列表 </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                              <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                                    <thead>
                                                        <tr>
                                                            <th> 学生名 </th>
                                                            <th> 年级-班级 </th>
                                                            <th> 可用课时数 </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php  echo $item['student_info']['student_name'];?> </td>
                                                                <td><?php  echo $item['grade_class_name'];?></td>
                                                                <td> <input type="number" value="<?php  echo $item['use_num'];?>" data-id='<?php  echo $item['student_info']['student_id'];?>' onblur="update(this)">&nbsp;&nbsp;<span id='student_id_<?php  echo $item['student_info']['student_id'];?>' class="info font-red"> </span> </td>
                                                            </tr>                                           
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                     </div>
                                    </div>
                                </div>                       
                        </div>
                        <script>
                            function update(ob){
                               var  student_id = $(ob).attr('data-id');
                               var  num        = $(ob).val();
                                $.ajax({
                                    url:'<?php  echo $this->createWebUrl("aloneCourseList",array("ac"=>"student","op"=>"add","er"=>"change"))?>',
                                    data:{student_id:student_id,num:num,course_id:"<?php  echo $id;?>"},
                                    type:"post",
                                    dataType:"json",
                                    success:function(obj){
                                        if(obj.errcode==0){
                                            $('#student_id_'+student_id).html("已更新为："+num);
                                        }
                                    }
                                })
                                return false;
                            }
                        </script> 
                <?php  } ?>
                <?php  if($ac=='buyHistoryList') { ?>
                       <div class="row">
                             <div class="row">
                                    <div class="col-md-12">
                                        <div class="note note-success">
                                            <p> <?php  echo $course_info['course_name'];?>购买记录表 </p>
                                        </div>
                                        <div class="portlet box green-turquoise">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i> <?php  echo $course_info['course_name'];?>购买记录表 </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                              <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                                    <thead>
                                                        <tr>
                                                            <th> 学生名    </th>
                                                            <th> 年级-班级 </th>
                                                            <th> 下单时间  </th>
                                                            <th> 金额  </th>
                                                            <th> 状态   </th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($record_list)) { foreach($record_list as $item) { ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php  echo $item['student_name'];?> </td>
                                                                <td><?php  echo $item['grade_info']['grade_name'];?>--<?php  echo $item['class_name'];?></td>
                                                                <td><?php  echo date("Y-m-d H:i:s",$item['addtime'])?></td>
                                                                <td><?php  echo $item['limit_much'];?></td>
                                                                <td> 
                                                                    <?php  if($item['status']==1) { ?><span class="font-red">已经支付</span><?php  } else { ?>未支付<?php  } ?>
                                                                </td>
                                                                <td></td>
                                                            </tr>                                           
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                     </div>
                                    </div>
                                </div>                       
                        </div>               
                <?php  } ?>
                </div>
                </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
                </div>
                <?php  if($ac=='new' || $ac=='edit') { ?>
                        <link href="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
                        <style> .ms-container{  width:700px; }  </style>
                        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" ></script>
                        <script src="<?php echo MODULE_URL;?>/style/js/jquery.quicksearch.js" ></script>
                        <script>
                            $('#pre-selected-options').multiSelect({
                                selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='try \"张三\"'>",
                                selectionHeader: "<input type='text' class='search-input  form-control' autocomplete='off' placeholder='try \"李四\"'>",
                                afterInit: function(ms){
                                    var that = this,
                                    $selectableSearch = that.$selectableUl.prev(),
                                    $selectionSearch  = that.$selectionUl.prev(),
                                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                                    selectionSearchString  = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                                    .on('keydown', function(e){
                                    if (e.which === 40){
                                        that.$selectableUl.focus();
                                        return false;
                                    }
                                    });

                                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                                    .on('keydown', function(e){
                                    if (e.which == 40){
                                        that.$selectionUl.focus();
                                        return false;
                                    }
                                    });
                                },
                                afterSelect: function(){
                                    this.qs1.cache();
                                    this.qs2.cache();
                                },
                                afterDeselect: function(){
                                    this.qs1.cache();
                                    this.qs2.cache();
                                }
                            });
                        </script>
                        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
                        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
                        <script>
                                        var FormInputMask = function () {
                                            var handleInputMasks = function () {
                                                $("#mask_date").inputmask("y-m-d h:s", {
                                                    autoUnmask: true
                                                }); 
                                            }                                 
                                            return {
                                                init: function () {
                                                    handleInputMasks();
                                                }
                                            };
                                        }();
                                        if (App.isAngularJsApp() === false) { 
                                            jQuery(document).ready(function() {
                                                FormInputMask.init();
                                            });
                                        }                
                            </script>

                <?php  } ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
                <?php  if($ac == 'student' || $ac=='buyHistoryList') { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>                        
                 <?php  } ?>
                </body>
            </html>