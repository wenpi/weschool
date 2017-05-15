<?php defined('IN_IA') or exit('Access Denied');?><!--默认js-->	<script>require(['bootstrap']);</script><!--默认js-->
	
</div>	
<!--尾部--> 
<div class="foot" id="footer">
	<ul class="links ft">
		<li class="links_item no_extra">
			<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?><a href="" target="_blank">技术支持QQ：2646614476</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerright'];?><?php  } ?><?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?>&nbsp; &nbsp; <?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
		</li>	

	
	
	</ul>
</div>
</body>
</html>