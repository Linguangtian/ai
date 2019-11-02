<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>
<script src="/Public/layer/layer.js"></script>
</head>
<body>
<input type="hidden" id="message" name="message" value="<?php echo($message); ?>">
<input type="hidden" id="jumpUrl" name="jumpUrl" value="<?php echo($jumpUrl); ?>">
<input type="hidden" id="waitSecond" name="waitSecond" value="<?php echo($waitSecond); ?>">
<script type="text/javascript">
(function(){
		var message=$("#message").val();
		var jumpUrl=$("#jumpUrl").val();
		var waitSecond=$("#waitSecond").val();
	layer.open({
		content:message,
  yes: function(index, layero){
    //do something
    location.href = jumpUrl;
    layer.close(index); //如果设定了yes回调，需进行手工关闭
  }
});  
var interval = setInterval(function(){
	var time = --waitSecond;
	if(time <= 0) {
		location.href = jumpUrl;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>