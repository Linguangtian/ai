<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0037)http://web.ykbnn.cn/ggz/mycenter.aspx -->
<html style="font-size: 110.4px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo ($title); ?></title>
    <script src="/Public/hh/mui.min.js"></script>
    <script src="/Public/hh/rem.js"></script>
    <script src="/Public/hh/jquery-1.11.2.min.js"></script>
    <link href="/Public/hh/mui.min.css" rel="stylesheet">
    <link href="/Public/hh/style.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>

   <style>
        .mui-table-view {
            background: none;
        }

        .mui-table-view-cell {
            display: block;
            overflow: hidden;
            clear: both;
            line-height: 32px;
            padding: 0.06rem 0.15rem;
            font-size: 0.14rem;
            background: #fff;
        }

            .mui-table-view-cell a {
                display: block;
                overflow: hidden;
                clear: both;
                margin: 0 -0.15rem;
            }

            .mui-table-view-cell span.icon {
                float: left;
                width: 0.32rem;
                height: 0.32rem;
                margin-right: 0.06rem;
            }

            .mui-table-view-cell > a:not(.mui-btn) {
                margin: 0 -15px;
            }

            .mui-table-view-cell:after {
                left: 0;
            }

        .ic_mine_user {
            background: url(/images/ic_mine_user.png) no-repeat;
            background-size: 100% 100%;
        }

        .newpassword {
            background: url(/images/newpassword.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_shouyi {
            background: url(/images/ic_mine_shouyi.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_tixian {
            background: url(/images/ic_mine_tixian.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_huoban {
            background: url(/images/ic_mine_huoban.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_help {
            background: url(/images/ic_mine_help.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_tuijian {
            background: url(/images/ic_mine_tuijian.png) no-repeat;
            background-size: 100% 100%;
        }

        .ic_mine_about {
            background: url(/images/ic_mine_about.png) no-repeat;
            background-size: 100% 100%;
        }

        .mt5 {
            margin-top: 0.05rem;
        }

        .exitout {
            text-align: center;
            color: #1280fd;
            font-size: 0.16rem;
        }

        .userInfor {
            display: block;
            overflow: hidden;
            clear: both;
            margin: 0;
            padding: 0.25rem 0.3rem;
            color: #fff;
            font-size: 0.14rem;
          
        }

            .userInfor span.photo {
                width: 0.6rem;
                height: 0.6rem;
                float: left;
                margin-right: 0.12rem;
                /*border-radius: 50%;*/
                overflow: hidden;
            }

                .userInfor span.photo img {
                    width: 100%;
                }

            .userInfor h2 {
                font-size: 0.17rem;
                font-weight: normal;
            }

                .userInfor h2 span {
                    font-size: 0.14rem;
                }

            .userInfor p {
                color: #fff;
                font-size: 0.14rem;
                padding-top: 10px;
            }

        .sumList {
            padding: 0;
            overflow: hidden;
            clear: both;
            width: 100%;
            /*background: #fff;*/
            margin: 0 0 0.05rem 0;
            list-style: none;
        }

            .sumList li {
                list-style: none;
                width: 33.333%;
                float: left;
                /*border-right: 1px solid #eee;*/
                text-align: center;
                padding: 0.12rem 0 0.15rem;
                font-size: 0.13rem;
             
                  background: url(/images/juxin.png) no-repeat;

background-size: 100% 100%;
-moz-background-size: 100% 100%;
-webkit-background-size: 100% 100%;
            }

                .sumList li span {
                    display: block;
                    line-height: 0.22rem;
                }

                    .sumList li span strong {
                        font-size: 0.16rem;
                    }

                        .sumList li span strong.one {
                            color: #1280fd;
                        }

                        .sumList li span strong.two {
                            color: #dead12;
                        }

                        .sumList li span strong.third {
                            color: #d32201;
                        }

                .sumList li:last-child {
                    border-right: none;
                }

        .mui-grid-12 li {
            float: left;
            width: 25%;
            clear: none;
        }

        .mui-grid-12:after {
            display: none;
        }

        .share {
            z-index: 10000;
            width: 100%;
            background: #fff;
            position: fixed;
            bottom: 0px;
            width: 100%;
            padding: 0.1rem 0;
        }

        .mui-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 99;
            background-color: rgba(0,0,0,.6);
        }
     
       .muList {
           background: url(/images/buy.png)no-repeat;
             background-size: 100% 100%;
                  -moz-background-size: 100% 100%;
                 -webkit-background-size: 100% 100%;
                 color:#fff;
       }
    </style>
</head>

<body class="loginbg graybg mui-android mui-android-6 mui-android-6-0">
    <header id="head" class="mui-bar mui-bar-nav">
        <h1 class="mui-title"><?php echo ($title); ?></h1>
    </header>
    <div class="mui-content main">
        <div class="userInfor">
            <span class="photo">
                <img src="/Public/hh/user_default_img.png">
            </span>
            <div class="txt">
                <h2>雇主&nbsp;&nbsp;<font style="color:#C48F1B;font"><?php echo ($minfo["truename"]); ?></font></h2>
                <p><?php echo ($minfo["username"]); ?>（我的ID:<?php echo ($minfo["id"]); ?>） </p>
            </div>
        </div>

        <ul class="sumList">
            <li class="ttli"><a href="<?php echo U('Index/wallet/yuelog');?>"><span><strong class="one"><?php echo ($sum); ?></strong>元</span>总收益</a></li>
            <li class="ttli"><a href="<?php echo U('Index/wallet/change');?>"><span><strong class="two"><?php echo ($minfo["money"]); ?></strong>元</span>余额</a></li>
            <li class="ttli"><a href="<?php echo U('Index/index/team');?>"><span><strong class="third"><?php echo ($count); ?></strong>人</span>我的直推</a></li>
        </ul>

        <ul class="mui-table-view">
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('index/wallet/card');?>"><span class="icon ic_mine_user"></span>绑定银行卡</a>
            </li>
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('Index/index/updatepass');?>"><span class="icon newpassword"></span>修改密码</a>
            </li>
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('Index/wallet/yuelog');?>"><span class="icon ic_mine_shouyi"></span>我的收益</a>
            </li>
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('index/wallet/withdrawn');?>"><span class="icon ic_mine_tixian"></span>我要提现</a>
            </li>
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('index/wallet/withdrawnlog');?>"><span class="icon ic_mine_tixian"></span>提现记录</a>
            </li>
            <li class="mui-table-view-cell  muList">
                <a class="mui-navigate-right" href="<?php echo U('Index/wallet/tgaward');?>"><span class="icon ic_mine_help"></span>推广奖励</a>
            </li>
            <li class="mui-table-view-cell muList">
                <a class="mui-navigate-right" href="<?php echo U('Index/index/tgm');?>"><span class="icon ic_mine_tuijian"></span>我的推广码</a>
            </li>

            <li class="mui-table-view-cell mt5 exitout" id="confirmBtn"><a href="<?php echo U('index/index/logout');?>">退出</a>
            </li>
        </ul>

        <footer id="foot" class="footer">
            <ul class="footerlist">
                <li class="hover"><a href="<?php echo U('index/index/index');?>"><span class="icon1"></span>首页</a></li>
                <li><a href="<?php echo U('index/robot/index');?>"><span class="icon2"></span>机器人</a></li>
                <li class="hover"><a href="<?php echo U('index/Index/personal');?>"><span class="icon3"></span>我的</a></li>
            </ul>
        </footer>
        <div class="mui-backdrop mui-hidden" id="bgmask"></div>
        
    </div>
	
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


</body></html>