
$(function() {
	// 团购倒计时
	var starttime = new Date("2017/11/20");
  setInterval(function () {
      var nowtime = new Date();
      var time = starttime - nowtime;
      var day = parseInt(time / 1000 / 60 / 60 / 24);
      var hour = parseInt(time / 1000 / 60 / 60 % 24);
      var minute = parseInt(time / 1000 / 60 % 60);
      var seconds = parseInt(time / 1000 % 60);
      if (day <= 9) day = '0' + day;
      if (hour <= 9) hour = '0' + hour;
      if (minute <= 9) minute = '0' + minute;
      if (seconds <= 9) seconds = '0' + seconds;
      $('.day_num').html(day);
      $('.hour_num').html(hour);
      $('.min_num').html(minute);
      $('.second_num').html(seconds);
  }, 1000);
    // 优惠券tab切换
    $('.me-coupons .hd span').on('click',function() {
      $(this).siblings('span').removeClass('cur');
      $(this).addClass('cur');
      $('.me-coupons ul').hide();
      $('.me-coupons ul').eq($(this).index()).show();
    })
    // 优惠券tab切换
    $('.me-order .hd span').on('click',function() {
      $(this).siblings('span').removeClass('cur');
      $(this).addClass('cur');
      $('.me-order ul').hide();
      $('.me-order ul').eq($(this).index()).show();
    })
    //我的订单全部下拉
    $(".me-order-all").click(function() {
      layer.open({
        type: 1
        ,content: '<div class="order-all-con"><span class="cur"><a href="">全部</a></span><span><a href="">待支付</a></span><span><a href="">待发货</a></span><span><a href="">待收货</a></span><span><a href="">待评价</a></span><span><a href="">已完成</a></span></div>'
        ,anim: false
        ,style: 'position:fixed; top:0; left:0; width: 100%; height: 7.1875rem; border:none;'
      });
    })
    // 订单详情
    $(".shop-detail-content .bottom .li .tel").click(function() {
      layer.open({
        content: '确认拨打电话 18310010997'
        ,btn: ['确认', '取消']
        ,yes: function(index){
          layer.close(index);
          alert("ok")
        }
      });
    })
    $(".me-order ul li .con .tel").click(function() {
      layer.open({
        content: '确认拨打电话 18310010997'
        ,btn: ['确认', '取消']
        ,yes: function(index){
          layer.close(index);
          alert("ok")
        }
      });
    })
    // 订单详情倒计时
    var intDiff = parseInt(900);//倒计时总秒数量
    timer(intDiff);
    // 店铺主页
    $(".shop-index .bottom.cur .car").click(function() {
      $(".shop-index .select").toggle();
      $(".shop-index .black").toggle();
    })
    $(".shop-index .black").click(function() {
      $(".shop-index .select").toggle();
      $(".shop-index .black").toggle();
    })
    $(".ico_arrow").click(function() {
      $(this).parent().find(".txt").toggleClass("cur");
      $(this).parent().parent().parent().parent().toggleClass("cur");
      $(".shop-index .bg").toggleClass("cur");
      if ($(".shop-index .top").hasClass("cur")) {
        var h = $(".shop-index .top.cur").height();
        $(".mui-content").css("margin-top",h);
      }else {
        $(".mui-content").css("margin-top","6.25rem");
      }

    })
    // 点击左侧导航
    $(".shop-index .content .left ul li").click(function() {
      $(".shop-index .content .left ul li").removeClass("current");
      $(this).addClass("current");
      var index = $(this).index();
      var x = $(".section").eq(index).offset().top;  
      var s = parseInt(x);
      $("body").stop().animate({scrollTop: s }, 100);
    })
    $(window).scroll(function () {
      var s = $(this).scrollTop(),
            sc = $(".shop-index .top").height();
      if (parseInt(s) >= parseInt(sc)) {
        $(".shop-index .content .left").css({"position":"fixed","top": "0"});
      }else {
        $(".shop-index .content .left").css({"position":"absolute","top": "auto"});
      }
    })
    // 右侧滚动
    $(window).bind("scroll", function(){ 
      var y = $(window).scrollTop();
      for (var i = 0; i < $(".section").length; i++) {
        var x = $(".section").eq(i).offset().top;  
        if(x <= y){ 
          $(".shop-index .content .left ul li").removeClass("current")
          $(".shop-index .content .left ul li").eq(i).addClass("current");
         }
        }
    });
    $(".introduce-content .top .arrow").click(function() {
      $('html,body').animate( 
        {scrollTop:$('.introduce6').offset().top},1000 
      ); 
    })
    //订单确认
    $(".order-confirmation .payment .li").click(function() {
        $(".order-confirmation .payment .li").find("input").removeAttr("checked");
        $(this).find("input").attr("checked",true);   
        $(".order-confirmation .payment .li").find("label").css("background","url(images/ico_order_con.jpg) no-repeat");
        $(".order-confirmation .payment .li").find("label").css("background-size","cover");
        $(this).find("label").css("background","url(images/ico_order_con_hover.jpg) no-repeat");
        $(this).find("label").css("background-size","cover");
    })
    //地址列表
    var addressList = $(".address-con .address .li .button .fl span");
    addressList.click(function() {
        addressList.parent().find("input").removeAttr("checked");
        $(this).parent().find("input").attr("checked",true);   
        addressList.parent().find("label").css("background","url(images/ico_address_list.jpg) no-repeat left top");
        addressList.parent().find("label").css("background-size","cover");
        $(this).parent().find("label").css("background","url(images/ico_address_list_hover.jpg) no-repeat left top");
        $(this).parent().find("label").css("background-size","cover");
    })
    //优惠券选择
    $(".me-coupons-select li").click(function() {
        $(".me-coupons-select li").find("input").removeAttr("checked");
        $(this).find("input").attr("checked",true);   
        $(".me-coupons-select li").find("label").css("background","url(images/ico_order_con.jpg) no-repeat");
        $(".me-coupons-select li").find("label").css("background-size","cover");
        $(this).find("label").css("background","url(images/ico_order_con_hover.jpg) no-repeat");
        $(this).find("label").css("background-size","cover");
    })
    // 提交订单
    $(".order-confirmation .button .fr").click(function() {
      layer.open({
        content: '支付成功！如需催单,可在“我的订单”界面联系店长'
        ,btn: ['确认']
        ,yes: function(index){
          layer.close(index);
        }
      });
    })
    //订单提交选择优惠券
    $(".order-confirmation .main .coupons .right").click(function() {
      $(".order-confirmation .select").toggle();
      $(".order-confirmation .black").toggle();
    });
    $(".order-confirmation .black").click(function() {
      $(".order-confirmation .select").toggle();
      $(".order-confirmation .black").toggle();
    })
    // 意见反馈
    var objUrl;
    var img_html;
    $("#feeback").change(function() {
      var img_div = $(".feeback .atta");
      var filepath = $("input[name='myFile']").val();
      for(var i = 0; i < this.files.length; i++) {
        objUrl = getObjectURL(this.files[i]);
        var extStart = filepath.lastIndexOf(".");
        var ext = filepath.substring(extStart, filepath.length).toUpperCase();
      
        if(ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
          layer.open({
            content: '图片限于bmp,png,gif,jpeg,jpg格式'
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
          });
          this.value = "";
          return false;
        } else {
          /*
           若规则全部通过则在此提交url到后台数据库
           * */
           img_html = '<div class="atta-list">' + 
          '<div class="close"><img src="images/ico_close_atta.jpg" onclick="javascript:removeImg(this)" /></div>' +
          '<img class="img" src="'+ objUrl +'" />' +
          '</div>';
          // img_html = "<div class='isImg'><img src='" + objUrl + "' onclick='javascript:lookBigImg(this)' style='height: 100%; width: 100%;' /><button class='removeBtn' onclick='javascript:removeImg(this)'>x</button></div>";
          img_div.find(".con").after(img_html);
        }
      }
      // 图片大小限制 做出来 如果不需要可自行修改
      var file_size = 0;
      var all_size = 0;
      for(j = 0; j < this.files.length; j++) {
        file_size = this.files[j].size;
        all_size = all_size + this.files[j].size;
        var size = all_size / 1024;
        if(size > 500) {
          layer.open({
            content: '上传的图片大小不能超过100k！'
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
          });
          this.value = "";
          return false;
        }
      }
      /**描述：鉴定每个图片宽高 以后会做优化 多个图片的宽高 暂时隐藏掉 想看效果可以取消注释就行
      **/
      //          var img = new Image();
      //          img.src = objUrl;
      //          img.onload = function() {
      //            if (img.width > 100 && img.height > 100) {
      //              alert("图片宽高不能大于一百");
      //              $("#myFile").val("");
      //              $(".img_div").html("");
      //              return false;
      //            }
      //          }
      return true;
    });

})
  
function getObjectURL(file) {
  var url = null;
  if(window.createObjectURL != undefined) { // basic
    url = window.createObjectURL(file);
  } else if(window.URL != undefined) { // mozilla(firefox)
    url = window.URL.createObjectURL(file);
  } else if(window.webkitURL != undefined) { // webkit or chrome
    url = window.webkitURL.createObjectURL(file);
  }
  //console.log(url);
  return url;
}
function removeImg(r){
  $(r).parent().parent().remove();
}
function toast(msg) {
  layer.open({
    content: msg
    ,skin: 'msg'
    ,time: 2 //2秒后自动关闭
  });
}
function register(msg) {
  layer.open({
    type: 1
    ,content: '<div class="register-seccess"><div class="con">恭喜注册成功！</div><div class="btn"><a href="app_download.html">去下载易家APP</a></div></div>'
    ,anim: 'up'
  });
}
function recom() {
  layer.open({
    type: 1
    ,content: '<div class="register-recom"><div class="hd">你将绑定推荐人</div><div class="img"><img src="images/register_logo.png" /></div><div class="tit">小红包YA</div><div class="invitation">邀请码：123456789</div><div class="button"><div onclick="closeRecom()">取消</div><div onclick="closeRecom()">>确认</div></div></div>'
    ,anim: 'up'
  });
}
function closeRecom() {
  layer.closeAll();
}
function addressFocus(that) {
  that.find("input").focus();
  that.find("textarea").focus();
}
// 列表加
function add(t) {
    t.prevAll().css("display", "block");  
    var n = t.prev().val();  
    var num = parseInt(n) + 1;  
    if (num == 0) { return; }  
    t.prev().val(num);  
    var danjia = t.parent().parent().find("i").text();//获取单价  
    var a = $("#totalpriceshow").html();//获取当前所选总价  
    $("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价  
      
    var nm = $("#totalcountshow").html();//获取数量  
    $("#totalcountshow").html(nm*1+1);  
      var html = '<li>' +
                    '<div class="txt">老坛酸菜牛肉面</div>' +
                    '<div class="money">￥<i>12.5</i></div>' +
                    '<div class="right fr">' +
                        '<input type="button" class="minus" onclick="selectMinus($(this))" style="display:block;" value="">' +
                        '<input type="text" class="result" value="'+ num +'" style="display:block;">' +
                        '<input type="button" class="add" onclick="selectAdd($(this))" value="">' +
                    '</div>' +
                '</li>';
      $(".shop-index .select ul").append(html);
}
// 购物车加
function selectAdd(t) {
    t.prevAll().css("display", "block");  
    var n = t.prev().val();  
    var num = parseInt(n) + 1;  
    if (num == 0) { return; }  
    t.prev().val(num);  
    var danjia = t.parent().parent().find("i").text();//获取单价  
    var a = $("#totalpriceshow").html();//获取当前所选总价  
    $("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价  
      
    var nm = $("#totalcountshow").html();//获取数量  
    $("#totalcountshow").html(nm*1+1);  
}
// 列表减
function minus(t) {
    var n = t.next().val();  
    var num = parseInt(n) - 1;  

    t.next().val(num);//减1  

    var danjia = t.parent().parent().find("i").text();//获取单价  
    var a = $("#totalpriceshow").html();//获取当前所选总价  
    $("#totalpriceshow").html((a * 1 - danjia * 1).toFixed(2));//计算当前所选总价  
     
    var nm = $("#totalcountshow").html();//获取数量  
    $("#totalcountshow").html(nm * 1 - 1);  
    //如果数量小于或等于0则隐藏减号和数量  
    if (num <= 0) {  
      t.next().css("display", "none");  
      t.css("display", "none");  
      return  
    }  
}
// 购物车减
function selectMinus(t) {
    var n = t.next().val();  
    var num = parseInt(n) - 1;  

    t.next().val(num);//减1  

    var danjia = t.parent().parent().find("i").text();//获取单价  
    var a = $("#totalpriceshow").html();//获取当前所选总价  
    $("#totalpriceshow").html((a * 1 - danjia * 1).toFixed(2));//计算当前所选总价  
     
    var nm = $("#totalcountshow").html();//获取数量  
    $("#totalcountshow").html(nm * 1 - 1);  
    //如果数量小于或等于0则隐藏减号和数量  
    if (num <= 0) {  
      t.parent().parent().remove(); 
      return  
    }  
}
// 订单详情倒计时
function timer(intDiff){
    window.setInterval(function(){
    var day=0,
        hour=0,
        minute=0,
        second=0;//时间默认值        
    if(intDiff > 0){
        minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('.order-detail .order-detail-button .fl span').html( minute + ':' + second);
    intDiff--;
    }, 1000);
} 



