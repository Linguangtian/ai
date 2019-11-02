<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>奖励记录</title>
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

<body ontouchstart style="background: #fff;">
<div class="wx-header clearfix flex">
    <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">奖励记录</h1>
</div>

<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">
    <table style="width: 90%;margin-left: 5%;color: #f10101;margin-top: 50px;border-collapse:collapse;" class="mytable">
        <thead style="font-size: 12px; ">

        <tr style="height: 35px;line-height: 35px;">
            <th  style="border-bottom:2px solid #ddd ">日期</th>
            <th style="border-bottom:2px solid #ddd ">数量</th>
            <th style="border-bottom:2px solid #ddd ">会员</th>
            <th style="border-bottom:2px solid #ddd ">结余</th>
        </tr>

        </thead>
        <tbody style="font-size: 12px;text-align: center">

        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="height: 35px;line-height: 35px;">
                <td><?php echo (date('Y-m-d',$v["addtime"])); ?></td>

                <td><?php if($v["adds"] == 0.00): ?>-<?php echo (four_number($v["reduce"])); else: ?>+<?php echo (four_number($v["adds"])); endif; ?></td>
                <td><?php echo ($v["tgaward"]); ?></td>
                <td><?php echo (four_number($v["balance"])); ?></td>
            </tr><?php endforeach; endif; ?>

        </tbody>
    </table>

</div>




<script src="/Public/wx/lib/fastclick.js"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
        $("#showMoreLink").on('click',function(){
            $(".moreLink").toggle("fast");
        })
    });
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


<script src="/Public/wx/js/jquery-weui.js"></script>



</body>

</html>