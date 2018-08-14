<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>来团</title>

<script type="text/javascript" src=""> </script>
</head>
	<body>
		<p>登录</p>
		<form action="<?php echo U('User/login');?>" method="post">
			<p>用户名</p> 	<input type="text" name="C_name"></input>
			<p>密码</p> 		<input type="text" name="C_password"></input><br />
			<input type="submit" value="提交"></input>
		</form>
		<p>注册</p>
		<form action="<?php echo U('User/register');?>" method="post">
			<p>用户名</p> 	<input type="text" name="C_name"></input>
			<p>密码</p> 		<input type="text" name="C_password"></input>
			<p>密码确认</p>	<input type="text" name="C_repassword"></input><br />
							<input type="submit" value="提交"></input>
		</form>
	
		<p><a href="<?php echo U('Goods/show');?>">商品发布</a></p>
		<p>商品展列</p>
		<p><a href="<?php echo U('Goods/display_goods');?>">商品列表</a></p>
		<?php if($name == '蜡笔小新'): ?>蜡笔小新<?php endif; ?>
		<?php if(is_array($g_list)): $i = 0; $__LIST__ = $g_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gl): $mod = ($i % 2 );++$i;?><li><?php echo ($gl["name"]); ?>:<?php echo ($gl["price"]); ?>:<?php echo ($gl["description"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</body>
</html>