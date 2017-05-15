<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main">
<div class="b3-t">
    <div class="kzk"></div>
	        <li style="background-image:url(<?php  echo $my_info['avatar'];?>);" ></li>
	</div>
      <form class="form-signin" action=" " method="POST">
        <div class="sq">
            <div class="sq-t">
                <p class="sq-11">手机</p>
                <input class="sq-t2" name='mobile' placeholder="手机号码" value='<?php  echo $my_info['mobile'];?>' required autofocus>
            </div>
            <div class="sq-t">
                <p class="sq-11">昵称</p>
                <input class="sq-t2" name='nickname' class="weui_input" placeholder="昵称"  value='<?php  echo $my_info['nickname'];?>' required>
            </div>
        </div>
	    <div class="z_dpt5">
            <input type='hidden' value='1' name='submit' >
			<input type="submit"  value="提交">
		</div>
    </form>
 </div>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>