<?php if (!defined('THINK_PATH')) exit();?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo ($title); ?></title>
    <link href="/Public/hh/mui.min.css" rel="stylesheet">
    <link href="/Public/hh/style.css" rel="stylesheet">
	<script charset="UTF-8" src="/Public/wx/rw/js/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="/Public/wx/rw/css/weui.min.css">

	<script src="/Public/wx/rw/js/jquery-weui.min.js"></script>
    <script src="/Public/wx/rw/js/jquery-1.11.3.min.js"></script>
    <script src="/Public/wx/rw/js/jquery-weui.min.js"></script>
</head>

<body class="loginbg mui-android mui-android-5 mui-android-5-0">
    <header class="mui-bar mui-bar-nav">
        <h1 class="mui-title"><?php echo ($title); ?></h1>
    </header>
	
	<div >
	<img src="/images/loginlogo.png" style="width:20%;margin-left:40%;margin-top:70px;border-radius:10px;margin-bottom:1px"/>
	</div>
<div style="height:10px;"></div>

	<form action="" id="myform" method="post"style="margin-top:15px">
    	<div style="margin: 0 auto;width: 92%;background: #fff;border: 1px solid #e3e3e3;border-radius: 5px;">
		<input type="hidden"  name="parent"  id="parent"  value="<?php echo ($d_key); ?>">
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
				手机号：<input name="mobile"  id="mobile"  value="" maxlength="11" type="text" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;" autocomplete="off" placeholder="请输入手机号" />
			</div>
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
				真实姓名：<input name="truename"  id="truename"  value="" maxlength="11" type="text" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;" autocomplete="off" placeholder="与提现时银行卡一致！" />
			</div>

			<input type="hidden" name="alipay_voucher" value="" id="alipay_voucher">
             <div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
				图形验证码：<input type="text" placeholder="图形验证码" required id="verify" name="verify" style="width: 40%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
				<img src="<?php echo U('Sem/verify');?>" onClick="this.src='<?php echo U('Sem/verify','','');?>?'+Math.random();" width="60" height="25">
             </div>
            
			<div class="code" style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
				验证码：<input type="text" placeholder="短信验证码" name="code" required id="code" class="fl"style="width:40%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
				<span class="fr" id="count_down" onClick="send_sms_reg_code()" style="color:#ffffff;background-color: #1172ff;display: inline-block;width: 35%;text-align: center;font-size: 1em;padding: 0px 0 0px;border-radius: 5px">发送验证码</span>
			</div>

			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
				登陆密码：<input type="password" placeholder="请输入登录密码" required name="password" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
			</div>
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
			  	确定密码：<input type="password" placeholder="确定登录密码" required name="password1" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
			</div>
			<div style="margin-left: 5%;width: 95%; height: auto;border-bottom: 1px solid #e3e3e3;">
			  	推荐人号：<input type="text"  name="id"  id="id"  value="" style="width: 70%;color: #999999;font-size: 1em;-webkit-appearance: none;border: none;outline: medium;">
			</div>

		</div>
		<div style="height:40px;"></div>
		<!-- <button type="button" id="submit" class="btn_submit_my" style="margin-left: 5%;width: 90%;height: 2.5em;line-height: 2.5em;font-size: 1em;letter-spacing: 1px;text-align: center;color: #fff;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;background-color: #39393d;border: 0; margin-bottom:15px;">注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;册</button> -->
		<input type="button" id="submit" class="btn_submit_my" style="margin: 0.35rem auto 0;display: block;color: #1172ff;border: 1px solid #1172ff;width: 21rem;height: 2.5rem;padding: 0.1rem 0;font-size: 1rem;border-radius: 0.3rem;text-align: center;background: #fff;" value="注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;册">
		
		
	</form>
<script src="/Public/layer/layer.js"></script>
 <script type="text/javascript">
	$(".btn_submit_my").click(function(){
		
			$.ajax({
				url:'<?php echo U("Index/Sem/regSemposty");?>',
				type:'POST',
				data:$("#myform").serialize(),
				dataType:'json',
				success:function(json){
						layer.alert(json.info);
						if(json.result ==1){
							window.location.href='<?php echo U("Index/Login/index");?>';	
						}
				},
				error:function(){
						layer.alert("网络故障");	
				}
			})
	})

</script>

<script type="text/javascript">
	// 发送手机短信
    function send_sms_reg_code(){
        var mobile = $('#mobile').val();

        if(!checkMobile(mobile)){
            layer.alert('请输入正确的手机号码');
            return;
        }
		

		
        var url = "/index.php/index/sem/send_sms_reg_code/mobile/"+mobile+"/verify/"+verify;
        $.get(url,function(data){
            obj = $.parseJSON(data);
            if(obj.status == 1)
			{
				$('#count_down').attr("disabled","disabled");				
				intAs = 60; // 手机短信超时时间
                jsInnerTimeout('count_down',intAs);						
			}
			layer.alert(obj.msg);// alert(obj.msg);
            
        })
    }
   $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
            codeObj.text("获取验证码");
            return true;
        }

        codeObj.text(intAs+'秒');
        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
function checkMobile(tel) {
    var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
    if (reg.test(tel)) {
        return true;
    }else{
        return false;
    };
}
</script>


<script>
//首页返回逻辑
document.addEventListener('plusready', function(a) {
            var first = null;
            plus.key.addEventListener('backbutton', function() {
                    //首次按键，提示‘再按一次退出应用’
                    if (!first) {
                        first = new Date().getTime();
                        console.log('再按一次退出应用');//用自定义toast提示最好
                        setTimeout(function() {
                            first = null;
                        }, 1000);
                    } else {
                        if (new Date().getTime() - first < 1000) {
                            plus.runtime.quit();
                        }
                    }
                }, false);
        });
</script>




</body></html>