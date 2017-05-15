<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main">
	<div class="jz-t">
		<div class="jz-tt"><p><?php  echo $result['appointment_name'];?></p></div>
		<div class="jz-top">
		<div class="jz-tm">
			<p><?php  if($result['appointment_type_limit']==0) { ?>全校<?php  } else if($result['appointment_type_limit']==1) { ?>年级<?php  } else if($result['appointment_type_limit']==2) { ?>班级<?php  } ?>&nbsp;</p>
			<span><?php  echo date("m-d H:i",$result['appointment_start']);?>-<?php  echo date("m-d H:i",$result['appointment_end']);?></span>
		</div>
		<div class="jz-tb">
			<span><?php  echo $result['appointment_join_num'];?></span>
			<p>申请数</p>
		</div>
		</div>
		<div class="jz-me">
			<p><?php  echo htmlspecialchars_decode($result['appointment_content'])?></p>
		</div>

        <?php  if(!$you_result ) { ?>
            <form method="post" onsubmit="return checkNum()">
                <input type='hidden' name='appointment_id' value='<?php  echo $result['appointment_id'];?>'>
            <?php  } ?>
            		<div class="jzz">
                                    <ul class="jz-b">
                                        <li class="jzb-1">课程</li>
                                        <li class="jzb-2">类型</li>
                                        <li class="jzb-3">时节</li>
                                        <li class="jzb-4">人数</li>
                                        <li class="jzb-5">操作</li>
                                    </ul>
                            <?php  if(is_array($course_list)) { foreach($course_list as $key => $row) { ?>
                                    <ul class="jz-c">
                                        <li class="jzc-1"><a href="<?php  echo $this->createMobileUrl("AppointmentInfo",array("id"=>$row['course_id']))?>"><?php  echo $row['course_name'];?></a></li>
                                        <li class="jzc-2"><?php  if($row['course_type']==1) { ?>长课程<?php  } else { ?>短课程<?php  } ?></li>
                                        <li class="jzc-3">
                                            <span class="jzc-3a">A课时：</span>
                                            <span class="jzc-3b"><?php  echo $row['time']['a']['begin'];?>-<?php  echo $row['time']['a']['end'];?></span>
                                        </li>
                                        <li class="jzc-4"><?php  echo $row['course_num'];?>/<?php  echo $row['acount'];?></li>
                                        <li class="jzc-5">
                                            <?php  if($row['acount']>=$row['course_num']) { ?>
                                                已报满
                                            <?php  } else { ?>
                                                <input type='radio' name='course[<?php  echo $row['course_id'];?>]' value='a' data-type='<?php  echo $row['course_type'];?>' onclick='check(this)' >
                                            <?php  } ?>
                                        </li>
                                    </ul> 
                                    <?php  if($row['time']['b']['begin']>0 ) { ?>
                                        <ul class="jz-c">
                                            <li class="jzc-1"><a href="<?php  echo $this->createMobileUrl("AppointmentInfo",array("id"=>$row['course_id']))?>"><?php  echo $row['course_name'];?></a></li>
                                            <li class="jzc-2"><?php  if($row['course_type']==1) { ?>长课程<?php  } else { ?>短课程<?php  } ?></li>
                                            <li class="jzc-3">
                                                <span class="jzc-3a">B课时：</span>
                                                <span class="jzc-3b"><?php  echo $row['time']['b']['begin'];?>-<?php  echo $row['time']['b']['end'];?></span>
                                            </li>
                                            <li class="jzc-4"><?php  echo $row['course_num'];?>/<?php  echo $row['bcount'];?></li>
                                            <li class="jzc-5">
                                                <?php  if($row['bcount']>=$row['course_num']) { ?>
                                                    已报满
                                                <?php  } else { ?>
                                                    <input type='radio' name='course[<?php  echo $row['course_id'];?>]' value='a' data-type='<?php  echo $row['course_type'];?>' onclick='check(this)' >
                                                <?php  } ?>
                                            </li>
                                        </ul>                                         
                                    <?php  } ?>               
                            <?php  } } ?>
		            </div> 
                        <?php  if(!$you_result ) { ?>
                        <?php  if($result['status']==1 && $result['appointment_end']>time() && $result['appointment_start']<time()) { ?>
                            	<div class="z_dpt5">
	                    		    <input type="button"  value="重置选择"  onclick='return resetcheck()' >
                                    <input type="submit"  name='submit' value="提交预约" >
                                </div>

                        <?php  } else if($result['status']==1 && $result['appointment_end']< time() ) { ?>
                            <div class="z_dpt5">
                                <input type="button"  value="已结束" >
                            </div>
                        <?php  } else if($result['status']==1 && $result['appointment_start']>time() ) { ?>
                            <div class="z_dpt5">
                                <input type="button"  value="未开始" >
                            </div>
                        <?php  } ?> 

                        <?php  } else { ?>
                           <div class="z_dpt5">
                               <a href='<?php  echo $this->createMobileUrl('applist_result');?>'> <input type="button"  value="已经选择，无法修改，查看预约结果" > </a>
                            </div>
                        <?php  } ?>
            </form>         

	</div>
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

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
