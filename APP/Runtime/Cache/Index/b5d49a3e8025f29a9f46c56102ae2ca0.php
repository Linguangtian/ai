<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0034)http://web.ykbnn.cn/ggz/robot.aspx -->
<html style="font-size: 111.467px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
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
        .robot {
            display: block;
            overflow: hidden;
            color: #fff;
        }

        .robotlist {
            display: block;
            overflow: hidden;
            clear: both;
            width: 3rem;
            margin: 0 auto;
            padding: 0;
        }

            .robotlist li {
                float: left;
                list-style: none;
                color: #fff;
                width: 1.5rem;
                text-align: center;
                padding: 0.15rem 0 0.1rem;
                background: url(/images/juxin.png) no-repeat ;
                  background-size: 100% 100%;
                  -moz-background-size: 100% 100%;
                 -webkit-background-size: 100% 100%;
               
                padding-bottom:0.3rem;
            }

                .robotlist li p {
                    margin: 0;
                    font-size: 0.16rem;
                    color: #fff;
                    padding-bottom: 0.06rem;
                }

                    .robotlist li p.spa {
                        color: #8084bd;
                        font-size: 0.15rem;
                    }

                .robotlist li:last-child {
                    border-right: none;
                }

                .robotlist li button {
                    border: none;
                    background: #0f0b3b;
                    color: #fff;
                    border-radius: 0.25rem;
                    padding: 0;
                    line-height: 0.22rem;
                    width: 0.5rem;
                }

        .robot-content {
            /*margin: 0.35rem 0 0 0;*/
            text-align: center;
            padding: 0.32rem 0;
            /*height: 4.2rem;*/
            /*background: url(/images/bg.png) left top no-repeat;*/
            background-size: 100% auto;
        }

            .robot-content h2 {
                font-size: 0.22rem;
                color: #000;
            }

        .robot-photo {
            position: relative;
          width: 2.5rem;
				height: 2.5rem;
            margin: 0.2rem auto;
            border-radius: 50%;
        }

            .robot-photo img {
               
				width: 2.5rem;
				height: 2.5rem;
				margin-top:0.1rem;
 		
            }

            .robot-photo p {
                margin: 0.1rem 0 0 0;
                color: #94527e;
            }

        .robot-content span.buybtn {
            /*border: 2px solid #1a1e55;*/
            color: #87a9ff;
            display: inline-block;
            line-height: 0.32rem;
            border-radius: 0.08rem;
            padding: 0 0.05rem;
            background: url(/images/buy.png) no-repeat;
             background-size: 100% 100%;
                  -moz-background-size: 100% 100%;
                 -webkit-background-size: 100% 100%;
            font-weight:bold;
            margin: 0.2rem 0 0 0;
        }

        .layout {
            padding: 0.18rem 0.18rem;
            color: #000;
        }

            .layout .title {
                color: #000;
                text-align: center;
                line-height: 0.26rem;
            }

            .layout .textdiv {
                padding: 0.15rem 0 0 0;
                line-height: 35px;
            }

                .layout .textdiv label {
                    float: left;
                    width: 0.56rem;
                }

        .button-grounp {
            margin: 0.15rem 0 0 0;
            text-align: center;
        }

            .button-grounp button {
                margin: 0 0.08rem;
                padding: 0.08rem 0.25rem;
                border: none;
                font-size: 0.14rem;
                border-radius: 0;
            }

        .mui-btn-cancel {
            background: #515151;
            color: #fff;
        }

        .mui-btn-buy {
            color: #fff;
            background: #1678e3;
        }

     

        .robot-photo span {
            position: absolute;
            color: #fff;
            text-align: center;
        }

            .robot-photo span b {
                display: block;
                width: 0.5rem;
                height: 0.5rem;
                background:url(/images/zs.png) center center no-repeat;
                border-radius: 50%;
                /*border: 2px solid #1d255f;*/
                background-size: 0.32rem auto;
            }

            .robot-photo span.mm1 {
                top: -0.2rem;
                left: -0.5rem;
            }

            .robot-photo span.mm2 {
                top: -0.3rem;
                right: -0.6rem;
            }

            .robot-photo span.mm3 {
                top: 1.6rem;
                left: -0.5rem;
            }

            .robot-photo span.mm4 {
                top: 1.5rem;
                right: -0.6rem;
            }
              .container {
            position: relative;
            background: url(/images/wbg.jpg) no-repeat;
             background-size: 100% 100%;
                  -moz-background-size: 100% 100%;
                 -webkit-background-size: 100% 100%;
                  padding: .7rem 0 0.5rem;
        }
       
    </style>
</head>

<body class="loginbg graybg container mui-android mui-android-6 mui-android-6-0">
    <header id="head" class="mui-bar mui-bar-nav">
        <h1 class="mui-title"><?php echo ($title); ?></h1>
    </header>
    <div class="mui-content main " style="padding-top: 11px;">


        <div class="robot-content">
            <div class="robot-photo">
                
                    
                    
                <img src="/Public/hh/load.gif?v=10">
            </div>
            <span class="buybtn">主人，请购买我为您打工吧~</span>
        </div>

        <div class="robot">
            <ul class="robotlist">
                <li>
                    <a href="<?php echo U('Index/robot/rcontent');?>">
					<p><?php echo ($count); ?>个</p>
                    <p class="spa">机器人</p>
                    <!-- <button id="soonBuy">简介</button> -->
					<button >简介</button>
					</a>
                </li>
                <li>
					<a href="<?php echo U('Index/robot/robot');?>">
                    <p><?php echo ($count); ?>个</p>
                    <p class="spa">工作中</p>
                    <button class="mui-btn-buy">查看</button>
					</a>
                </li>
            </ul>
        </div>
    </div>

    <footer id="foot" class="footer">
        <ul class="footerlist">
            <li class="hover"><a href="<?php echo U('index/index/index');?>"><span class="icon1"></span>首页</a></li>
            <li><a href="<?php echo U('index/robot/index');?>"><span class="icon2"></span>机器人</a></li>
            <li><a href="<?php echo U('index/index/personal');?>"><span class="icon3"></span>我的</a></li>
        </ul>
    </footer>


    <div class="layout mui-hidden" id="layout">
<form action="<?php echo U('/Index/Robot/buy');?>" method="post">
		<input type="hidden" name="id" value="<?php echo ($id); ?>">
        <div class="title"><?php echo ($data["title"]); ?>购买</div>
            <div class="textdiv">
                <label>单价：</label>
                <span><?php echo ($data["price"]); ?>元</span>
            </div>
           <div class="textdiv">
                <label>数量：</label>
                <div class="mui-numbox">
                    <button class="mui-btn mui-numbox-btn-minus" id="jian" type="button" disabled="disabled">-</button>
                    <input class="mui-numbox-input" id="number" name ="number"value="1">
                    <button class="mui-btn mui-numbox-btn-plus" id="jia" type="button">+</button>
                </div>
            </div>
            <div class="textdiv">
                <label>合计：</label>
				 <input class="mui-numbox-input" id="number" type="hidden" name ="number"value="1">
                <span id="price"><?php echo ($data["price"]); ?></span>
            </div>	
        <div class="button-grounp">
            <button class="mui-btn mui-btn-cancel">取消</button>
            <button class="mui-btn mui-btn-buy">购买</button>
        </div>
        </form>

    </div>
    <script>
        window.onload = function () {
            $('#mm1').click(function () {
                upRead($("#mm1").attr("lang"));
                $("#mm1").remove();
            })
            $('#mm2').click(function () {
                upRead($("#mm2").attr("lang"));
                $("#mm2").remove();
            })
            $('#mm3').click(function () {
                upRead($("#mm3").attr("lang"));
                $("#mm3").remove();
            })
            $('#mm4').click(function () {
                upRead($("#mm4").attr("lang"));
                $("#mm4").remove();
            })

            $('#jia').click(function () {
                var yg=0;
            var num=$('#number').val();
            var sm=parseInt(num)+parseInt(yg);
            var xg=<?php echo ($data["xiangou"]); ?>;
            if(sm>3){
                mui.toast("只能购买3台");
                $('#number').val((num-1));
                $('#jia').attr("disabled","disabled");
            
                if($('#number').val()==1){
                    $('#jian').attr("disabled","disabled");
                }
            } else {
                var price=num*<?php echo ($data["price"]); ?>;
                $('#price').html(price+".00元");
            }
           

        });
            $('#jian').click(function () {
				alert('1111111111111111');
                var num=$('#number').val();
                if(num==1){
                    $('#jian').attr("disabled","disabled");
                }
                var price=num*<?php echo ($data["price"]); ?>;
                $('#price').html(price+".00元");
               
            })
        }
    </script>
    <script type="text/javascript">
        // 获取输入框的值
        mui.ready(function () {
            var mask = mui.createMask();
            mui(".mui-content").on('tap', 'button#soonBuy', function (e) {
                mask.show();
                document.getElementById("layout").classList.remove('mui-hidden');
            });
            mui('#layout').on('tap', 'button.mui-btn-cancel', function (e) {
                mask.close();//关闭遮罩
                document.getElementById("layout").classList.add('mui-hidden');
            })
        })
    </script>


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