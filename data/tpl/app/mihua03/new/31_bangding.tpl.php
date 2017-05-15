<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="target-densitydpi=286, width=640, user-scalable=no" />
    <title>与学生账号绑定</title>
    <link href="<?php echo MODULE_URL;?>/style/css/bdcss.css?=<?php  echo time()?>" rel="stylesheet" />
</head>
<body style="height:1300px">
<form class="form-horizontal" method="post" role="form" action="<?php  echo $this->createMobileUrl('bangding', array('submit' => '1'))?>">
    <div class="con1 mgz xi24">
    <div class="con1z">
    <span class="cheng">*</span>请仔细填写相应资料</div>
    </div>
    <div class="con2 mgz">
        <div class="con2z">
            <input placeholder="请输入学生姓名" name='student_name'>
        </div>
    </div>
    <?php  if($config['family_set']!='alone_school') { ?>
                   <div class="con2 mgz">
                        <div class="con2z xh">
                            <input placeholder="系统编号"  name='student_passport' required >
                        </div>
                    </div>
                <?php  } else { ?>	
                    <div class="con2 mgz">
                        <div class="con2z xh">
                            <input placeholder="请输入学号"  name='student_passport' required>
                        </div>
                    </div>
                <?php  } ?>
    <div class="con3 mgz">
        <div class="con3z">
            <div class="con3l xi24">请输入关系
                <div class="sj">
                    <img src="<?php echo MODULE_URL;?>/style/images/ul.png">
                </div>
                <div class="xl">
                    <ul>
                        <?php  $relation_list = $this->class_base->getRelation(); ?>
							<?php  if(is_array($relation_list)) { foreach($relation_list as $key => $row) { ?>
                                 <div class="liw" onclick="selectVal('<?php  echo $row;?>')" ><li <?php  if(!$relation_list[$key+1]) { ?> class="liz" <?php  } ?> ><a href="javascript:;"><?php  echo $row;?></a></li></div>
							<?php  } } ?>
                    </ul>
                </div>
            </div>
            <div class="gxr">
                <input name="relation" id='relation' required>
            </div> 
        </div>
    </div>
    <div class=" mgz bd">
       <input type="submit" class="dlz cen xi32 bai" value="绑定" name="submit">
    </div>
</body>
<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
<script>
        function selectVal(val){
            $("#relation").val(val);
        }
</script>
</html>