<?php defined('IN_IA') or exit('Access Denied');?>			<select name='grade_id' class='col-xs-6 col-sm-9 col-lg-3 form-control' id='grade_id' style="height:30px;">
				<?php  if(is_array($grades)) { foreach($grades as $row) { ?>
				<?php  if(!$frist_id ) { ?>
					<?php  $frist_id=$row;?>
				<?php  } ?>
				<?php  if($result['grade_id']==$row['grade_id']) { ?>
					<?php  $frist_id=$row?>
				<?php  } ?>
					<option value='<?php  echo $row['grade_id'];?>' <?php  if($result['grade_id'] == $row['grade_id'] ) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
				<?php  } } ?>
			</select>
			<select name='class_id'  class='col-xs-6 col-sm-9 col-lg-3 form-control' style='height:30px' id='class_id'>
				<?php  if(is_array($frist_id['second'])) { foreach($frist_id['second'] as $row) { ?>
					<option value='<?php  echo $row['class_id'];?>' <?php  if($result['class_id'] == $row['class_id'] ) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
				<?php  } } ?>
			</select>			
<script>
$(function(){
	$('#grade_id').change(function(){
		var arr=new Array();
		<?php  if(is_array($grades)) { foreach($grades as $re) { ?>
			arr[<?php  echo $re['grade_id'];?>]=new Array();
			<?php  $i=0;?>
			<?php  if($re['second']) { ?>
			<?php  if(is_array($re['second'])) { foreach($re['second'] as $row) { ?>
				arr[<?php  echo $re['grade_id'];?>][<?php  echo $i;?>]=new Array();
				arr[<?php  echo $re['grade_id'];?>][<?php  echo $i;?>]['id']='<?php  echo $row['class_id'];?>';
				arr[<?php  echo $re['grade_id'];?>][<?php  echo $i;?>]['name']='<?php  echo $row['class_name'];?>';
				<?php  $i++?>
			<?php  } } ?>
			<?php  } ?>
		<?php  } } ?>
		var val=$(this).val();
		$('#class_id').html(" ");
		var long_a=arr[val].length;
		for(var i=0;i<long_a;i++){
			$('#class_id').append("<option value='"+arr[val][i]['id']+"'>"+arr[val][i]['name']+"</option>");
		}
	});
});
</script>