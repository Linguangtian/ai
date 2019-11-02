<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0034)http://web.ykbnn.cn/ggz/about.aspx -->
<html style="font-size: 111.467px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>项目说明</title>
    <script src="/Public/hh/mui.min.js"></script>
    <script src="/Public/hh/rem.js"></script>
    <link href="/Public/hh/mui.min.css" rel="stylesheet">
    <link href="/Public/hh/style.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
    <style>
        .about {
            padding: 0.2rem 0.15rem;
            font-size: 0.14rem;
        }

            .about p {
                font-size: 0.14rem;
                color: #656565;
                line-height: 0.24rem;
            }
    </style>
</head>

<body class="loginbg">
    <header id="head" class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-arrowleft colorfont"></a>
        <h1 class="mui-title">项目说明</h1>
    </header>
    <div class="mui-content main">
        <div class="about">
            <h3 align="center"><?php echo ($about["title"]); ?></h3>
        </div>
		 <font color ="#656565"><?php echo ($about["content"]); ?></font>
    </div>

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




</body></html>