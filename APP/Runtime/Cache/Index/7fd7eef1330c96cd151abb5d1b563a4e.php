<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
	<script src="/Public/wx/bd/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/wx/bd/js/layer/layer.js"></script>
<link href="/Public/wx/bd/css/style.css" rel="stylesheet" type="text/css">


<title>修改密码</title>

<script>
(function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                if(clientWidth>=750){
                    docEl.style.fontSize = '100px';
                }else{
                    docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                }
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>

</head>

<body>
<div id="Nav_bar">
	<div class="left"><a href="#"  onclick="history.go(-1)"><img src="/Public/wx/bd/img/left_arrow.png"></a></div>
    <div class="center">密码修改</div>
    <div class="right"></div>
</div>
<!--中间内容部分-->
<form action="" method="POST" style="font-size:14px"  id="myform1">
<div id="content">
	<div class="txt01">旧密码<input type="password" id="old_password" name="old_password" placeholder="请输入原登录密码"></div>
    <div class="txt01">新密码<input type="password" id="newpwd" name="newpwd" placeholder="请输入新登录密码"></div>
    <div class="txt01">确认密码<input type="password" id="newpwd1"  name="newpwd1"  placeholder="请重新输入新登录密码"></div>
	<input type="button"  class="r_but" value="确认修改" idtype="myform1"style="width: 100%;line-height: 30px;border-radius: 5px;border: 0px; background-color:#054177;margin-top: 60px;color: #FFFFFF;-webkit-appearance: none;">
</div>

</form>



<script type="text/javascript">
	$(".r_but").click(function(){
		var idtype=$(this).attr("idtype");
		$.ajax({
			url:'<?php echo U("Index/index/updatePasspost");?>',
			type:'POST',
			data:$("#"+idtype).serialize(),
			dataType:'json',
			success:function(json){
				layer.msg(json.info);
				if(json.result ==1){
					window.location.href=json.url;
				}


			},
			error:function(){

				layer.msg("网络故障");
			}



		})

	})


</script>

<script>
//子页返回逻辑
   document.addEventListener('plusready', function() {
    var webview = plus.webview.currentWebview();
    plus.key.addEventListener('backbutton', function() {
        webview.canBack(function(e) {
            if(e.canBack) {
                webview.back();
            } else {
                webview.close(); //hide,quit
                //plus.runtime.quit();
            }
        })
    });
});
</script>


</body>	
</html>