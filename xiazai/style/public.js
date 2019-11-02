$(function() {
	/*横竖屏自适应匹配缩放比*/
	Adaptive();
	$(window).resize(function() {
		Adaptive();
	});
	/**
	 * 这里的32和SCSS文件自适应换算单位
	 * 的方法里的32是对齐的作为计算参考值
	 * 750则是原设计稿的宽度，width=320指适配最小宽度
	 */
	function Adaptive() {
		var k = 1 / window.devicePixelRatio;
		$("meta[name=viewport]").prop("content","width=640,initial-scale=" + k + ",minimum-scale=" + k + ",maximum-scale=" + k + ",user-scalable=no");
		var w = parseInt($(window).width());
		var h = parseInt($(window).height());
		var s = 0;
		if (w<h) {s = w;} else{s = h;}
		var fontSize = s*32/750+"px";
		$("html").css("font-size",fontSize);
	}
	
})
