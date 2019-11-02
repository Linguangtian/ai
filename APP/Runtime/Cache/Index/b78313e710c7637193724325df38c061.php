<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>我要提现</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="/Public/wx/tx/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/Public/wx/tx/css/weichat.css">
    <link rel="stylesheet" href="/Public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/Public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/Public/wx/css/reset.css">
    <link rel="stylesheet" href="/Public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/Public/wx/css/style.css">

    <script src="/Public/wx/bd/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/wx/bd/js/layer/layer.js"></script>

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
    <h1 class="flex-1">我要提现</h1>
</div>

<div class="wrap">
    <div class="tixian-box">
        <form method="post" action="<?php echo U('index/wallet/withpost');?>">
        <div class="tobank" >
            <span class="dzyh" style="font-size:0.25rem;margin-top: 0.325rem;">提现方式</span>
            <span class="dz"style="margin-left: 0.625rem; margin-top: 0.2rem;">每天20点统一处理</span>
        </div>

        <div class="t-moneys">
            <select class="yhk" name="card" id="type" style="font-size: 0.25rem;margin-top: 0.2rem;"/>
            <option value="" ">请选择提现方式</option>
            <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["card"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
            <span class="txje"><p style="font-size:0.25rem;">提现金额</p></span>
            <span class="rmb">￥</span>

            <span class="kyye" style="font-size:0.25rem;">当前零钱余额：<?php echo ($money); ?>元，<a href="javascript:;">提现手续费3%</a></span>
            <input type="text" class="t-input" name="txmoney">
            <button id="getout" style="margin-top:5px;margin-bottom:50px;">提现</button>
        </div>
        </form>
    </div>
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