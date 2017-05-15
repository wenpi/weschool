<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <style>
    .bg-gradient{
      background-color: rgba(51,203,213,1);
      background-image: none;
    }
    .dataTables_length,.paging_simple_numbers{
        display: none;
    }
    .dataTables_filter{
        text-align: left !important;
        margin-left: 25px;
    }
    .dataTables_filter input{
        border: 1px solid #ccc;
        width:40%;
        padding-left: 10px;
        margin-left: 10px;
        -webkit-appearance: none;
    }
  </style>
  <section class="w-section mobile-wrapper">
          <div class="page-content" id="main-stack">
              <div  class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
                <div class="w-container">
                    <div class="wrapper-mask" data-ix="menu-mask"></div>
                    <div class="navbar-title" style="z-index: 800">选择要发送的教师</div>
                    <div class=" navbar-button left" style="z-index: 900" >
                        <?php  if($ac=='teacher') { ?>
                            <a  href="<?php  echo $this->createMobileUrl('teain')?>">
                        <?php  } else { ?>
                            <a  href="<?php  echo $this->createMobileUrl('school_home')?>">
                        <?php  } ?>
                            <div class="navbar-button-icon smaller icon ion-ios-home-outline" style="color:#fff"></div>
                        </a>
                    </div>
                    <?php  if($ac=='list') { ?>
                        <a  style="z-index: 900;" class="w-inline-block navbar-button right" href="<?php  echo $this->createMobileUrl('schoolAdminMsgSend')?>" data-load="1" data-ix="search-box">
                            <div class="navbar-button-icon smaller icon ion-ios-reverse-camera-outline"></div>
                        </a>
                    <?php  } ?>
                </div>
              </div>
                <div class="body"  style="padding-top:45px;padding-left:20px;padding-right:20px;" >
                  <form  method="post" action="<?php  echo $this->createMobileUrl('schoolAdminTeaMsgSendAdd')?>">
                  <input type="hidden" name="ac" value="<?php  echo $ac;?>">
                     <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3" >
                                    <thead>
                                        <tr>
                                            <th class="table-checkbox">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" onclick="checkBox()"/>
                                                <span></span>
                                            </label>
                                            </th>
                                                <th> 教师名 </th>
                                                <th> 班级 </th>
                                                <th width='20%'> 标签 </th>
                                        </tr>
                                    </thead>          
                                    <tbody>
                                        <?php  if(is_array($teacher_list)) { foreach($teacher_list as $item) { ?>
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type='checkbox' class='teacher_checkbox' value='<?php  echo $item['teacher_id'];?>' name='have[]'>
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td><?php  echo $item['teacher_realname'];?><?php  if($result=$this->classHead($item['teacher_id'])) { ?>[班主任]<?php  } ?> </td>
                                                            <?php  $class_list = D('teacher')->getTeacherClass($item['teacher_id'],true);?>
                                                            <td>
                                                                <?php  if(is_array($class_list['list_all'])) { foreach($class_list['list_all'] as $row) { ?>
                                                                    <?php  echo $row['grade_name'];?>-
                                                                    <?php  echo $row['class_name'];?>,
                                                                <?php  } } ?>
                                                            </td>
                                                            <td><?php  echo C('teacherTag')->echoTeacherTag($item['teacher_tags']);?></td>
                                                        </tr>                                           
                                                    <?php  } } ?>                           
                                    </tbody>
                            </table>
                     </div>
                      <div class="w-form">
                          <div class="separator-button-input"></div>
                          <div>
                            <label class="label-form" for="full-name-field">通知标题</label>
                              <input class="w-input input-form" id="full-name-field" type="text" name="title"  placeholder="" >
                            <div class="separator-fields"></div>
                          </div>
                          <div>
                            <label class="label-form" for="message">简要</label>
                              <input class="w-input input-form" id="full-name-field" type="text" name="intro" data-name="intro" >
                          </div>
                          <div>
                            <label class="label-form" for="message">详细内容</label>
                            <textarea class="w-input input-form textarea" name="content" data-name="content"></textarea>
                          </div>
                            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/upImages', TEMPLATE_INCLUDEPATH)) : (include template('../new/upImages', TEMPLATE_INCLUDEPATH));?>	
                            <div>
                              <div  class='hide' id='voice_value'></div>     
                              <div  class="button button-primary button-rounded button-small up_button" style='margin:5px 0px 5px 10px;' onclick='chooseVoice()'>开始录音</div>
                              <div  id='uploadVoice' style='margin-bottom:5px;margin-left:10px;display:inline;' ></div>
                            </div>
                            <div class="separator-button-input"></div>
                            <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                            <input class="w-button action-button" type="submit" name="submit" value="提交" data-wait="Please wait...">
                      </div>               
            </form>

        </div>
      </div>
  </section>
    <script>
        $(document).ready(function(){
                $('#sample_3').dataTable({
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "没有数据",
                        "info": "显示 _START_ to _END_  ",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(从 _MAX_ 条记录中筛选)",
                        "lengthMenu": "每页数 _MENU_",
                        "search": "搜索:",
                        "zeroRecords": "无搜索结果",
                        "paginate": {
                            "previous":"上一页",
                            "next": "下一页",
                            "last": "最后页",
                            "first": "第一页"
                        }
                    },
                    "bStateSave": true, 
                    "lengthMenu": [
                        [6, 15, 20, 50, 200,<?php  echo $everP;?>],
                        [6, 15, 20, 50, 200, "全部"] // change per page values here
                    ],
                    "pageLength": -1,

                    "columnDefs": [{  
                        'orderable': true,
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [-2]
                    }],
                    "order": [
                        <?php  if($order_self) { ?>
                           <?php  echo $order_self;?>
                        <?php  } else { ?>
                            [1, "asc"]
                        <?php  } ?>
                    ]

                });            
        });
        var d = 0;
        function checkBox(){
            if(d==0){
                $(".teacher_checkbox").prop("checked",true);
                d =1;
            }else{
                $(".teacher_checkbox").prop("checked",false);
                d =0;
            }
        }
        function contentTo(obj,idname){
            content = $(obj).val();
            $("#"+idname).html(content);
        }
    </script>

  <style>
    #voice_stop{
        margin-top:50px;
    }
  </style>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/voice', TEMPLATE_INCLUDEPATH)) : (include template('../new/voice', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>