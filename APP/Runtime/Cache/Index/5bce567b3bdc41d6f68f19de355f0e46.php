<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0033)http://web.ykbnn.cn/ggz/news.aspx -->
<html style="font-size: 204.8px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>最新资讯</title>
    <script src="/Public/hh/mui.min.js"></script>
    <script src="/Public/hh/rem.js"></script>
    <link href="/Public/hh/mui.min.css" rel="stylesheet">
    <link href="/Public/hh/style.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
    <style>
        .mui-table-view-cell:after {
            left: 0;
        }

        .mui-table-view-cell {
            padding: 0.15rem 0.1rem;
            font-size: 0.14rem;
        }

            .mui-table-view-cell > a:not(.mui-btn) {
                margin: -0.15rem -0.1rem;
            }

        .mui-table-view .mui-media-object {
            width: 0.8rem;
            max-width: 100%;
            height: 0.6rem;
            float: left;
        }

        .mui-table-view-cell .txt {
            float: left;
            width: 2.4rem;
            overflow: hidden;
        }

            .mui-table-view-cell .txt p {
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
                padding-top: 0.1rem;
            }

        .mui-table-view-cell span {
            float: right;
            color: #aaa;
            margin: 0.08rem 0.15rem 0 0;
        }
    </style>
</head>

<body class="loginbg mui-android mui-android-6 mui-android-6-0">
    <header id="head" class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-arrowleft colorfont"></a>
        <h1 class="mui-title">新闻资讯</h1>
    </header>
    <div class="mui-content main">
        <div class="news">
            <ul class="mui-table-view">
                <?php if(is_array($zaobao)): foreach($zaobao as $key=>$v): ?><li class="mui-table-view-cell">
                            <a class="mui-navigate-right" href="<?php echo U('Index/New/newsdetails',array('news_id'=>$v['id']));?>">
                                <img class="mui-media-object mui-pull-left" src="<?php echo ($v["image"]); ?>">
                                <div class="txt">
                                    <?php echo ($v["title"]); ?>
								<p>点击可以查看内容详情</p>
                                </div>
                                <span><?php echo (date("Y-m-d H:i:s",$v["addtime"])); ?></span>
                            </a>
                        </li><?php endforeach; endif; ?> 

                
            </ul>

        </div>
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