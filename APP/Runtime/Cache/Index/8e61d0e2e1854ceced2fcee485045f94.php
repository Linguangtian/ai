<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>云智机器人</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="/Public/wx/wx/css/reset.css" />
    <link rel="stylesheet" href="/Public/wx/wx/css/animate.css" />
    <link rel="stylesheet" href="/Public/wx/wx/css/swiper-3.4.1.min.css" />
    <link rel="stylesheet" href="/Public/wx/wx/css/layout.css" />

    <script src="/Public/wx/wx/js/jquery-1.9.1.min.js"></script>
    <script src="/Public/wx/wx/js/zepto.min.js"></script>
    <script src="/Public/wx/wx/js/fontSize.js"></script>
    <script src="/Public/wx/wx/js/swiper-3.4.1.min.js"></script>
    <script src="/Public/wx/wx/js/wcPop/wcPop.js"></script>
    <link rel="stylesheet" href="/Public/wx/lib/weui.min.css">
    <link rel="stylesheet" href="/Public/wx/css/jquery-weui.css">
    <link rel="stylesheet" href="/Public/wx/css/reset.css">
    <link rel="stylesheet" href="/Public/wx/css/box-flex.css">
    <link rel="stylesheet" href="/Public/wx/css/style.css">
    <link rel="stylesheet" href="/Public/wx/td/css/new_file.css" type="text/css">
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
<!-- <div class="wx-header clearfix flex">
    <div class="wx-header-left">
        <a href="javascript:history.go(-1);">
            <i class="iconfont icon-zuo"></i>
        </a>
    </div>
    <h1 class="flex-1">转发机器人</h1>
</div> -->

<!-- <>微聊主容器 -->
<div class="wechat__panel clearfix">
    <div class="wc__home-wrapper flexbox flex__direction-column">
        <!-- //顶部 -->
       <!-- <div class="wc__headerBar fixed">
            <div class="inner flexbox">
                <a class="back splitline" href="javascript:;" onclick="history.back(-1);"></a>
                <h2 class="barTit flex1">机器人资料</h2>
            </div>
        </div> -->
		<div class="wx-header clearfix flex">
		    <div class="wx-header-left">
		        <a href="javascript:history.go(-1);">
		            <i class="iconfont icon-zuo"></i>
		        </a>
		    </div>
		    <h1 class="flex-1">机器人资料</h1>
			
		</div>
        <!-- <form action="<?php echo U('/Index/Robot/buy');?>" method="post"> -->
			 <!-- <button id="soonBuy">简介</button> -->
        <!-- //详细资料页 -->
        <div class="wc__ucinfoPanel">
            <div class="wc__ucinfo-detail">
                <ul class="clearfix" id="J__ucinfoPanel">
                    <input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <li>
                        <div class="item flexbox flex-alignc wc__material-cell" >
							
                            
							<img class="uimg" src="../../../../../../images/r.png" style="margin-top: 0.3125rem;" />
                            <label class="lbl flex1">
                                <em><?php echo ($data["title"]); ?></em><i style="font-size: 0.4125rem;text-align: -webkit-left;color: orangered;">价格：99RMB</i>
                            </label>
							<!-- <button style="color: #fff;margin-top: 0px;display:block;position:absolute;right:30px;top:50%;margin-top: -15px;font-size: 16px;padding: 5px;background-color: #39393d;border: 0px solid #fff;border-radius: 4px;">购买</button> -->
				
                        </div>
                    </li>
                    <li>
                        <div class="item flexbox flex-alignc wc__material-cell">
                            <label class="lbl flex1">当前机器人租赁期限内大致收益<font color="red">≈0.20833333</font>元/小时</label>
                        </div>
                    </li>
                    <li>
                        <div class="item flexbox flex-alignc wc__material-cell">
                            <label class="lbl">租赁期限</label>
                            <div class="cnt flex1 c-999">720小时</div>
                        </div>
                        <div class="item flexbox flex-alignc wc__material-cell">
                            <label class="lbl">限购数量</label>
                            <div class="cnt flex1 c-999">5台</div>
                        </div>
                        <div class="item flexbox flex-alignc wc__material-cell">
                            <label class="lbl flex1">详细说明</label>
                            <textarea style="width:480px; height:120px;font-size: 13px;border-radius: 8px;background: #FFFFFF;" disabled>&nbsp;&nbsp;&nbsp;&nbsp;云智机器人由深圳创客云端科技有限公司研发，通过人工智能算法，实现全自动浏览、点击广告及流量任务的功能，平台广告主要来自各大广告联盟，如：百度联盟、360联盟、变现猫、A5广告等，所有广告正规安全。</textarea>
                        </div>
                    </li>
                </ul>
            </div>
<!--             <div class="wc__btns-panel">
                <button class="wc__btn-primary" style="height: 30px;line-height: 30px;width: 100%;border-radius: 5px;border:none;color:#eee; background:#39393d;padding-left: 5px;-webkit-appearance:none;">购买</button>
            </div> -->
        </div>
        </form>
    </div>
</div>


    

</body>
<!--  weui-tabbar -->

<!--  weui-tabbar -->
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