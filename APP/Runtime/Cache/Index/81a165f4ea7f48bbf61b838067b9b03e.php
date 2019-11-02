<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head design-width="750">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<title>团队详情</title>
	<link rel="stylesheet" href="/Public/wx/td/css/style.css" /><!--页面样式-->

	<script src="/Public/wx/td/js/auto-size.js"></script><!--设置字体大小-->
	<link href="/Public/wx/td/lb/css/swiper.min.css" type="text/css" rel="stylesheet">
	<link href="/Public/wx/td/lb/css/style.css" type="text/css" rel="stylesheet">


	<script src="/Public/wx/td/js/jquery-2.2.4.min.js"></script><!--设置字体大小-->
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
		function adaPtive(max) { window['adaptive'].desinWidth = 720;
			window['adaptive'].baseFont = 24;
			window['adaptive'].scaleType = 1;
			window['adaptive'].maxWidth = max;
			window['adaptive'].init(); }
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
	<h1 class="flex-1">团队详情</h1>

</div>
<div class="mobile-wrap center mobile-wrap-mb">
	<main>
		<div class="inform">
			<h3>团队详情</h3>
			<div class="inform-list">
				<ul>
					<li class="acti">一代会员</li>
					<li>二代会员</li>
					<li>团队记录</li>
				</ul>
			</div>
			<div class="inform-text show">
				<div class="recordbox">
					<div class="recordTop">
						<span>会员ID</span>
						<span>姓名</span>
						<span>电话</span>
						<span>收益</span>

					</div>
					<ul class="Putflist">

						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><span><?php echo ($v["id"]); ?></span><span><?php echo ($v["truename"]); ?></span><span><?php echo ($v["username"]); ?></span><span><?php echo ($v["royalty_one"]); ?>元</span></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div class="inform-text">
				<div class="recordbox">
					<div class="recordTop">
						<span>会员ID</span>
						<span>姓名</span>
						<span>电话</span>
						<span>收益</span>
					</div>
					<ul class="Putflist">
						<?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list2): $mod = ($i % 2 );++$i; if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><?php echo ($vo["id"]); ?></span><span><?php echo ($vo["truename"]); ?></span><span><?php echo (yc_phone($vo["username"])); ?></span><span><?php echo ($vo["royalty_two"]); ?>元</span></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div class="inform-text">
				<div class="recordbox">
				<div style="text-align:center;font-size: 0.3rem;margin-top: 0.5rem;margin-bottom: 0.5rem;" >
					<li><span>当前直推人数 : </span><span><?php echo ($minfo["parentcount"]); ?></span> <?php echo ($tuandui); ?> </li>



					<div class="recordTop">
						<span>日期</span>
						<span>来自</span>
						<span>金额</span>
						<span>描述</span>

					</div>
					<ul class="Putflist">
					<?php if(is_array($jinbilog)): $i = 0; $__LIST__ = $jinbilog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><?php echo ($vo["time"]); ?></span><span><?php echo ($vo["tgaward"]); ?></span><span><?php echo ($vo["adds"]); ?>元</span><span>团队奖/span></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				</div>
			</div>
		</div>
	</main>

</div><!--mobile_wrap-->
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