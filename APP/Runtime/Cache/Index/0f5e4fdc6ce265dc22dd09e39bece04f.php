<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>机器人查看</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">

    <link rel="stylesheet" type="text/css" href="/Public/wx/jqr/common.css">
    <link rel="stylesheet" type="text/css" href="/Public/wx/jqr/style1.css">
    <script src="/Public/wx/jqr/jquery-1.11.0.min.js"></script>
    <script src="/Public/wx/jqr/public.js"></script>
    <script src="/Public/wx/bd/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/wx/bd/js/layer/layer.js"></script>
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
    <h1 class="flex-1">机器人查看</h1>
</div>

<div class="neirbg_f">
    <div class="neirbg_f_in" >
        <h2>无需人为操作，自动结算收益</h2>
        <div class="twobf_f">
            <ul>
                <li>
                    <em>机器人数量</em>
                    <p><?php echo ($count); ?>   <font>台</font></p>
                </li>
                <li>
                    <em>机器人收益</em>
                    <p><?php echo ($sum); ?><font>元</font></p>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="zhul" style="padding-bottom:5px;margin-bottom:80px">
    <table style="width: 90%;margin-left: 5%;color: #333333;margin-top: 20px;border-collapse:collapse;" class="mytable">
        <thead style="font-size: 12px; ">

        <tr style="height: 35px;line-height: 35px;">
            <th  style="border-bottom:2px solid #ddd ">机器名称</th>
            <th style="border-bottom:2px solid #ddd ">机器人编号</th>
            <th style="border-bottom:2px solid #ddd ">已运行</th>
            <th style="border-bottom:2px solid #ddd ">已收益</th>
            <th style="border-bottom:2px solid #ddd ">操作</th>

        </tr>
        </thead>
        <tbody style="font-size: 12px;text-align: center">
        <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tr  style="height: 35px;line-height: 35px;">
                <td style="border-bottom:2px solid #ddd "><?php echo ($v["project"]); ?></td>
                <td style="border-bottom:2px solid #ddd "><?php echo ($v["kjbh"]); ?></td>
                <td style="border-bottom:2px solid #ddd ">
                    <?php if($v['zt'] == 1): echo (set_number($v["a_time"],'0')); ?>小时
                        <?php else: ?>
                        --<?php endif; ?>
                </td>
                <td style="border-bottom:2px solid #ddd "><?php echo (four_number($v["already_profit"])); ?></td>
                <td style="border-bottom:2px solid #ddd ">
                        <a style="padding:3px 5px; background:#054177; color:#FFFFFF; border-radius:4px;">正在作业</a>

                </td>

            </tr><?php endforeach; endif; ?>

        </tbody>
    </table>
</div>
<script src="/Public/layer/layer.js"></script>

<script src="/Public/wx/lib/fastclick.js"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
        $("#showMoreLink").on('click',function(){
            $(".moreLink").toggle("fast");
        })
    });
</script>
<script type="text/javascript">
    function jiesuan(id){
        $.ajax({
            url:'<?php echo U("Index/Robot/jiesuan");?>',
            type:'POST',
            data:{id:id},
            dataType:'json',
            success:function(json){
                layer.msg(json.info);
                if(json.result==1){
                    window.location.reload();
                }
            },
            error:function(){
                layer.msg('网络故障！');
            }
        })
    }
</script>
<script src="/Public/wx/js/jquery-weui.js"></script>

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