<?php defined('IN_IA') or exit('Access Denied');?><?php  define('MUI', true);?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<script>
	$(function(){
		$(document).on('input propertychange', '.js-mobile-val', function(){
				var mobile_value = $(this).val();
				if (mobile_value.length == '11') {
					$.post("<?php  echo url('auth/login/mobile_exist')?>", {'mobile' : mobile_value}, function(data) {
						data = $.parseJSON(data);
						if (data.message.errno == '1') {
							$('.js-check-mobile').addClass('send-code');
						} else if (data.message.errno == '2'){
							$('.js-check-mobile').removeClass('send-code');
							util.toast('手机号不存在', '', 'error');
							return;
						}
					});
				} else {
					$('.js-check-mobile').removeClass('send-code');
				}
			});
		$(document).on('click', '.send-code', function(){
			var username = $('#sendcode input[name="username"]').val();
			option = {
				'btnElement' : $('.send-code'),
				'showElement' : $('.js-timer'),
				'btnTips' : '<a class="send-code">重新获取验证码</a>',
				'successCallback' : function(ret, message){
					if (ret == '0') {
						util.toast(message);
						$('#sendcode').hide();
						$('#codeverify').show();
					} else {
						util.toast(message);
						$('#sendcode').show();
						$('#codeverify').hide();
						return;
					}
				}
			};
			util.sendCode(username, option);
		});
		$(document).on('click', '.check-verify', function(){
			var code = $('#codeverify input[name="code"]').val();
			if (!code) {
				util.toast('未填写验证码', '', 'error');
				return;
			}
			if (code.length < 6) {
				util.toast('验证码少于六位', '', 'error');
				return;
			}
			var username = $('#sendcode input[name="username"]').val();
			$.post("<?php  echo url('auth/forget/verifycode')?>", {'code' : code, 'username' : username}, function(dat){
				dat = $.parseJSON(dat);
				if(dat.type != 'success') {
					util.toast(dat.message, '', 'error');
					return;
				} else {
					$('#codeverify').hide();
					$('#reset').show();
					$('#reset .js-reset').text(username);
					return;
				}

			});
		});
		$(document).on('click', '.resetpassword', function(){
			var password = $('#reset input[name="password"]').val();
			var repassword = $('#reset input[name="repassword"]').val();
			if(password == '' || repassword == '') {
				util.toast('请填写密码', '', 'error');
				return;
			}
			if(password.length < 6) {
				util.toast('密码不能少于六位数', '', 'error');
				return ;
			}
			if(password != repassword) {
				util.toast('两次密码输入不一致', '', 'error');
				return ;
			}
			var username = $('#sendcode input[name="username"]').val();
			params = {username, password, repassword};
			$.post("<?php  echo url('auth/forget/reset')?>", {'username' : username, 'password' : password, 'repassword' : repassword}, function(dat){
				dat = $.parseJSON(dat);
				if(dat.type != 'success') {
					util.toast(dat.message, '', 'error');
				} else {
					util.toast('设置密码成功');
					location.href = "<?php  echo url('auth/login', array('forward' => $_GPC['forward']));?>#wechat_redirect";
					return;
				}
			});
		});
	});
</script>
<div class="mui-content">
	<div id="sendcode">
		<div class="mui-content-padded mui-text-muted">请输入手机号,以收取验证码</div>
		<div class="mui-input-group mui-mt15">
			<div class="mui-input-row mui-help">
				<input name="username" type="text" class="js-mobile-val" placeholder="手机号"/>
			</div>
		</div>
		<div class="mui-content-padded">
			<button class="mui-btn mui-btn-success mui-btn-block js-check-mobile" uniacid="<?php  echo $_W['uniacid'];?>">下一步</button>
		</div>
	</div>
	<div id="codeverify" style="display:none;">
		<div class="mui-content-padded mui-text-muted">您的手机号<span class="mui-text-success"></span>会收到一条含有6位数字验证码的短息</div>
		<div class="mui-input-group mui-mt15">
			<div class="mui-input-row mui-help">
				<input type="text" placeholder="请输入验证码" name="code"/>
			</div>
		</div>
		<div class="mui-content-padded mui-text-center">
			<button class="mui-btn mui-btn-success mui-btn-block check-verify">下一步</button>
			<div class="mui-mt15 mui-text-center">
				<span class="mui-text-muted js-timer">

				</span>
			</div>
		</div>
	</div>
	<div id="reset" style="display:none;">
		<div class="mui-content-padded mui-text-muted">请为你的账号<span class="mui-ml5 mui-mr5 js-reset"></span>设置密码,以保证下次正常登录</div>
		<div class="mui-input-group">
			<div class="mui-input-row">
				<input name="password" type="password" placeholder="请设置密码"/>
			</div>
			<div class="mui-input-row">
				<input name="repassword" type="password" placeholder="确认新密码"/>
			</div>
		</div>
		<div class="mui-content-padded mui-text-muted">密码为6~16位数字或字母</div>
		<div class="mui-content-padded">
			<button class="mui-btn mui-btn-success mui-btn-block resetpassword">确认</button>
		</div>
	</div>
</div>
