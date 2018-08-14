<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>发布商品</title>
</head>
<body>
<form action="<?php echo U('Goods/pulish');?>" method="post">
	<p>商品名称</p> 	<input type="text" name="name"></input>
	<p>价格</p> 		<input type="text" name="price"></input>
	<p>描述</p>	    <textarea rows="10" cols="30"></textarea>><br />					
				    <input type="submit" value="提交"></input>
</form>

</body>
</html>