<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html style="font-size: 111.467px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo ($title); ?></title>
    <link href="/Public/hh/mui.min.css" rel="stylesheet">
    <link href="/Public/hh/style.css" rel="stylesheet">
	<script src="/Public/wx/rw/js/jquery-1.11.3.min.js"></script>
</head>

<body class="loginbg mui-android mui-android-6 mui-android-6-0">
    <header id="head" class="mui-bar mui-bar-nav">
        <h1 class="mui-title"><?php echo ($title); ?></h1>
    </header>
    <div class="mui-content">
		
		<div >
		<img src="/images/loginlogo.png" style="width:15%;margin-left:45%;margin-top:70px;border-radius:10px;margin-bottom:1px"/>
		</div>
		
        <div id="slider" class="mui-slider">
            <div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control">
                <a class="mui-control-item mui-active" href="<?php echo U('Index/Login/index');?>">
                    <span>登录</span>
                </a>
                <a class="mui-control-item" href="<?php echo U('Index/Sem/regsemsw');?>">
                    <span>注册</span>
                </a>

            </div>
            <div class="mui-slider-group" style="transform: translate3d(0px, 0px, 0px) translateZ(0px); transition-duration: 0ms;">
               
			 
			   <div class="mui-slider-item mui-control-content mui-active">
			   <form name="form" method="post" id="form" class="form-signin">
                    <div class="loginContent">
                        <div class="loginForm">
                            <div class="txt hasborder">
                                <span class="phoneicon"></span>
                                <input name="username" type="text" placeholder="请输入手机号码" maxlength="11" class="phoneText" autocomplete="off">
                            </div>
                            <input type="hidden">
                            <div class="txt hasborder">
                                <span class="passwordicon"></span>
                                <input name="password" type="password" placeholder="请输入密码" class="phoneText" autocomplete="off">
                            </div>
							<!-- <p class="fogetText_left"><a href="<?php echo U('Index/Login/editpwd1');?>">忘记密码?</a></p> -->
                            <p class="fogetText_right"><a href="http://www.aimechine.xyz/xiazai/">下载APP客户端</a></p>
                        </div>    
	  <input type="button"  class="btn_submit_my" style="margin: 0.35rem auto 0;display: block;color: #1172ff;border: 1px solid #1172ff;width: 2.2rem;padding: 0.1rem 0;font-size: 0.14rem;border-radius: 0.3rem;text-align: center;background: #fff;" value="登录">
                    </div>
					</form>
                </div>
				


            </div>
        </div>
    </div>


<script src="/Public/layer/layer.js"></script>
<script type="text/javascript">
	$(".btn_submit_my").click(function(){
			$.ajax({
				url:'<?php echo U("Index/Login/index");?>',
				type:'POST',
				data:$("#form").serialize(),
				dataType:'json',
				success:function(json){
						layer.alert(json.info);
						if(json.result ==1){
							window.location.href=json.url;
						}
				},
				error:function(){
						layer.alert("网络故障");
				}
			})

	})


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





<!-- Panel popup   提示框开始-->
<link rel="stylesheet" type="text/css" href="/public/ajaxsubmit/css/zip.css">
<div id="modal-panel" class="popup-basic bg-none mfp-with-anim mfp-hide" style="max-width:70%"></div>
<!-- End: Main -->
<!--<script type="text/javascript" src="/public/ajaxsubmit/js/jquery-1.11.1.min.js"></script>-->
<script type="text/javascript" src="/public/ajaxsubmit/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/ajaxsubmit/js/zip.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        Core.init()
    });

    $(".btn_submit").on("click", function () {

	    event.preventDefault();
	    var btn_submit = $(this);
	    var form = btn_submit.closest("form");
      var btn_text=btn_submit.text();
      if(btn_submit.attr('reminder')){
        if(!confirm(btn_submit.attr('reminder'))){
          return ;
        }
      }
	 if (form.hasClass("is_submit")) return false;
      var formData = new FormData(form[0]);

	    $.ajax({
	        url: this.title,
	        type: "post",
	        data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
	        beforeSend: function () {
	            btn_submit.text("处理中...").addClass("disabled");
	        },
	        success: function (data) {
                if(data.url){
				    $.alert(data.info);
				    setTimeout(function(){location.href=data.url}, 2000);
	            }else{
					$.alert(data.info);
                }
                btn_submit.text(btn_text).removeClass('disabled');
	        }
	    });
  	});


</script>
<!-- END: PAGE SCRIPTS 提示框结束-->


</body></html>