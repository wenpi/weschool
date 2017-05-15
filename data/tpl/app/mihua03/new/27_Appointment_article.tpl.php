<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "预约活动-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css?<?php  echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<body>
<body style="margin-bottom:60px;">
<div class="neirong">
   <h1><?php  echo $result['appointment_name'];?></h1>
    <div class="other"><u><?php  if($result['appointment_type_limit']==0) { ?>全校<?php  } else if($result['appointment_type_limit']==1) { ?>年级<?php  } else if($result['appointment_type_limit']==2) { ?>班级<?php  } ?></u>|<time><?php  echo date("m-d H:i",$result['appointment_start']);?>--<?php  echo date("m-d H:i",$result['appointment_end']);?></time>|<i><a href=" ">申请(<?php  echo $result['appointment_join_num'];?>)</a></i></div>
            <?php  echo htmlspecialchars_decode($result['appointment_content'])?>
    </div>
    </ul>
    <?php  if(!$you_result ) { ?>
    <form method="post" onsubmit="return checkNum()">
        <input type='hidden' name='appointment_id' value='<?php  echo $result['appointment_id'];?>'>
    <?php  } ?>
            <table border="1"  bordercolor="#ccc" cellpadding="5" 
                    cellspacing="0" class="table table-bordered" 
                    height="220" style="border-collapse:collapse;width:100%">
                <thead>
                    <tr>
                        <th style='text-align:center'>课程</th>
                        <th style='text-align:center'>类型</th>
                        <th style='text-align:center'>时节</th>
                        <th style='text-align:center'>人数</th>
                        <th style='text-align:center'>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($course_list)) { foreach($course_list as $key => $row) { ?>
                        <tr <?php  if($key % 2==0) { ?>style='background-color:#F5F0D6' <?php  } ?>>
                            <td><?php  echo $row['course_name'];?></td>
                            <td><?php  if($row['course_type']==1) { ?>长课程<?php  } else { ?>短课程<?php  } ?></td>
                            <td>A课时:<?php  echo $row['time']['a']['begin'];?>-<?php  echo $row['time']['a']['end'];?></td>
                            <td><?php  echo $row['course_num'];?>/<?php  echo $row['acount'];?></td>
                            <td><?php  if($row['acount']>=$row['course_num']) { ?>已报满
                                <?php  } else { ?>
                                
                                    <input type='radio' name='course[<?php  echo $row['course_id'];?>]' value='a' data-type='<?php  echo $row['course_type'];?>' onclick='check(this)' >
                                <?php  } ?>
                            </td>
                        </tr>
                        <?php  if($row['time']['b']['begin']>0 ) { ?>
                         <tr <?php  if($key % 2==0) { ?>style='background-color:#F5F0D6' <?php  } ?>>
                            <td><?php  echo $row['course_name'];?></td>
                            <td><?php  if($row['course_type']==1) { ?>长课程<?php  } else { ?>短课程<?php  } ?></td>
                            <td>B课时:<?php  echo $row['time']['b']['begin'];?>-<?php  echo $row['time']['b']['end'];?></td>
                            <td><?php  echo $row['course_num'];?>/<?php  echo $row['bcount'];?></td>
                            <td><?php  if($row['bcount']>=$row['course_num']) { ?>已报满
                                <?php  } else { ?>
                                <input type='radio' name='course[<?php  echo $row['course_id'];?>]' value='b' data-type='<?php  echo $row['course_type'];?>' onclick='check(this)'>
                                <?php  } ?>
                            </td>
                        </tr>                       
                        <?php  } ?>
                    <?php  } } ?>
                </tbody>
                </table>   
                <?php  if(!$you_result ) { ?>
                 <?php  if($result['status']==1 && $result['appointment_end']>time() && $result['appointment_start']<time()) { ?>
                    <div class="form-group">
                            <div class="col-sm-12">
                                <button class='weui_btn weui_btn_default'    onclick='return resetcheck()' style="padding:0px;margin-top:10px;">重置选择</button>
                                <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                                <input type="submit" name='submit' class="weui_btn weui_btn_primary  " style="padding:0px;margin-top:10px;" value='提交预约，提交后不能修改'>
                            </div>
                    </div>                 
                 <?php  } else if($result['status']==1 && $result['appointment_end']< time() ) { ?><button  class="weui_btn weui_btn_primary "  style="padding:0px;margin-top:10px;" >已结束</button>
                 <?php  } else if($result['status']==1 && $result['appointment_start']>time() ) { ?><button  class="weui_btn weui_btn_primary "  style="padding:0px;margin-top:10px;" >未开始</button>
                  <?php  } ?> 
                <?php  } else { ?>
                <div class="form-group">
                            <div class="col-sm-12">
                                <a href='<?php  echo $this->createMobileUrl('applist_result');?>'><button  class="weui_btn weui_btn_primary " style="padding:0px;margin-top:10px;" >已经选择，无法修改，查看预约结果</button>
                            </a>
                            </div>
                    </div>
                <?php  } ?>
    </form> 
</div>
<script>
    function checkNum(){
            var have_check = 0;
            var have_i  = 0;
            $.each(list,function(i,e){
                if($(this).attr('data-type')==2 && $(this).prop('checked') ){
                    have_check++;
                    have_i=1;
                }
            });        
            if(have_check < 2 && have_i==1){
                alert("小课请同时选择两个课时");
                return false;
            }
    }
    function resetcheck(){
         $('input[type="radio"]').prop('checked',false);   
         return false; 
    }
    function check(obj){
        var data_type=$(obj).attr('data-type');
        if(data_type==1){
            $('input[type="radio"]').prop('checked',false);    
            $(obj).prop('checked',true);
        }
        if(data_type == 2){
            var ii=0;
            var db=false;
            var da=false;
            list=$('input[type="radio"]');
            $.each(list,function(i,e){
                if($(this).attr('data-type')==1){
                    $(this).prop('checked',false);
                }
                if($(this).attr('data-type')==2 && $(this).is(':checked') ){
                    ii++;
                    if(db && $(this).val()=='a'){
                        alert("不能选择两门课时一样的课程");    
                         $(this).prop('checked',false);
                    }
                    if($(this).val()=='a'){
                        db=true;
                    }
                    if(da && $(this).val()=='b'){
                        alert("不能选择两门课时一样的课程");    
                         $(this).prop('checked',false);
                    }
                    if($(this).val()=='b'){
                        da=true;
                    }                    
                    if(ii>2){
                         $(this).prop('checked',false);
                    }
                }
            });
        }
    }
</script>  
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>