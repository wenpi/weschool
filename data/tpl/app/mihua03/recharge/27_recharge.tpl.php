<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	body{background:#d2e6e9;}
	/*手机余额充值*/
	.charge.panel{margin:.5em; border:none;}
	.charge.panel-info>.panel-heading {background: -webkit-gradient(linear, 0 0, 100% 0, from(#ebebeb), to(#f3f9fa), color-stop(30%, #f5f9f9)); color:#666666; border:none;}
	a{color:#666666;}a:hover{color: #3ebacc;}
	.charge .btn.btn-primary{background: #56c6d6; color: #FFF; border: 0;}
	.charge i{display:inline-block; width:15px; height:15px; text-align:center; line-height:15px;}
</style>
<div class=" panel panel-info charge">
	<div class="panel-heading">
		<h4>会员卡充值</h4>
	</div>
	<div class="panel-body">
		<form  method="post" role="form" id="form1">
			<input type="hidden" name="c" value="entry" />
			<input type="hidden" name="m" value="recharge" />
			<input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>" />
			<input type="hidden" name="do" value="pay" />
			<div class="form-group input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" placeholder="" value="<?php  echo $name;?>" readonly>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-money"></i></div>
					<input type="text" name="credit" class="form-control" placeholder="充值金额">
				</div>
				<?php  if(!empty($recharge)) { ?>
					<div class="help-block"><span class="text-danger">如果填写金额,将已填写的金额为最终充值金额</span></div>
				<?php  } ?>
			</div>
			<?php  if(!empty($recharge)) { ?>
				<div class="form-group clearfix">
					<?php  if(is_array($recharge)) { foreach($recharge as $key => $row) { ?>
					<?php  if(!empty($row['back']) && !empty($row['condition'])) { ?>
						<a href="javascript:;" class="btn btn-warning <?php  if($_GPC['fee'] == $row['condition']) { ?>btn-danger<?php  } ?> col-lg-3 recharge" data-value="<?php  echo $row['condition'];?>" data-key="<?php  echo $key;?>" style="margin-left:5px;margin-top:8px;">充<?php  echo $row['condition'];?>送<?php  echo $row['back'];?><?php  if($row['backtype']=='1') { ?>积分<?php  } else { ?>元<?php  } ?></a>
					<?php  } ?>
 					<?php  } } ?>
				</div>
			<?php  } ?>
			<div class="form-group">
				<input type="hidden" name="select" value="" id="select">
				<input type="hidden" name="select_key" value="" id="select_key">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" name="submit" class="btn btn-primary btn-block" value="立即充值">
			</div>
		</form>
	</div>
</div>
<script>
	require(['util'], function(u){
		$('.recharge').click(function(){
			var has_danger = $(this).hasClass('btn-danger');
			$('#select').val(0);
			$('#select_key').val(0); 
			$('.recharge').removeClass('btn-danger');
			if(has_danger) {
				$(this).removeClass('btn-danger');
			} else {
				$(this).addClass('btn-danger');
				$('input[name="credit"]').val(0);
				$('#select').val($(this).data('value'));
				$('#select_key').val($(this).data('key'));
			}
			return false;
		});

		$('#form1').submit(function(){
			var credit = parseFloat($('#form1 :text[name="credit"]').val());
			var select = $('#form1 a.recharge.btn-danger').size();
			if(select == 1) {
				$('#select').val($('#form1 a.recharge.btn-danger').data('value'));
			}
			if(isNaN(credit) && !$('#select').val()) {
				u.message('请输入或选择充值金额', '', 'error');
				return false;
			}
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/toolbar', TEMPLATE_INCLUDEPATH)) : (include template('common/toolbar', TEMPLATE_INCLUDEPATH));?>

