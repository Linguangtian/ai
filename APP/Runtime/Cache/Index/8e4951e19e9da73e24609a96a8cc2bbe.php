<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>推广中心</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="/Public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/Public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/Public/wx/css/reset.css">
    <link rel="stylesheet" href="/Public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/Public/wx/css/style.css">
    <script src="/Public/wx/lib/jquery-2.1.4.js"></script>
    <script src="/Public/wx/js/adaptive.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        adaPtive(); //铺页面调用
        //页面加载时调用
        $(function() { direction(); });
        //用户变化屏幕方向时调用
        $(window).on('orientationchange', function(e) { direction(); });
        //调用adaptive
        function adaPtive(max) {
            window['adaptive'].desinWidth = 720;
            window['adaptive'].baseFont = 24;
            window['adaptive'].scaleType = 1;
            window['adaptive'].maxWidth = max;
            window['adaptive'].init();
        }
        //判断手机屏幕方向
        function direction() { if (window.orientation == 90 || window.orientation == -90) { adaPtive(320); return false; } else if (window.orientation == 0 || window.orientation == 180) { adaPtive(); return false; } }
    </script>
</head>
<body ontouchstart>
<div class="wx-header clearfix flex">
   <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">推广中心</h1>
</div>

<!--列表开始-->
<div style="text-align:center;padding-bottom:80px;">
<!-- <h3 class="box-title" style="color: #333; text-align: center;border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;font-size: 18px;padding: 10px 0;"></h3> -->
  <img src="<?php echo ($erwei); ?>" style="width:100%;height:90%;">
	<br>
    <P></p>
</div>


</body>

<script type="text/javascript">
    $('.inform-list ul li').click(function(){
        var n=$(this).index();
        $(this).addClass('acti').siblings().removeClass('acti');
        $('.inform-text').fadeOut();
        $('.inform-text').eq(n).fadeIn();
    })
</script>
<script type="text/javascript">
    function jsCopy(){
        var e=document.getElementById("copy-num");//对象是copy-num1
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令

        alert('复制成功');

    }


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


</html>